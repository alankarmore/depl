<?php

namespace App\Http\Controllers\Admin;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StateRequest;
use App\Http\Services\Admin\StateService;

class StateController extends Controller
{

    public function __construct()
    {
        $this->service = new StateService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.states.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        $state = $this->service->saveOrUpdateDetails($request);
        if ($state) {
            return redirect(route('state.edit',['state' => $state]))->with('success', 'State has been created successfully!');
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
            $stateDetails = $this->service->getDetailsById($id);

            return view('admin.states.show', ['state' => $stateDetails]);
        }

        return redirect(route('state.list'));
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
            $stateDetails = $this->service->getDetailsById($id);

            return view('admin.states.edit', ['state' => $stateDetails]);
        }

        return redirect(route('state.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, $id)
    {
        $state = $this->service->saveOrUpdateDetails($request, $id);
        if ($state) {
            return redirect(route('state.edit',['state' => $state]))->with('success', 'State has been updated successfully!');
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
                return redirect(route('state.list'))->with('success', 'State deleted successfully!');
            }
        }
        
        return redirect(route('state.list'))->with('error', 'Oops something went wrong !');
    }

    /**
     * Get all cities according to the state id
     *
     * @param Request $request
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $response = array('valid' => 0, 'string' => 0);
        $id = $request->get('id');
        $cityId = $request->get('city')?$request->get('city'):null;
        if(!empty($id) &&  (int) $id > 0) {
            $cities = $this->service->getCitiesByState($id,$cityId);
            if($cities) {
                $optionString = '<option value="0">Select City</option>';
                foreach($cities as $city) {
                    if($city->id == $cityId) {
                        $optionString .= '<option selected="selected" value="'.$city->id.'">'.ucfirst($city->name).'</option>';
                    } else {
                        $optionString .= '<option value="'.$city->id.'">'.ucfirst($city->name).'</option>';
                    }

                }

                $response['valid'] = 1;
                $response['string'] = $optionString;
            }
        }

        return Response::json($response);
    }

}