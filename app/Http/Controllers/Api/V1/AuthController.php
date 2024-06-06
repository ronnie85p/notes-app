<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Services\Auth\LoginService;

class AuthController extends ApiController
{
    function __construct(
        private LoginService $service 
    ) { }

    public function login(LoginRequest $request)
    {
        return new AuthResource(
            $this->service->login($request->validated())
        );
    }

    public function logout(Request $request)
    {
        return new AuthResource(
            $this->service->logout()
        );
    }
}
