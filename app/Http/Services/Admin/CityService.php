<?php

namespace App\Http\Services\Admin;

use URL;
use App\City;
use App\State;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class CityService extends BaseService
{

    /**
     * Get all menus
     * 
     * @param Request $request
     * @return json
     */
    public function getRecords(Request $request)
    {
        $response = array('total' => 0, 'rows' => '');
        $allCities = City::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allCities->cnt;
        $query = City::select('cities.id', 'cities.name','states.name AS stateName','cities.status')
                       ->join('states','cities.states_id','=','states.id');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('cities.name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $city = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $city->count();
        }

        foreach ($city as $city) {
            $city->action = '<a href="' . URL::route('city.edit', ['id' => $city->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('city.destroy', ['id' => $city->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            
            if($city->status) {
                $city->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$city->status.'" data-id="'.$city->id.'" data-object="'.  get_class($city).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $city->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$city->status.'" data-id="'.$city->id.'" data-object="'.  get_class($city).'" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $city;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\City
     */
    public function getDetailsById($id)
    {
        return City::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\CityRequest $request
     * @param integer $id
     * @return \App\City
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $city = new City();
        if(!empty($id)) {
            $city = $this->getDetailsById($id);
            $city->updated_at = date("Y-m-d H:i:s");
        } else {
            $city->status = 1;
            $city->created_at = date("Y-m-d H:i:s");
        }

        $city->states_id = trim($request->get('states_id'));
        $state = State::select('name')->where('id','=',$city->states_id)->first();
        $cityName = trim($request->get('name'));
        if($state) {
            $stateName = trim($state->name);
        }

        $address = $cityName." ".$stateName;
        $lat = $this->getLatLongByAddress($address);

        $city->name = $cityName;
        $city->slug = strtolower($this->clean($cityName));
        if($lat) {
            $city->lat = $lat['latitude'];
            $city->lng = $lat['longitude'];
        }

        $city->save();

        return $city;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $city = $this->getDetailsById($id);
        if($city) {
            return $city->delete();
        }
        
        return false;
    }

    /**
     * Get lat long according to the address
     *
     * @param string $address
     * @return array|boolean
     */
    protected function getLatLongByAddress($address)
    {
        if (!empty($address)) {
            //Formatted address
            $formattedAddr = str_replace(' ', '+', $address);
            //Send request and receive json data by address
            $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddr . '&sensor=false');
            $output = json_decode($geocodeFromAddr);
            //Get latitude and longitute from json data
            $data['latitude'] = $output->results[0]->geometry->location->lat;
            $data['longitude'] = $output->results[0]->geometry->location->lng;
            //Return latitude and longitude of the given address
            if (!empty($data)) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get all states
     *
     * @return App\State
     */
    public function getAllStates()
    {
        return State::orderBy('name','ASC')->get();
    }
}
