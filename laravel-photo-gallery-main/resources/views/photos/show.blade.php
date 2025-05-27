
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="show-body">
        <div class="photo-container">
            <h1>{{ $photo->title }}</h1>

            <img src="{{ asset('storage/photos/' . $photo->filename) }}" alt="{{ $photo->title }}">

            <p>{{ $photo->description }}</p>

            <a href="{{ route('photos.index') }}" class="back-link">Back to Gallery</a>
        </div>
    </div>
</div>
@endsection
