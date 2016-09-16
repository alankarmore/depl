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
            array('name' => 'Maharastra'),
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
            State::create($state);
        }
    }

}