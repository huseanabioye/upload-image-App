@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('photos.create') }}" class="upload-button">Upload Photo</a>

        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <div class="gallery">
            @foreach ($photos as $photo)
                <div class="photo-item">
                    <a href="{{ route('photos.show', $photo->id) }}"><h2>{{ $photo->title }}</h2></a>
                    <img src="{{ asset('storage/' . $photo->filename) }}" alt="{{ $photo->title }}">
                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button btn-danger">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
