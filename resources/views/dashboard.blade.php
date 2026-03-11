@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1>Welcome to Mediatama Solo</h1>
        <div class="d-flex justify-content-center gap-2 mt-4">
            <div class="card col-md-2 py-4 px-3 text-center bg-primary text-white">
                <p>Total Video</p>
                <p class="fs-2">{{$videos}}</p>
            </div>
            <div class="card col-md-2 py-4 px-3 text-center bg-primary text-white">
                <p>Total User</p>
                <p class="fs-2">{{$users}}</p>
            </div>
        </div>
    </div>
</div>

@endsection