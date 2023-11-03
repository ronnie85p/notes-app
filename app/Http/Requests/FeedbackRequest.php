<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'name' => $this->string('name')->trim(),
            'email' => $this->string('email')->trim(),
            'message' => $this->string('message')->trim(),
            'phone' => $this->string('phone')->trim()
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Заполните поле :attribute'
        ];
    }
}
