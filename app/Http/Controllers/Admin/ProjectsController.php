<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectsRequest;
use App\Http\Services\Admin\ProjectsService;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->service = new ProjectsService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectsRequest $request)
    {
        $project = $this->service->saveOrUpdateDetails($request);
        if ($project) {
            return redirect(route('project.edit',['project' => $project]))->with('success', 'Project has been saved successfully!');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!empty($id)) {
            $projectDetails = $this->service->getDetailsById($id);

            return view('admin.project.show', ['project' => $projectDetails]);
        }

        return redirect(route('project.list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $projectDetails = $this->service->getDetailsById($id);

            return view('admin.project.edit', ['project' => $projectDetails]);
        }

        return redirect(route('project.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectsRequest $request, $id)
    {
        $project = $this->service->saveOrUpdateDetails($request, $id);
        if ($project) {
            return redirect(route('project.edit',['project' => $project]))->with('success', 'Project has been modified successfully!');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($id)) {
            $deleted = $this->service->deleteById($id);
            if($deleted) {
                return redirect(route('project.list'))->with('success', 'Project has been deleted successfully!');
            }
        }
        
        return redirect(route('project.list'))->with('error', 'Oops something went wrong !');
    }

}