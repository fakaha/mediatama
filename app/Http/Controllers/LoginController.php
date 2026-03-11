<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $validate['email'])->first();

        if(!$user){
            return back()->with('loginError', 'Email belum terdaftar')->withInput();
        }

        if(Auth::attempt($validate)){
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('loginError', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
