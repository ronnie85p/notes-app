<?php

namespace App\Services\Auth;

use App\Services\AuthService;
use App\Models\User;

class RegisterService extends AuthService 
{
    public static function register(array $data, $logged_in = false)
    {
        $user = User::create($data);

        if ($logged_in) {
            return LoginService::login(['email' => $user->email, 'password' => $data['password']]);
        }

        return ['url' => route('auth.login')];
    }
}