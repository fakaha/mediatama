<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        $data['videos'] = Video::count();
        $data['users'] = User::where('role_id', 2)->count();
        return view('dashboard', $data);
    }

}
