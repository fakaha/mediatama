@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach($videos as $video)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$video->name}}</td>
                        <td><a href="{{ route('video.show', $video->id) }}">Detail</a></td>
                    </tr>
                    @php
                    $no += 1;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection