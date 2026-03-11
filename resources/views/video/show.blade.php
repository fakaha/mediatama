@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <video src="{{ asset('storage/'.$video->url)}}" controls></video>
        </div>
        <div class="col-md-12">
            <p class="fs-4">{{$video->name}}</p>
        </div>
    </div>
</div>

@endsection