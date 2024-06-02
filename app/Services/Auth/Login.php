<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Login
{
    public function login(array $data)
    {
        if (!Auth::attempt(['username' => $data['username'], 'password' => $data['password']], $data['remember'] ?? 1)) {
            throw new BadRequestHttpException('Неверный логин или пароль или то и другое сразу');
        }

        session()->regenerate();

        return Auth::user();
    }

    public function logout() 
    {
        Auth::logout();
 
        session()->invalidate();
     
        session()->regenerateToken();
    }
}