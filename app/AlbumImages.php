<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumImages extends Model
{
    protected  $table = "album_images";

    protected  $fillable = ['album_id','image','created_at','updated_at'];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
}
