@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary mb-3" href="{{route('video.create')}}">Add Video</a>

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
                        <td class="d-flex gap-2">
                            <a href="{{ route('video.show', $video->id) }}">Detail</a>

                            <a href="{{route('video.edit', $video->id) }}">Edit</a>
                            @if(auth()->user()->role_id === 1)
                            <form action="{{ route('video.delete', $video->id) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="rounded bg-danger border-0 text-white" type="submit">Delete</button>
                            </form>
                            @endif
                        </td>
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