<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showSettings() {
        return view('profile.settings');
    }

    public function show() 
    {
        return view('profile.show');
    }
}
