<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeImage extends Model
{
    protected $table  = 'office_images';

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function office()
    {
        return $this->belongsTo('\App\OurOffice','offices_id');
    }
}
