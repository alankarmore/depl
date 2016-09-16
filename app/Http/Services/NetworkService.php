<?php

namespace App\Http\Services;

use App\Network;
use App\State;

class NetworkService
{

    /**
     * Get all active services
     *
     * @return mixed
     */
    public function getRoutes($state = null)
    {
        $query = Network::select('id', 'title', 'state_id', 'city', 'address', 'pincode', 'lat', 'long')
                ->where('status', '=', \DB::raw(1));
        if (!empty($state)) {
            $query->where('state', '=', $state);
        }
        
        $query->get();
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

}