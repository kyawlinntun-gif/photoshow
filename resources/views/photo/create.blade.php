@extends('layouts.master')

@section('title', 'Photoshow')

@section('content')
    <div class="album-create">
        <div class="container">

            <h1>Create Photo</h1>
            {{ Form::open(['route' => 'photo.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                {{ Form::hidden('album_id', $album_id) }}
                {{ Form::bsText('title', old('title') ? old('title') : '', ['label' => 'Photo Title', 'placeholder' => 'Photo Title']) }}
                @include('messages.errors.title')
                {{ Form::bsTextarea('description', old('description') ? old('description') : '', ['placeholder' => 'Photo Description', 'label' => 'Photo Description']) }}
                {{ Form::bsFile('photo') }}
                @include('messages.errors.photo')
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}

        </div>
    </div>
@endsection