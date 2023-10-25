<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Services\Auth\LoginService;


class LoginController extends ApiController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials['remember'] = $request->input('remember', false);
        LoginService::login(
            (string) $credentials['username'], 
            (string) $credentials['password'],
            (bool) $credentials['remember']
        );

        return $this->response(['url' => route('profile')]);
    }

    public function logout(Request $request)
    {
        LoginService::logout();

        return $this->response(['url' => route('login')]);
    }
}
