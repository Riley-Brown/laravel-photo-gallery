<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotosController extends Controller
{
    public function create($album_id) {
        return view('photos.create')->with('album_id', $album_id);
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'image|max:1999'
        ]);
 
         // gets filename with extension
         $fileNameWithExt =  $request->file('photo')->getClientOriginalName();
 
         // returns filename
         $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
 
         // get extension
         $extension = $request->file('photo')->getClientOriginalExtension();
 
         $fileNameToStore = $fileName.'_'.time().'.'.$extension;
 
         $path = $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'), $fileNameToStore);
 
         // upload photo to album
         $photo = new Photo;
         
         // fields from model
         $photo->title = $request->input('title');
         $photo->album_id = $request->input('album_id');
         $photo->description = $request->input('description');
         $photo->photo = $fileNameToStore;
         $photo->size = $request->file('photo')->getClientSize();
 
         // save to DB
         $photo->save();
 
         return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo Uploaded');
    }

    public function show($id) {
        $photo = Photo::find($id);
        return view('photos.show')->with('photo', $photo);
    }

    public function destroy($id) {
        $photo = Photo::find($id);
        
        if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo)) {
            $photo->delete();

            return redirect('/')->with('success', 'Photo Deleted');
        }
    }
}