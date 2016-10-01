<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use App\Http\Services\NetworkService;

class NetworkController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service = new NetworkService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($state = null, $city = null)
    {
        $defaultState = (!empty($state))? $state : 'maharashtra';
        $defaultCity = (!empty($city))? $city :'pune';
        $states = $this->service->getAllStates();
        $cityDetails = $this->service->getCityBySlug($defaultCity);
        $citiesByState = $this->service->getCitiesByState($defaultState);
        $networks = $this->service->getRoutes($defaultState,$defaultCity);

        $response = array();
        $latLong = array(18.5204303,73.8567437);
        if($networks && $networks->count() > 0 && $cityDetails && $cityDetails->count() > 0) {
            foreach($networks as $network) {
                $network->address = $network->address.",<br/>".$network->stateName.",<br/>".$network->cityName.",<br/>".$network->pincode;
            }

            $latLong[0] = $cityDetails->lat;
            $latLong[1] = $cityDetails->lng;
        }

        $params = array('states' => $states,
            'defaultState' => $defaultState,
            'defaultCity' => $defaultCity,
            'response' => $networks,
            'citiesByState' => $citiesByState,
            'centerPoints' => $latLong);

        return view('network.index',$params);
    }

    /**
     * Get map according to the selected city
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showMap(Request $request)
    {
        $state = ($request->get('state')) ? $request->get('state') : 19;
        $city = ($request->get('city')) ? $request->get('city') : 643;

        return redirect(route('networks',array('state' => $state,'city' => $city)));
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
        $state = $request->get('id');
        $cityParam = $request->get('city')?$request->get('city'):null;
        if(!empty($state)) {
            $cities = $this->service->getCitiesByState($state);
            if($cities) {
                $optionString = '<option value="0">Select City</option>';
                foreach($cities as $city) {
                    if($city->slug == $cityParam) {
                        $optionString .= '<option selected="selected" value="'.$city->slug.'">'.ucfirst($city->name).'</option>';
                    } else {
                        $optionString .= '<option value="'.$city->slug.'">'.ucfirst($city->name).'</option>';
                    }

                }

                $response['valid'] = 1;
                $response['string'] = $optionString;
            }
        }

        return Response::json($response);
    }

}
