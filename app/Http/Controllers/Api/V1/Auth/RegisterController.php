<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Services\Auth\Register as RegisterService;

class RegisterController extends ApiController
{
    function __construct(
        private RegisterService $service 
    ) { }

    function __invoke(RegisterRequest $request)
    {
        $this->service->register($request->validated());

        return new AuthResource([
            'redirect' => route('auth.signin')
        ]);
    }
}
