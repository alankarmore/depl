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
    public function index($state = null, $district = null, $city = null)
    {
        $defaultState = (!empty($state))? $state : 'maharashtra';
        $defaultDistrict = (!empty($district))? $district : 'navi-mumbai';
        $defaultCity = (!empty($city))? $city :'airoli';
        $states = $this->service->getAllStates();

        $districts = $this->service->getDistrictsByState($defaultState);
        $cityDetails = $this->service->getCityBySlug($defaultCity);
        $districtDetails = $this->service->getDistrictBySlug($defaultDistrict);
        $citiesByDistrict = $this->service->getCitiesByDistrict($districtDetails->id);

        $networks = $this->service->getRoutes($defaultState,$districtDetails->id,$cityDetails->id);
        $latLong = array(19.7515,75.7139);

        if($networks && $networks->count() > 0 && $cityDetails && $cityDetails->count() > 0) {
            foreach($networks as $network) {
                $network->address = $network->city->name.",".$network->district->name."-".$network->pincode;
            }

            $latLong[0] = $cityDetails->lat;
            $latLong[1] = $cityDetails->lng;
        }

        $params = array('states' => $states,
            'districts' => $districts,
            'defaultState' => $defaultState,
            'defaultDistrict' => $defaultDistrict,
            'defaultCity' => $defaultCity,
            'response' => $networks,
            'citiesByDistrict' => $citiesByDistrict,
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
        $state = ($request->get('state')) ? $request->get('state') : 30;
        $district = ($request->get('district')) ? $request->get('district') : 3;
        $city = ($request->get('city')) ? $request->get('city') : 1;

        return redirect(route('networks',array('state' => $state,'district' => $district,'city' => $city)));
    }

    /**
     * Get all cities according to the district id
     *
     * @param Request $request
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $response = array('valid' => 0, 'string' => 0);
        $district = $request->get('id');
        if(!empty($district)) {
            $cities = $this->service->getCitiesByDistrictSlug($district);
            if($cities) {
                $optionString = '<option value="0">Select City</option>';
                foreach($cities as $city) {
                    $optionString .= '<option value="'.$city->slug.'">'.ucfirst($city->name).'</option>';
                }

                $response['valid'] = 1;
                $response['string'] = $optionString;
            }
        }

        return Response::json($response);
    }

    /**
     * Get district according to the state id
     *
     * @param Request $request
     * @return mixed
     */
    public function getDistrict(Request $request)
    {
        $response = array('valid' => 0, 'string' => 0);
        $state = $request->get('id');
        if(!empty($state)) {
            $districts = $this->service->getDistrictsByState($state);
            if($districts) {
                $optionString = '<option value="0">Select City</option>';
                foreach($districts as $district) {
                    $optionString .= '<option value="'.$district->slug.'">'.ucfirst($district->name).'</option>';
                }

                $response['valid'] = 1;
                $response['string'] = $optionString;
            }
        }

        return Response::json($response);
    }

}
