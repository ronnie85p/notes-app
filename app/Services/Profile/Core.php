<?php

namespace App\Services\Profile;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class Core 
{
    public function update(array $data) 
    {
        $user = auth()->user();
        $this->checkUserExists($user, $data['username']);
        
        $user->updateOrFail([
            'username' => $data['username'],
            'fullname' => $data['fullname']
        ]);

        return ['user' => $user, 'message' => 'Профиль успешно обновлен'];
    }

    public function checkUserExists($user, string $username)
    {
        if (User::where('username', trim($username))->where('id', '!=', $user->id)->exists()) {
            throw new BadRequestHttpException('Пользователь с таким логином уже существует');
        }
    }

    public function delete()
    {
        $user = auth()->user();
        $user->deleteOrFail(); 

        return ['redirect' => route('home')];
    }

    public function updatePassword(array $data)
    {
        $user = auth()->user();
        $this->checkPassword($user, $data['password']);

        $user->password = Hash::make($data['new_password']);
        $user->saveOrFail();

        return ['message' => 'Пароль успешно обновлен'];
    }

    public function checkPassword($user, $password)
    {
        if (!Hash::check($password, $user->password)) {
            throw new BadRequestHttpException('Неверный пароль.');
        }
    }
}