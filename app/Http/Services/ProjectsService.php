<?php

namespace App\Http\Services;

use App\Project;

class ProjectsService
{
    /**
     * Get all active projects
     *
     * @return mixed
     */
    public function getAllProjects()
    {
        return Project::select('id','slug','title','description','image')
            ->where('status','=',\DB::raw(1))
            ->get();
    }

    /**
     * Get project details.
     *
     * @param string $name
     * @return null | \App\Project mixed
     */
    public function getProjectDetails($name)
    {
        return Project::select('*')
            ->where('slug','=',$name)
            ->where('status','=',\DB::raw(1))
            ->first();
    }

}
