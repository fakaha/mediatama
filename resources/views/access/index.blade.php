@extends('layouts.master')

@section('content')

<div class="container">
    
    <h3>Video Access Requests</h3>
    
    <table class="table">
        
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Video</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($requests as $req)
            
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$req->user_name}}</td>
                <td>{{$req->video_name}}</td>
                
                <td>
                    
                <form action="{{route('video.request.approve',$req->id)}}" method="POST">
                    @csrf
                    <button class="btn btn-success">Approve</button>
                </form>
                    
                </td>
            </tr>
            @endforeach
            
        </tbody>
        
    </table>
    
</div>

@endsection