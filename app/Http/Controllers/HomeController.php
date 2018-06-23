<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{

    public function root()
    {
        return redirect()->route('home');
    }

    public function home()
    {
        return view("home");
    }

    public function welcome() {
        return view("welcome");
    }

}

