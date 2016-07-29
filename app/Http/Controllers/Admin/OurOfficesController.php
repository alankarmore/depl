<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OurOfficesRequest;
use App\Http\Services\Admin\OurOfficesService;

class OurOfficesController extends Controller
{

    public function __construct()
    {
        $this->office = new OurOfficesService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.office.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.office.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OurOfficesRequest $request)
    {
        $office = $this->office->saveOrUpdateDetails($request);
        if ($office) {
            return redirect(route('office.edit',['office' => $office]))->with('success', 'Service has been created successfully!');
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
            $officeDetails = $this->office->getDetailsById($id);

            return view('admin.office.show', ['office' => $officeDetails]);
        }

        return redirect(route('office.list'));
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
            $officeDetails = $this->office->getDetailsById($id);

            return view('admin.office.edit', ['office' => $officeDetails]);
        }

        return redirect(route('office.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OurOfficesRequest $request, $id)
    {
        $office = $this->office->saveOrUpdateDetails($request, $id);
        if ($office) {
            return redirect(route('office.edit',['office' => $office]))->with('success', 'Service has been  successfully!');
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
            $deleted = $this->office->deleteById($id);
            if($deleted) {
                return redirect(route('office.list'))->with('success', 'Service delted successfully!');
            }
        }
        
        return redirect(route('office.list'))->with('error', 'Oops something went wrong !');
    }

}