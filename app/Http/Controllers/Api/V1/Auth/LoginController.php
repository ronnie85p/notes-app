<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Services\Auth\Login as LoginService;

class LoginController extends ApiController
{
    function __construct(
        private LoginService $service 
    ) { }

    function __invoke(LoginRequest $request)
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

