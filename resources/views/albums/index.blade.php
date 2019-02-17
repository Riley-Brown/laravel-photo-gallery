@extends('layouts.app')

@section('content')
  @if(count($albums) > 0)
      <div class="album">
        @foreach($albums as $album)
          <div>
            <a href="/albums/{{$album->id}}">
            <img src="storage/album_covers/{{$album->cover_image}}" alt="">
          </a>
          <br>
          <h4>{{$album->name}}</h4>
        </div>
        @endforeach
      </div>
  @endif

@endsection
