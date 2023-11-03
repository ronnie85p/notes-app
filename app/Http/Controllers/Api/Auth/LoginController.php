<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Resource;
use App\Services\Auth\LoginService;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        return new Resource(
            LoginService::login($validated, $request->input('remember', false))
        );
    }

    public function logout(Request $request)
    {
        return new Resource(LoginService::logout());
    }
}
