<?php

use App\State;
use Illuminate\Database\Seeder;

class StateSeederTable extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('TRUNCATE table states');

        $states = array(
            array('name' => ' Agra'),
            array('name' => ' Bulandshahr'),
            array('name' => ' Farrukhabad'),
            array('name' => ' Ghazipur'),
            array('name' => ' Hardoi'),
            array('name' => ' India'),
            array('name' => ' Purulia'),
            array('name' => ' Rampur'),
            array('name' => 'Andaman & Nicobar Islands'),
            array('name' => 'Andhra Pradesh'),
            array('name' => 'Arunachal Pradesh'),
            array('name' => 'Assam'),
            array('name' => 'Bihar'),
            array('name' => 'Chhattisgarh'),
            array('name' => 'Dadra & Nagar Haveli'),
            array('name' => 'Daman & Diu'),
            array('name' => 'Delhi'),
            array('name' => 'Goa'),
            array('name' => 'Gujarat'),
            array('name' => 'Gujrat'),
            array('name' => 'Hariyana'),
            array('name' => 'Haryana'),
            array('name' => 'Himachal Pradesh'),
            array('name' => 'Jammu & Kashmir'),
            array('name' => 'Jharkhand'),
            array('name' => 'Karnataka'),
            array('name' => 'Kerala'),
            array('name' => 'Lakshadweep'),
            array('name' => 'Madhya Pradesh'),
            array('name' => 'Maharashtra'),
            array('name' => 'Manipur'),
            array('name' => 'Meghalaya'),
            array('name' => 'Mizoram'),
            array('name' => 'Nagaland'),
            array('name' => 'Orissa'),
            array('name' => 'Pondicherry'),
            array('name' => 'Punjab'),
            array('name' => 'Rajastan'),
            array('name' => 'Rajasthan'),
            array('name' => 'Sikkim'),
            array('name' => 'Tamil Nadu'),
            array('name' => 'Tripura'),
            array('name' => 'Uttar Pradesh'),
            array('name' => 'Uttarakhand'),
            array('name' => 'West Bengal')
        );

        foreach($states as $state) {
            $state['name'] = trim($state['name']);
            $state['slug'] = strtolower($this->clean(trim($state['name'])));
            $state['status'] = 1;
            $latLong = $this->getLatLongByAddress($state['name']);
            if (!empty($latLong)) {
                $state['lat'] = $latLong['latitude'];
                $state['lng'] = $latLong['longitude'];
            }

            State::create($state);
        }
    }

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
     * For slug
     *
     * @param string $string
     * @return mixed
     */
    public function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}