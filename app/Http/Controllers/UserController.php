<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.userlist', compact('users'));
    }
    public function update(User $user, Request $request)
    {
        $data=$request->all();
        $user->update($data);
        $user->save();
        return redirect()->route('index'); 
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('index');
    }

}