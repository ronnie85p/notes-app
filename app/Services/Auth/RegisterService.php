<?php

namespace App\Services\Auth;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Services\AuthService;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterService extends AuthService 
{
    public static function register(array $data)
    {
        User::createOrFail($data);

        return ['url' => route('auth.login')];
    }
}