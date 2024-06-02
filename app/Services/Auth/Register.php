<?php

namespace App\Services\Auth;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;

class Register
{
    public function register(array $data)
    {
        self::checkPasswords($data['password'], $data['password_again']);
        self::checkUser($data['username']);

        if (!User::create($data)) {
            throw new HttpException('Произошла непредвиденная ошибка.');
        }
    }

    public function checkUser(string $username)
    {
        if (User::where('username', $username)->exists()) {
            throw new BadRequestHttpException('Такой пользователь уже существует');
        }
    }

    public function checkPasswords($password, $passwordAgain)
    {
        if (strcmp($password, $passwordAgain) !== 0) {
            throw new BadRequestHttpException('Пароли не совпадают');
        }
    }
}