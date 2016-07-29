<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WorkFlowRequest;
use App\Http\Services\Admin\WorkFlowService;

class WorkFlowController extends Controller
{

    public function __construct()
    {
        $this->service = new WorkFlowService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.workflow.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.workflow.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkFlowRequest $request)
    {
        $workflow = $this->service->saveOrUpdateDetails($request);
        if ($workflow) {
            return redirect(route('workflow.edit',['workflow' => $workflow]))->with('success', 'Workflow has been created successfully!');
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
            $workflowDetails = $this->service->getDetailsById($id);

            return view('admin.workflow.show', ['workflow' => $workflowDetails]);
        }

        return redirect(route('workflow.list'));
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
            $serviceDetails = $this->service->getDetailsById($id);

            return view('admin.workflow.edit', ['service' => $serviceDetails]);
        }

        return redirect(route('workflow.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OurServicesRequest $request, $id)
    {
        $service = $this->service->saveOrUpdateDetails($request, $id);
        if ($service) {
            return redirect(route('workflow.edit',['service' => $service]))->with('success', 'Workflow has been update successfully!');
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
                return redirect(route('workflow.list'))->with('success', 'Workflow delted successfully!');
            }
        }
        
        return redirect(route('workflow.list'))->with('error', 'Oops something went wrong !');
    }

}