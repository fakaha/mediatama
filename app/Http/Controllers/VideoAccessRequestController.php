<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoAccessRequestController extends Controller
{
    public function index()
    {
        if(auth()->user()->role_id !== 1){
            abort(403);
        }

        $requests = DB::table('video_access_requests')
        ->join('users','users.id','=','video_access_requests.user_id')
        ->join('videos','videos.id','=','video_access_requests.video_id')
        ->select(
            'video_access_requests.*',
            'users.name as user_name',
            'videos.name as video_name'
            )
        ->where('video_access_requests.status','pending')
        ->get();

        return view('access.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = DB::table('video_access_requests')->where('id',$id)->first();

        $exists = DB::table('user_video_access')
        ->where('user_id',$request->user_id)
        ->where('video_id',$request->video_id)
        ->first();

        if(!$exists){
            DB::table('user_video_access')->insert([
                'user_id' => $request->user_id,
                'video_id' => $request->video_id,
                'access_start' => now(),
                'access_expired' => now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        DB::table('video_access_requests')
        ->where('id',$id)
        ->update(['status'=>'approved']);
            
        return back()->with('success','Access granted');
    }
}
