<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Login
{
    /**
     * Метод аутентификации пользователя в системе
     * @param array $data
     * @return array
     * @throws BadRequestHttpException
     */
    public function login(array $data): array
    {
        // Пробуем аутентифицировать пользователя
        if (!Auth::attempt(['username' => $data['username'], 'password' => $data['password']], $data['remember'] ?? 1)) {
            throw new BadRequestHttpException('Неверный логин или пароль.');
        }

        // Перезапускаем сессию
        session()->regenerate();

        // Перенаправляем на страницу
        return ['redirect' => route('profile.show')];
    }

    /**
     * Метод выхода пользователя из системы
     * @return array
     */
    public function logout(): array
    {
        // Пробуем выйти из системы
        Auth::logout();
 
        // Сбросить все данные сессии, и создать новый идентификатор
        session()->invalidate();
     
        // Обновить CSRF токен
        session()->regenerateToken();

        // Перенаправить на страницу
        return ['redirect' => route('home')];
    }
}