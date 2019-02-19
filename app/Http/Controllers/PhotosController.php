<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function create($album_id) {
        return view('photos.create')->with('album_id', $album_id);
    }
}