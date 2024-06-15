<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Services\Auth\RegisterService;

class RegisterController extends ApiController
{
    function __construct(
        private RegisterService $service 
    ) { }

    function __invoke(RegisterRequest $request)
    {
        return new AuthResource(
            $this->service->register($request->validated())
        );
    }
}

