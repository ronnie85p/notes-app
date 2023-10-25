<?php

namespace App\Services\Auth;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Services\AuthService;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterService extends AuthService 
{
    public static function checkUser(string $username)
    {
        if (User::where('username', $username)->exists()) {
            throw new BadRequestHttpException('Такой пользователь уже существует');
        }
    }

    public static function checkPasswords($password, $passwordAgain)
    {
        if (strcmp($password, $passwordAgain) !== 0) {
            throw new BadRequestHttpException('Пароли не совпадают');
        }
    }

    public static function register(array $data)
    {
        self::checkUser($data['username']);
        self::checkPasswords($data['password'], $data['password_again']);

        if (!User::create($data)) {
            throw new HttpException('Произошла непредвиденная ошибка.');
        }
    }
}