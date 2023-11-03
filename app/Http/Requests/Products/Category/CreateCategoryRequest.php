<?php

namespace App\Http\Requests\Products\Category;

use Illuminate\Validation\Validator;
use App\Http\Requests\Products\CategoryRequest;

class CreateCategoryRequest extends CategoryRequest
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
}
