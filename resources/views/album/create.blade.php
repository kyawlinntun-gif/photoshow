@extends('layouts.master')

@section('title', 'Photoshow')

@section('content')
    <div class="album-create">
        <div class="container">

            <h1>Create Albums</h1>
            {{ Form::open(['route' => 'album.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                {{ Form::bsText('name', old('name') ? old('name') : '', ['label' => 'Album Name', 'placeholder' => 'Album Name']) }}
                @include('messages.errors.name')
                {{ Form::bsTextarea('description', old('description') ? old('description') : '', ['placeholder' => 'Album Description', 'label' => 'Album Description']) }}
                {{ Form::bsFile('cover_img') }}
                @include('messages.errors.cover-img')
                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}

        </div>
    </div>
@endsection