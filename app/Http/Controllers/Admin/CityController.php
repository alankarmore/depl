<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Http\Services\Admin\CityService;

class CityController extends Controller
{

    public function __construct()
    {
        $this->service = new CityService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = $this->service->getAllStates();
        return view('admin.cities.create', array('states' => $states));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = $this->service->saveOrUpdateDetails($request);
        if ($city) {
            return redirect(route('city.edit',['city' => $city]))->with('success', 'City has been created successfully!');
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
            $cityDetails = $this->service->getDetailsById($id);

            return view('admin.cities.show', ['city' => $cityDetails]);
        }

        return redirect(route('city.list'));
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
            $cityDetails = $this->service->getDetailsById($id);
            $districts = $cityDetails->state->districts;

            return view('admin.cities.edit', ['city' => $cityDetails, 'states' => $states, 'districts' => $districts]);
        }

        return redirect(route('city.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        $city = $this->service->saveOrUpdateDetails($request, $id);
        if ($city) {
            return redirect(route('city.edit',['city' => $city]))->with('success', 'City has been updated successfully!');
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
                return redirect(route('city.list'))->with('success', 'City deleted successfully!');
            }
        }
        
        return redirect(route('city.list'))->with('error', 'Oops something went wrong !');
    }

}