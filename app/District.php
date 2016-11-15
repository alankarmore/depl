<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $table = "districts";

    public function state()
    {
        return $this->belongsTo('App\State','states_id');
    }

    public function cities()
    {
        return $this->hasMany('App\City','district_id');
    }
}
