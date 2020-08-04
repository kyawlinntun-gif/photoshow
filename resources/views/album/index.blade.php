@extends('layouts.master')

@section('title', 'Photoshow')

@section('content')
    @include('messages.info.success')
    <div class="container">
        <h1>Albums</h1>
        <div class="row">
            @foreach ($albums as $album)

                <div class="col-4 text-center p-0 p-2 mt-4">
                    <a href="{{ route('album.show', $album->id) }}">
                        <img src="/storage/album_covers/{{ $album->cover_image }}" class="img-fluid">
                    </a>
                    <h4 class="m-0">{{ $album->name }}</h4>
                </div>

            @endforeach
        </div>
    </div>
@endsection