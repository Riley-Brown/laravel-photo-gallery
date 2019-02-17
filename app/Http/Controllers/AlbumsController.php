<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index() {
        return view('albums.index');
    }

    public function create() {
        return view('albums.create');
    }

    public function store(Request $request) {
       $this->validate($request, [
           'name' => 'required',
           'cover_image' => 'image|max:1999'
       ]);

        // gets filename with extenstion
       $fileNameWithExt =  $request->file('cover_image')->getClientOriginalName();

        // returns filename
       $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        // get extension
       $extension = $request->file('cover_image')->getClientOriginalExtension();

       $fileNameToStore = $fileName.'_'.time().'.'.$extension;

      $path = $request->file('cover_image')->storeAs('public/album_covers', $fileNameToStore);

      return $path;
    }
}