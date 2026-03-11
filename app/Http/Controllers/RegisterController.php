<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:5|max:255|confirmed'
        ]);

        $validate['role_id'] = 2;

        User::create($validate);

        return redirect()->route('auth.login');
    }

}
