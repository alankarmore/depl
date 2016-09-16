<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectsRequest;
use App\Http\Services\Admin\ProjectsService;

class NetworkController extends Controller
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
        return view('admin.network.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.network.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectsRequest $request)
    {
        $route = $this->service->saveOrUpdateDetails($request);
        if ($route) {
            return redirect(route('network.edit',['$route' => $route]))->with('success', 'Route has been saved successfully!');
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
            $routeDetails = $this->service->getDetailsById($id);

            return view('admin.network.show', ['route' => $routeDetails]);
        }

        return redirect(route('network.list'));
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
            $routeDetails = $this->service->getDetailsById($id);

            return view('admin.network.edit', ['route' => $routeDetails]);
        }

        return redirect(route('network.list'));
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
        $route = $this->service->saveOrUpdateDetails($request, $id);
        if ($route) {
            return redirect(route('network.edit',['route' => $route]))->with('success', 'Route has been modified successfully!');
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
                return redirect(route('network.list'))->with('success', 'New Route has been deleted successfully!');
            }
        }
        
        return redirect(route('network.list'))->with('error', 'Oops something went wrong !');
    }

}