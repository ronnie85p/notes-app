<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $user;

    function __construct()
    {
        $this->user = auth()->user();
    }

    public function show() 
    {
        return view('profile.show', [
            'user' => auth()->user()
        ]);
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update()
    {

    }

    public function editPassword()
    {
        return view('profile.editpassword', [
            'user' => auth()->user()
        ]);
    }
}
