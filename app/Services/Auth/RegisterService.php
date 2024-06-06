<?php

namespace App\Services\Auth;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\User;

class RegisterService
{
    /**
     * Метода регистрации пользователя
     * @param array $data
     * @return array
     * @throws HttpException
     */
    public function register(array $data): array
    {
        // Cовпадают ли введенные пароли
        self::checkPasswords($data['password'], $data['password_again']);

        // Существует ли уже такой пользователь
        self::checkUser($data['username']);

        // Пробуем создать пользователя
        if (!User::create($data)) {
            throw new HttpException('Произошла непредвиденная ошибка.');
        }

        return ['redirect' => route('auth.signin')];
    }

    /**
     * Метод проверки сущестования пользователя
     * @param string $username
     * @return void
     * @throws BadRequestHttpException
     */
    public function checkUser(string $username): void
    {
        if (User::where('username', $username)->exists()) {
            throw new BadRequestHttpException('Такой пользователь уже существует');
        }
    }

    /**
     * Метод проверки совпадения паролей
     * @param string $password
     * @param string $passwordAgain
     * @return void
     * @throws BadRequestHttpException
     */
    public function checkPasswords(string $password, string $passwordAgain): void
    {
        if (strcmp($password, $passwordAgain) !== 0) {
            throw new BadRequestHttpException('Пароли не совпадают');
        }
    }
}