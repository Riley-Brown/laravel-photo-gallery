<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // fillable fields from DB
    protected $fillable = array('album_id', 'description', 'photo', 'title', 'size');

    public function album() {
        // creates relationship with album
        return $this->belongsTo('App\Album');
    }
}