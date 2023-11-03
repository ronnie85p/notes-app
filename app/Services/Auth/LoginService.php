<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Services\AuthService;

class LoginService extends AuthService 
{
    public static function login(array $data, $remember = false)
    {
        if (!Auth::attempt($data, $remember)) {
            throw new BadRequestHttpException('Неверный логин или пароль');
        }

        session()->regenerate();

        return ['url' => route('profile.show'), 'user' => Auth::user()];
    }

    public static function logout()
    {
        Auth::logout();
 
        session()->invalidate();
     
        session()->regenerateToken();

        return ['url' => route('auth.login')];
    }
}