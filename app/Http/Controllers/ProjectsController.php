<?php

namespace App\Http\Controllers;

use App\Http\Services\ProjectsService;

class ProjectsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service = new ProjectsService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->service->getAllProjects();

        return view('projects.index',array('projects' => $projects));
    }

    /**
     * Get details according to the name of project
     *
     * @param string $name
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getDetails($name)
    {
        $project = $this->service->getProjectDetails($name);
        if($project->count()) {
            $params  = array('project' => $project);

            return view('projects.details',$params);
        }

        return redirect(route('projects'));
    }
}
