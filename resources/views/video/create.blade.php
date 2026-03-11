@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Upload Video</h2>
            
            <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-group">
                <label for="name">Title</label>
                <input class="form-control" type="text" name="name">
            </div>

            <div class="form-group">
                <label for="url">Video</label>
                <input class="form-control" type="file" name="url">
            </div>

            <button class="rounded bg-primary border-0 mt-3" type="submit">Upload</button>

            </form>
        </div>
    </div>
</div>

@endsection