<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMSMenu extends Model
{
    use SoftDeletes;

    protected $table = 'cms_menu';

    public function includedIn()
    {
        return $this->belongsTo(self::class, 'include_in');
    }

}
