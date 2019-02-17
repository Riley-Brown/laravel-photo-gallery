<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

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

        // gets filename with extension
        $fileNameWithExt =  $request->file('cover_image')->getClientOriginalName();

        // returns filename
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        // get extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        $fileNameToStore = $fileName.'_'.time().'.'.$extension;

        $path = $request->file('cover_image')->storeAs('public/album_covers', $fileNameToStore);

        // create album
        $album = new Album;
        
        // fields from model
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $fileNameToStore;

        // save to DB
        $album->save();

        return redirect('albums')->with('success', 'Album Created');
          
    }
}