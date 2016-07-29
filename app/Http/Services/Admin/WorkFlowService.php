<?php

namespace App\Http\Services\Admin;

use URL;
use App\WorkFlow;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class WorkFlowService extends BaseService
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
        $allWorkFlows = WorkFlow::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allWorkFlows->cnt;
        $query = WorkFlow::select('id', 'title','slug','description','services.title AS serviceTitle','workflows.status')
                           ->join('services','workflows.servicve_id','=','services.id');
        if (!empty($request->get('search'))) {
            $query->where('workflow.title', 'LIKE', '%' . $request->get('search') . '%');
        }

        $workflows = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($request->get('search'))) {
            $response['total'] = $workflows->count();
        }

        foreach ($workflows as $workflow) {
            $workflow->description = ($workflow->description && strlen($workflow->description) > 50) ? substr($workflow->description, 0, 50) : $workflow->description;
            $workflow->action = '<a href="' . URL::route('workflow.show', ['id' => $workflow->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('workflow.edit', ['id' => $workflow->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
            if (!in_array($workflow->id, [1, 2, 3, 4])) {
                $workflow->action .= ' <a href="' . URL::route('workflow.destroy', ['id' => $workflow->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            } else {
                $workflow->action .= ' <a href="javascript:void(0);" title="Not allowed to remove"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>';
            }
            
            if($workflow->status) {
                $workflow->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$workflow->status.'" data-id="'.$workflow->id.'" data-object="'.  get_class($workflow).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $workflow->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$workflow->status.'" data-id="'.$workflow->id.'" data-object="'.  get_class($workflow).'" class="change-status"><span class="change-status glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $workflow;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return App\WorkFlow
     */
    public function getDetailsById($id)
    {
        return WorkFlow::where('workflows.id','=',$id)
                        ->join('services','services.id','=','workflows.services_id')
                        ->first();
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\WorkFlowRequest $request
     * @param integer $id
     * @return App\WorkFlow
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $workflow = new WorkFlow();
        if(!empty($id)) {
            $workflow = $this->getDetailsById($id);
            $workflow->updated_at = date("Y-m-d H:i:s");
        } else {
            $workflow->status = 1;
            $workflow->created_at = date("Y-m-d H:i:s");
        }
        
        $workflow->title = trim($request->get('title'));
        $workflow->slug = strtolower(str_replace(' ', '_', $workflow->title));
        $workflow->description = trim($request->get('description'));
        $workflow->save();

        return $workflow;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $workflow = $this->getDetailsById($id);
        if($workflow) {
            return $workflow->delete();
        }
        
        return false;
    }
}