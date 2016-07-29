<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OurServicesRequest;
use App\Http\Services\Admin\OurServicesService;

class OurServicesController extends Controller
{

    public function __construct()
    {
        $this->service = new OurServicesService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.service.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OurServicesRequest $request)
    {
        $service = $this->service->saveOrUpdateDetails($request);
        if ($service) {
            return redirect(route('service.edit',['service' => $service]))->with('success', 'Service has been created successfully!');
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
            $serviceDetails = $this->service->getDetailsById($id);

            return view('admin.service.show', ['service' => $serviceDetails]);
        }

        return redirect(route('service.list'));
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

            return view('admin.service.edit', ['service' => $serviceDetails]);
        }

        return redirect(route('service.list'));
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
            return redirect(route('service.edit',['service' => $service]))->with('success', 'Service has been  successfully!');
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
                return redirect(route('service.list'))->with('success', 'Service delted successfully!');
            }
        }
        
        return redirect(route('service.list'))->with('error', 'Oops something went wrong !');
    }

}