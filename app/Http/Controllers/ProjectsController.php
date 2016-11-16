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

        // Fetching data from cms_menu table related to project menu
        $projectCMSData = $this->service->getProjectCMSData();

        $metaInfo = array();
        $metaInfo['meta_title'] = !empty($projectCMSData['meta_title'])? $projectCMSData['meta_title'] : 'DEPL Pvt Ltd';
        $metaInfo['meta_keyword'] = !empty($projectCMSData['meta_keyword'])? $projectCMSData['meta_keyword'] : 'DEPL Pvt Ltd';
        $metaInfo['meta_description'] = !empty($projectCMSData['meta_description'])? $projectCMSData['meta_description'] : 'DEPL Pvt Ltd';

        return view('projects.index',array('projects' => $projects,'pageContent' => $projectCMSData,'metaInfo' => $metaInfo));
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
