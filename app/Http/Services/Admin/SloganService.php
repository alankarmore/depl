<?php

namespace App\Http\Services\Admin;

use URL;
use App\Slogan;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class SloganService extends BaseService
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
        $allSlogans = Slogan::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allSlogans->cnt;
        $query = Slogan::select('id', 'main_phrase','sub_phrase','status');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('main_phrase', 'LIKE', '%' . $request->get('search') . '%');
        }

        $slogans = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $slogans->count();
        }

        foreach ($slogans as $slogan) {
            $slogan->action = '<a href="' . URL::route('slogan.show', ['id' => $slogan->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('slogan.edit', ['id' => $slogan->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('slogan.destroy', ['id' => $slogan->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            
            if($slogan->status) {
                $slogan->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$slogan->status.'" data-id="'.$slogan->id.'" data-object="'.  get_class($slogan).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $slogan->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$slogan->status.'" data-id="'.$slogan->id.'" data-object="'.  get_class($slogan).'" class="change-status"><span class="change-status glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $slogan;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\Slogan
     */
    public function getDetailsById($id)
    {
        return Slogan::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\SloganRequest $request
     * @param integer $id
     * @return \App\Slogan
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $slogan = new Slogan();
        if(!empty($id)) {
            $slogan = $this->getDetailsById($id);
            $slogan->updated_at = date("Y-m-d H:i:s");
        } else {
            $slogan->status = 1;
            $slogan->created_at = date("Y-m-d H:i:s");
        }
        
        $slogan->main_phrase = trim($request->get('main_phrase'));
        $slogan->sub_phrase = trim($request->get('sub_phrase'));
        $slogan->save();

        return $slogan;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $slogan = $this->getDetailsById($id);
        if($slogan) {
            return $slogan->delete();
        }
        
        return false;
    }
}