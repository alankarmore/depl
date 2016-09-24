<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMSMenu extends Model
{
    protected $table = 'cms_menu';

    public function includedIn()
    {
        return $this->belongsTo(self::class, 'include_in');
    }

}
