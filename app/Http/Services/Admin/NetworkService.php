<?php

namespace App\Http\Services\Admin;

use URL;
use App\State;
use App\City;
use App\Network;
use App\District;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class NetworkService extends BaseService
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
        $allNetworks = Network::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allNetworks->cnt;
        $query = Network::select('networks.id', 'networks.title', 'networks.state_id', 'networks.city_id', 'networks.pincode', 'networks.address', 'networks.lat', 'networks.long', 'networks.status','states.name As stateName','cities.name As cityName','districts.name As districtName')
                          ->join('states','states.id','=','networks.state_id')
                          ->join('cities','cities.id','=','networks.city_id')
                          ->join('districts','districts.id','=','networks.district_id');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
        }

        $networks = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $networks->count();
        }

        foreach ($networks as $network) {
            $network->completion_date = ($network->completion_date) ? date("d M,Y", strtotime($network->completion_date)) : 'NA';
            $network->action = '<a href="' . URL::route('network.show', ['id' => $network->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('network.edit', ['id' => $network->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('network.destroy', ['id' => $network->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';

            if ($network->status) {
                $network->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="' . $network->status . '" data-id="' . $network->id . '" data-object="' . get_class($network) . '" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';
            } else {
                $network->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="' . $network->status . '" data-id="' . $network->id . '" data-object="' . get_class($network) . '" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
            }

            $response['rows'][] = $network;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\Network
     */
    public function getDetailsById($id)
    {
        return Network::select('networks.id', 'networks.title', 'networks.state_id', 'networks.city_id','networks.district_id','networks.kms', 'pincode', 'address', 'networks.lat', 'networks.long', 'networks.status')
            ->where('networks.id','=',$id)
            ->first();
    }

    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\NetworkRequest $request
     * @param integer $id
     * @return \App\Network
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $network = new Network();
        if (!empty($id)) {
            $network = $this->getDetailsById($id);
            $network->updated_at = date("Y-m-d H:i:s");
        } else {
            $network->status = 1;
            $network->created_at = date("Y-m-d H:i:s");
        }

        $network->title = trim($request->get('title'));
        $network->state_id = trim($request->get('state'));
        $network->district_id = trim($request->get('district'));
        $network->city_id = trim($request->get('city'));
        $network->address = trim($request->get('address'));
        $network->pincode = trim($request->get('pincode'));
        $network->kms = trim($request->get('kms'));

        $state = State::find($network->state_id);
        $district = District::find($network->district_id);
        $city = City::find($network->city_id);
        $address = $network->address . " ";
        if(!empty($state)) {
            $address .= $state->name. " ";
        }

        if(!empty($district)) {
            $address .= $district->name. " ";
        }

        if(!empty($city)) {
            $address .= $city->name. " ";
        }

        $address .= " " . $network->pincode;
        $latLong = $this->getLatLongByAddress($address);
        if (!empty($latLong)) {
            $network->lat = $latLong['latitude'];
            $network->long = $latLong['longitude'];
        }

        $network->save();

        return $network;
    }

    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $network = $this->getDetailsById($id);
        if ($network) {
            return $network->delete();
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
            if(isset($output->results[0])) {
                //Get latitude and longitute from json data
                $data['latitude'] = $output->results[0]->geometry->location->lat;
                $data['longitude'] = $output->results[0]->geometry->location->lng;
            }
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
     * Get all state for adding routes
     * 
     * @return App\State
     */
    public function getAllStates()
    {
        return State::all();
    }

}