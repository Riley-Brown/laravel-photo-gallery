<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    // fillable fields from DB
    protected $fillable = array('name', 'description', 'cover_image');
    
    public function photos() {
        // creates has many relationship with album to photos
        return $this->hasMany('App\Photo');
    }
}