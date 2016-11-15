<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{

    use SoftDeletes;
    protected $table = 'states';

    public function districts()
    {
        return $this->hasMany('App\District','states_id');
    }
}