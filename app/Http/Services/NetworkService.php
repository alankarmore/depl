<?php

namespace App\Http\Services;

use App\Network;
use App\State;
use App\City;

class NetworkService
{

    /**
     * Get all active services
     *
     * @return mixed
     */
    public function getRoutes($state = null,$city = null)
    {
        $query = Network::select('networks.id', 'networks.title', 'networks.state_id', 'networks.city_id', 'networks.address',
            'states.name as stateName','cities.name as cityName','networks.pincode', 'networks.lat', 'networks.long')
                         ->join('states','states.id','=','networks.state_id')
                         ->join('cities','cities.id','=','networks.city_id')
                         ->where('networks.status', '=', \DB::raw(1));
        if (!empty($state)) {
            $stateObj = State::where('slug','=', $state)->first();
            if(!empty($stateObj) && $stateObj->id > 0) {
                $query->where('networks.state_id', '=', $stateObj->id);
            }
        }

        if (!empty($city)) {
            $cityObj = City::where('slug','=', $city)->first();
            if(!empty($cityObj) && $cityObj->id > 0) {
                $query->where('networks.city_id', '=', $cityObj->id);
            }
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
     * Get all cities according to the state id
     *
     * @param string state
     * @return App\City
     */
    public function getCitiesByState($state)
    {
        $state = State::where('slug','=',$state)->first();

        return City::where('states_id','=',$state->id)->get();
    }
}