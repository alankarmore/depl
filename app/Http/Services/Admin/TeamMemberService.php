<?php

namespace App\Http\Services\Admin;

use URL;
use App\TeamMember;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class TeamMemberService extends BaseService
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
        $allMenus = TeamMember::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allMenus->cnt;
        $query = TeamMember::select('id', 'first_name','last_name','designation','description','image','status');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('first_name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $members = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $members->count();
        }

        foreach ($members as $member) {
            $member->description = ($member->description && strlen($member->description) > 50) ? substr($member->description, 0, 50) : $member->description;
            $member->action = '<a href="' . URL::route('team.show', ['id' => $member->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('team.edit', ['id' => $member->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('team.destroy', ['id' => $member->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            
            if($member->status) {
                $member->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$member->status.'" data-id="'.$member->id.'" data-object="'.  get_class($member).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $member->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$member->status.'" data-id="'.$member->id.'" data-object="'.  get_class($member).'" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $member;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\TeamMember
     */
    public function getDetailsById($id)
    {
        return TeamMember::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\TeamMemberRequest $request
     * @param integer $id
     * @return \App\TeamMember
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $member = new TeamMember();
        if(!empty($id)) {
            $member = $this->getDetailsById($id);
            $member->updated_at = date("Y-m-d H:i:s");
        } else {
            $member->status = 1;
            $member->created_at = date("Y-m-d H:i:s");
        }
        
        $member->first_name = trim($request->get('first_name'));
        $member->last_name = trim($request->get('last_name'));
        $member->description = trim($request->get('description'));
        $member->designation = trim($request->get('designation'));
        $fileName = !empty($id) ? $member->image : null;
        $file = trim($request->get('fileName'));
        if(!empty($file)) {
            $member->image = $this->uploadFile($file,'member',$fileName);
        }

        $member->save();

        return $member;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $member = $this->getDetailsById($id);
        if($member) {
            return $member->delete();
        }
        
        return false;
    }
}