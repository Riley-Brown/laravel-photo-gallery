@extends('layouts.app')

@section('content')

<h3>Create Album</h3>
{!!Form::open(['action' => 'AlbumsController@store', 'method' => 'POST', 'enctype' => 'mutipart/form-data'])!!}
  {{Form::text('name', '', ['placeholder' => 'Album Name'])}}
  {{Form::textArea('description', '', ['placeholder' => 'Album Description'])}}
  {{Form::file('cover_image')}}
  {{Form::submit('submit')}}
{!!Form::close() !!}
@endsection