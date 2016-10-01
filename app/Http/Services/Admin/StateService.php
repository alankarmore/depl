<?php

namespace App\Http\Services\Admin;

use URL;
use App\State;
use App\City;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class StateService extends BaseService
{

    /**
     * Get all menus
     * 
     * @param Request $request
     * @return json
     */
    public function getRecords(Request $request)
    {
        $response = array('total' => 0, 'rows' => '');
        $allStates = State::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allStates->cnt;
        $query = State::select('id', 'name','status');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $states = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $states->count();
        }

        foreach ($states as $state) {
            $state->action = '<a href="' . URL::route('state.edit', ['id' => $state->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('state.destroy', ['id' => $state->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            
            if($state->status) {
                $state->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$state->status.'" data-id="'.$state->id.'" data-object="'.  get_class($state).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $state->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$state->status.'" data-id="'.$state->id.'" data-object="'.  get_class($state).'" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $state;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\State
     */
    public function getDetailsById($id)
    {
        return State::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\StateRequest $request
     * @param integer $id
     * @return \App\State
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $state = new State();
        if(!empty($id)) {
            $state = $this->getDetailsById($id);
            $state->updated_at = date("Y-m-d H:i:s");
        } else {
            $state->status = 1;
            $state->created_at = date("Y-m-d H:i:s");
        }
        
        $state->name = trim($request->get('name'));
        $state->slug = $this->clean($state->name);
        $state->save();

        return $state;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $state = $this->getDetailsById($id);
        if($state) {
            return $state->delete();
        }
        
        return false;
    }

    /**
     * Get all cities according to the state id
     *
     * @param $stateId
     * @return App\City
     */
    public function getCitiesByState($stateId)
    {
        return City::where('states_id','=',$stateId)->get();
    }
}