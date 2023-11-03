<?php

namespace App\Http\Requests\Products;

use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Products\BookRequest;

class UpdateBookRequest extends BookRequest
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
                $errors = $this->getErrors($validator);

                
            }
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'category_id' =>  'required',
            'isbn' =>  'required',
            'page_count' => 'required',
            'authors' =>  'required',
        ];
    }
}
