@extends('layouts.master')

@section('content')

<div class="container">
    
    <form action="{{route('user.store')}}" method="POST">
        @csrf
        
        <input class="form-control" name="name" placeholder="Name">
        <input class="form-control mt-2" name="email" placeholder="Email">
        <input class="form-control mt-2" name="password" type="password" placeholder="Password">
        
        <button class="btn btn-primary mt-3">Create</button>
        
    </form>
    
</div>

@endsection