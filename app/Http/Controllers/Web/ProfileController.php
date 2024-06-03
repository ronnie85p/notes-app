<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Profile\UpdateRequest;

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

    public function update(UpdateRequest $request)
    {
        return response()->json([
            'success' => 'Ok'
        ]);
    }

    public function editPassword()
    {
        return view('profile.editpassword', [
            'user' => auth()->user()
        ]);
    }
}
