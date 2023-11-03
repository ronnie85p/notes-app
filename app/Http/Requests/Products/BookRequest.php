<?php

namespace App\Http\Requests\Products;

use Illuminate\Validation\Validator;
use App\Http\Requests\AppRequest;

class BookRequest extends AppRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function getErrors(Validator $validator) 
    {
        return $validator->errors();
    }

    public function validated($key = null, $default = null)
    {
        return [
            'status_id' => 1,
            'thumbnail_url' => '',
            'authors' => array_map('trim', explode(',', $this->string('authors')->trim())),
            'isbn' => $this->string('isbn')->trim(),
            'title' => $this->string('title')->trim(),
            'short_description' => $this->string('short_description')->trim(),
            'long_description' => $this->string('long_description')->trim(),
            'page_count' => $this->integer('page_count'),
            'category_id' => $this->integer('category_id'),
       ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Требуется поле',
            'isbn.unique' => 'Такая книга уже существует',
            'title.required' => 'Укажите название книги',
        ];
    }
}
