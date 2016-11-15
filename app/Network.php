<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Network extends Model
{

    use SoftDeletes;
    protected $table = 'networks';


    public function state()
    {
        return $this->belongsTo('App\State','state_id');
    }

    public function district()
    {
        return $this->belongsTo('App\District','district_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City','city_id');
    }
}