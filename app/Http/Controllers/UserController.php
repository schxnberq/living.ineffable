<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    //

    public function index()
    {
        return view('user.index');
    }

    public function getUser()
    {
        $user = User::select("id", "username", "email")->where("id",auth()->id())->get();

        return $user;
    }

    function list() {
        //
        return view('user.lists');
    }
}
