<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index() 
    {
        return view('index');
    }

    public function show()
    {
        return view('products.book');
    }

    public function feedback() 
    {
        return view('feedback');
    }


    public function login() 
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }
}
