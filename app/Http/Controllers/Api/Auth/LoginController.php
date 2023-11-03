<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use App\Http\Resources\Resource;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $loginResult = LoginService::login($credentials, $request->input('remember', false));
        return new Resource($loginResult);
    }

    public function logout(Request $request)
    {
        return new Resource(LoginService::logout());
    }
}
