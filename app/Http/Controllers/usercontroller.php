<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class usercontroller extends Controller
{
    public function index()
    {
        return view('users.index')->with('users',User::all());
    }

    public function make(User $user)
    {
        $user->role='admin';
        $user->save();
        return redirect(route('users.index'));

    }

    public function edit()
    {
        return view('users.update')->with('user',auth()->user());
    }

    public function update(User $user,Request $request)
    {
        $user=auth()->user();
        $user->update([
            'name'=>$request->name,
           'about'=>$request->about,
        ]);
        return redirect()->back();

    }

}
