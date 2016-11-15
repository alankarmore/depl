<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DistrictRequest;
use App\Http\Services\Admin\DistrictService;

class DistrictController extends Controller
{

    public function __construct()
    {
        $this->service = new DistrictService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = $this->service->getAllStates();
        return view('admin.districts.create', array('states' => $states));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {

        $district = $this->service->saveOrUpdateDetails($request);
        if ($district) {
            return redirect(route('districts.edit',['district' => $district]))->with('success', 'District has been created successfully!');
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
            $districtDetails = $this->service->getDetailsById($id);

            return view('admin.districts.show', ['district' => $districtDetails]);
        }

        return redirect(route('districts.list'));
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
            $states = $this->service->getAllStates();
            $districtDetails = $this->service->getDetailsById($id);

            return view('admin.districts.edit', ['district' => $districtDetails, 'states' => $states]);
        }

        return redirect(route('districts.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, $id)
    {
        $district = $this->service->saveOrUpdateDetails($request, $id);
        if ($district) {
            return redirect(route('districts.edit',['district' => $district]))->with('success', 'District has been updated successfully!');
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
                return redirect(route('districts.list'))->with('success', 'District deleted successfully!');
            }
        }
        
        return redirect(route('districts.list'))->with('error', 'Oops something went wrong !');
    }

}