@extends('layouts.master')

@section('content')

<div class="container">
    
    <form action="{{route('user.update',$user->id)}}" method="POST">
        @csrf
        @method('PUT')
        
        <input class="form-control" name="name" value="{{$user->name}}">
        <input class="form-control mt-2" name="email" value="{{$user->email}}">
        <input class="form-control mt-2" name="password" placeholder="New password (optional)">
        
        <button class="btn btn-primary mt-3">Update</button>
        
    </form>
    
</div>

@endsection