<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\AppRequest;

class UpdateSettingsRequest extends AppRequest
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
            'email' => 'required',
            'books_limit_on_page' => 'required',
            'books_source_url' => 'required'
        ];
    }

    public function validated($key = null, $default = null) 
    {
        return [
            'email' => $this->string('email')->trim(),
            'books_source_url' => $this->string('books_source_url')->trim(),
            'books_limit_on_page' => $this->integer('books_limit_on_page'),        ];
    }
}
