<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppContoller extends Controller
{
    public function index()
    {
        return view('app.dashboard');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

}
