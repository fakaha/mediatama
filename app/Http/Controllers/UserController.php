<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if(auth()->user()->role_id !== 1){
            abort(403);
        }

        $data['users'] = User::where('role_id', 2)->get();

        return view('user.index', $data);
    }

    public function create()
    {
        if(auth()->user()->role_id !== 1){
            abort(403);
        }

        return view('user.create');
    }

    public function store(Request $request)
    {
        if(auth()->user()->role_id !== 1){
            abort(403);
        }

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        return redirect()->route('user.index')
            ->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        if(auth()->user()->role_id !== 1){
            abort(403);
        }

        $data['user'] = User::findOrFail($id);

        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->role_id !== 1){
            abort(403);
        }

        $user = User::findOrFail($id);

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')
            ->with('success', 'Customer updated successfully');
    }

    public function delete($id)
    {
        if(auth()->user()->role_id !== 1){
            abort(403);
        }

        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'Customer deleted successfully');
    }
}
