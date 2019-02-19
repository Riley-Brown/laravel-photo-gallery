@extends('layouts.app')

@section('content')
  <h1>{{$album->name}}</h1>
  <a class="button secondary" href="/">Go Back</a>
  <a href="/photos/create/{{$album->id}}" class="button">Upload Photo to Album</a>
  <hr>
  @if(count($album->photos) > 0)
      <div class="album">
        @foreach($album->photos as $photo)
          <div>
            <a href="/photos/{{$photo->id}}">
            <img src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}">
          </a>
          <br>
          <h4>{{$photo->title}}</h4>
        </div>
        @endforeach
      </div>
  @endif


@endsection