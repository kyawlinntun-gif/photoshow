@extends('layouts.master')

@section('title', 'Photoshow')

@section('content')
    <div class="photo">
        <div class="container">

            @include('messages.info.success')

            <h1>{{ $album->name }}</h1>
            
            <a href="{{ route('album.index') }}" class="btn btn-secondary text-dark text-decoration-none">Go Back</a>
            <a href="#" class="btn btn-primary text-dark text-decoration-none" onclick="event.preventDefault(); document.getElementById('photo-create').submit();">Upload photo to Album</a>
            {{ Form::open(['route' => 'photo.create', 'method' => 'get', 'id' => 'photo-create']) }}
                {{ Form::hidden('album_id', $album->id) }}
            {{ Form::close() }}
            <hr>

            <div class="row">
                @foreach ($album->photos as $photo)
    
                    <div class="col-4 text-center p-0 p-2 mt-4">
                        <a href="{{ route('photo.show', $photo->id) }}">
                            <img src="/storage/photo/photo{{ $photo->album_id }}/{{ $photo->photo }}" class="img-fluid">
                        </a>
                        <h4 class="m-0">{{ $photo->title }}</h4>
                    </div>
    
                @endforeach
            </div>

        </div>
    </div>

@endsection