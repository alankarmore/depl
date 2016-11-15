<?php

namespace App\Http\Services;

use App\Network;
use App\State;
use App\City;
use App\District;

class NetworkService
{


    public function getRoutes($state = null,$district = null,$city = null)
    {
        $query = Network::select('networks.id', 'networks.title', 'networks.state_id', 'networks.city_id','networks.district_id',
                                'networks.address','networks.pincode','networks.kms', 'networks.lat', 'networks.long')
                         ->where('networks.status', '=', \DB::raw(1));
        if (!empty($state)) {
            $stateObj = State::where('slug','=', $state)->first();
            if(!empty($stateObj) && $stateObj->id > 0) {
                $query->where('networks.state_id', '=', $stateObj->id);
            }
        }

        if (!empty($district)) {
             $query->where('networks.district_id', '=', $district);
        }

        if (!empty($city)) {
                $query->where('networks.city_id', '=', $city);
        }

        return $query->get();
    }

    /**
     * Get all active states
     * 
     * @return App\State
     */
    public function getAllStates()
    {
        return State::all();
    }

    /**
     * Get city details according to city slug
     *
     * @param string $city
     * @return App\City
     */
    public function getCityBySlug($city)
    {
        return City::where('slug','=',$city)->first();
    }

    /**
     * Get district according to the district slug
     *
     * @param string $district
     * @return mixed
     */
    public function getDistrictBySlug($district)
    {
        return District::where('slug','=',$district)->first();
    }

    /**
     * Get all cities according to the district id
     *
     * @param integer $districtId
     * @return App\City
     */
    public function getCitiesByDistrict($districtId)
    {
        return City::where('district_id','=',$districtId)->get();
    }

    /**
     * Get cities by district slug details
     * @param string $districtSlug
     * @return mixed
     */
    public function getCitiesByDistrictSlug($districtSlug)
    {
        $district = District::where('slug','=',$districtSlug)->first();

        return City::where('district_id','=',$district->id)->get();
    }

    /**
     * Get district according to the state slug
     *
     * @param sring $stateSlug
     * @return mixed
     */
    public function getDistrictsByState($stateSlug)
    {
        $state = State::where('slug','=',$stateSlug)->first();

        return District::where('states_id','=',$state->id)->get();
    }
}