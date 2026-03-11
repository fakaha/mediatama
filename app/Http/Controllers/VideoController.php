<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function index()
    {
        $data['videos'] = Video::all();
        return view('video.index', $data);
    }

    public function create()
    {
        $data['access'] = auth()->user()->role_id === 1;

        if(!$data['access']){
            abort(403);
        }

        return view('video.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'url' => 'required|mimetypes:video/mp4'
        ]);

        $data['access'] = auth()->user()->role_id === 1;

        if(!$data['access']){
            abort(403);
        }

        $path = $request->file('url')->store('uploads', 'public');

        Video::create([
            'name' => $request->name,
            'url' => $path
        ]);

        return back()->with('success', 'Video uploaded successfully');
    }

    public function show($id)
    {
        $data['video'] = Video::findOrFail($id);
        $data['access'] = DB::table('user_video_access')->where('user_id', auth()->id())
        ->where('video_id', $data['video']->id)
        ->where('access_expired', '>', now())
        ->first();

        if(!$data['access'] && auth()->user()->role_id !== 1){
            abort(403);
        }
        
        return view('video.show', $data);
    }
}
