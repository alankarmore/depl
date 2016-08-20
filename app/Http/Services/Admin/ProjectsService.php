<?php

namespace App\Http\Services\Admin;

use URL;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class ProjectsService extends BaseService
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
        $allProjects = Project::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allProjects->cnt;
        $query = Project::select('id', 'title', 'company', 'state', 'project_type', 'length', 'completion_date');
        if (!empty($request->get('search'))) {
            $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
        }

        $projects = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($request->get('search'))) {
            $response['total'] = $projects->count();
        }

        foreach ($projects as $project) {
            $project->completion_date = ($project->completion_date) ? date("d M,Y", strtotime($project->completion_date)) : 'NA';
            $project->action = '<a href="' . URL::route('project.show', ['id' => $project->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('project.edit', ['id' => $project->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('project.destroy', ['id' => $project->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';

            if ($project->status) {
                $project->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="' . $project->status . '" data-id="' . $project->id . '" data-object="' . get_class($project) . '" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';
            } else {
                $project->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="' . $project->status . '" data-id="' . $project->id . '" data-object="' . get_class($project) . '" class="change-status"><span class="change-status glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
            }

            $response['rows'][] = $project;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return App\Project
     */
    public function getDetailsById($id)
    {
        return Project::find($id);
    }

    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\ProjectRequest $request
     * @param integer $id
     * @return \App\Project
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $project = new Project();
        if (!empty($id)) {
            $project = $this->getDetailsById($id);
            $project->updated_at = date("Y-m-d H:i:s");
        } else {
            $project->status = 1;
            $project->created_at = date("Y-m-d H:i:s");
        }

        $project->title = trim($request->get('title'));
        $project->description = trim($request->get('description'));
        $project->state = trim($request->get('state'));
        $project->company = trim($request->get('company')) ? trim($request->get('company')) : null;
        $project->project_type = trim($request->get('project_type')) ? trim($request->get('project_type')) : null;
        $project->length = trim($request->get('length')) ? trim($request->get('length')) : null;
        $project->completion_date = trim($request->get('completion_date')) ? date("Y-m-d H:i:s", strtotime(trim($request->get('completion_date')))) : null;
        $fileName = !empty($id) ? $project->image : null;
        $file = trim($request->get('fileName'));
        $project->image = $this->uploadFile($file,'project',$fileName);

        $project->save();

        return $project;
    }

    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $project = $this->getDetailsById($id);
        if ($project) {
            return $project->delete();
        }

        return false;
    }

}
