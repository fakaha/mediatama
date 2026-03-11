@extends('layouts.master')

@section('content')

<div class="container">
    
    <a class="btn btn-primary mb-3" href="{{route('user.create')}}">Add Customer</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td class="d-flex gap-2">
                    
                    <a href="{{route('user.edit',$user->id)}}">Edit</a>
                    
                    <form action="{{route('user.delete',$user->id)}}" method="POST" onsubmit="return confirm('Delete customer?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-danger border-0 text-white">Delete</button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
    
</div>

@endsection