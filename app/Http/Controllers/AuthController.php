<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view("auth.login");
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username'    => 'required',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only(['username', 'password']);

        if (auth()->attempt($credentials)) {
        	$name = ucfirst($request['username']);
            return redirect()->route('user.index')->with('success', 'Welcome ' . $name . '!');
        }
        return redirect()->route('auth.getLogin')->with('error', 'Invalid credentials!');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home')->with('check', 'Successfully logged out! Bye!');
    }
}
