<?php

namespace App\Http\Services\Admin;

use URL;
use App\District;
use App\State;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class DistrictService extends BaseService
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
        $allDistricts = District::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allDistricts->cnt;
        $query = District::select('districts.id', 'districts.name','states.name AS stateName','districts.status')
                       ->join('states','districts.states_id','=','states.id');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('districts.name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $districts = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $districts->count();
        }

        foreach ($districts as $district) {
            $district->name = ucfirst($district->name);
            $district->stateName = ucfirst($district->stateName);
            $district->action = '<a href="' . URL::route('districts.edit', ['id' => $district->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('districts.destroy', ['id' => $district->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            
            if($district->status) {
                $district->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$district->status.'" data-id="'.$district->id.'" data-object="'.  get_class($district).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $district->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$district->status.'" data-id="'.$district->id.'" data-object="'.  get_class($district).'" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $district;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\District
     */
    public function getDetailsById($id)
    {
        return District::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\DistrictRequest $request
     * @param integer $id
     * @return \App\District
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $district = new District();

        if(!empty($id)) {
            $district = $this->getDetailsById($id);
            $district->updated_at = date("Y-m-d H:i:s");
        } else {
            $district->status = 1;
            $district->created_at = date("Y-m-d H:i:s");
        }

        $district->states_id = trim($request->get('states_id'));
        $state = State::select('name')->where('id','=',$district->states_id)->first();
        $districtName = trim($request->get('name'));
        if($state) {
            $stateName = trim($state->name);
        }

        $address = $districtName." ".$stateName;
        $lat = $this->getLatLongByAddress($address);

        $district->name = $districtName;
        $district->slug = strtolower($this->clean($districtName));
        if($lat) {
            $district->lat = $lat['latitude'];
            $district->lng = $lat['longitude'];
        }


        $district->save();

        return $district;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $district = $this->getDetailsById($id);
        if($district) {
            return $district->delete();
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
