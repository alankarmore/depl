<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{

    use SoftDeletes;
    protected $table = 'cities';

    public function state()
    {
        return $this->belongsTo('App\State','states_id');
    }
}