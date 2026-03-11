<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $data['videos'] = Video::get();

        $data['accessVideos'] = collect(DB::table('user_video_access')
        ->where('user_id', auth()->id())
        ->where('access_expired', '>', now())
        ->pluck('video_id'));

        $data['pendingRequests'] = collect(DB::table('video_access_requests')
        ->where('user_id', auth()->id())
        ->where('status', 'pending')
        ->pluck('video_id'));

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

    public function edit($id)
    {
        $data['video'] = Video::findOrFail($id);

        return view('video.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $validate = $request->validate([
        'name' => 'required',
        'url' => 'nullable|file|mimetypes:video/mp4'
        ]);

        if($request->hasFile('url')){
            Storage::disk('public')->delete($video->url);

            $path = $request->file('url')->store('uploads', 'public');

            $video->url = $path;
        }

        $video->name = $request->name;
        $video->save();

        return redirect()->route('video.index')->with('success', 'Video updated successfully');
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

    public function delete($id)
    {
        if(auth()->user()->role_id !== 1){
            abort(403);
        }

        $video = Video::findOrFail($id);
        
        $video->delete();

        return redirect()->route('video.index')->with('success', 'Post deleted successfully');
    }
    
    public function requestAccess(Request $request)
    {
        if(auth()->user()->role_id === 1){
            abort(403);
        }

        $exists = DB::table('video_access_requests')
    ->where('user_id', auth()->id())
    ->where('video_id', $request->video_id)
    ->where('status', 'pending')
    ->first();

        if($exists){
            return back()->with('error','Request already sent');
        }

        DB::table('video_access_requests')->insert([
            'user_id' => auth()->id(),
            'video_id' => $request->video_id,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);
            
        return back()->with('success','Request sent to admin');
    }
}
