@extends('layouts.app')

@section('content')
<div class="container">
    <div class="upload-body">
        <div class="form-container">
            <h1>Upload Photo</h1>

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description"></textarea>

                <label for="photo">Photo:</label>
                <input type="file" name="photo" id="photo" required>

                <button type="submit">Upload</button>
            </form>
        </div>
    </div>
</div>
@endsection
