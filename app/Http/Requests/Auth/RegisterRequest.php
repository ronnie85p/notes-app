<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function after()
    {
        return [
            function (Validator $validator) {
                $errors = $validator->errors();
                $validated = $this->validated();

                if (User::where('email', $validated['email'])->exists()) {
                    $errors->add('email', 'Такой пользователь уже существует');
                }

                if (strcmp($validated['password'], $validated['password_again']) !== 0) {
                    $errors->add('password_again', 'Пароли не совпадают');
                }
            }
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_again' => 'required',
            'agreed' => 'required'
        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'fullname' => $this->string('fullname')->trim(),
            'email' => $this->string('email')->trim(),
            'password' => $this->string('password')->trim(),
            'password_again' => $this->string('password')->trim(),
            'agreed' => $this->boolean('agreed')
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Требуется поле'
        ];
    }
}
