@extends('layouts.master')

@section('content')

    <div class="photo-show">
        <div class="container">
            <h1>{{ $photo->title }}</h1>
            <p>{{ $photo->description }}</p>
            <a href="{{ route('album.show', $photo->album_id) }}" class="text-dark text-decoration-none">Back To Gallery</a>
            <br>
            <hr>
            <img src="/storage/photo/photo{{ $photo->album_id }}/{{ $photo->photo }}" alt="{{ $photo->title }}">
            <br><br>
            <a href="#" class="btn btn-primary text-decoration-none text-dark" onclick="event.preventDefault(); document.getElementById('photo_delete').submit();">Delete</a>
            {{ Form::open(['route' => ['photo.destroy', $photo->id], 'method' => 'post', 'id' => 'photo_delete']) }}
                {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::close() }}
        </div>
    </div>

@endsection