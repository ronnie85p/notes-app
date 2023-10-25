<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Services\AuthService;

class LoginService extends AuthService 
{
    public static function login(string $username, string $password, bool $remember = false)
    {
        if (!Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
            throw new BadRequestHttpException('Неверный логин или пароль или то и другое сразу');
        }

        session()->regenerate();

        return Auth::user();
    }

    public static function logout()
    {
        Auth::logout();
 
        session()->invalidate();
     
        session()->regenerateToken();
    }
}