@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <form action="{{route('video.update', $video->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="col-md-12">
            <video src="{{ asset('storage/'.$video->url)}}" controls></video>
        </div>

        <div class="col-md-12 mt-3">
            <label for="">New video</label>
            <input class="form-control" type="file" name="url">
        </div>

        <div class="col-md-12">
            <label for="">Title</label>
            <input class="form-control" name="name" value="{{$video->name}}">
        </div>

        <button class="rounded bg-primary border-0 mt-3" type="submit">Update</button>
        </form>
    </div>
</div>

@endsection