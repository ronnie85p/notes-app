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
        $this->service->login($request->validated());

        return new AuthResource([
            'redirect' => route('home')
        ]);
    }

    public function logout(Request $request)
    {
        $this->service->logout();

        return new AuthResource(null);
    }
}

