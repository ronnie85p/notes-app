<?php

namespace App\Http\Requests\Products\Category;

use Illuminate\Validation\Validator;
use App\Http\Requests\Products\CategoryRequest;
use App\Models\Products\Category;

class UpdateCategoryRequest extends CategoryRequest
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
                $validated = $this->validated();

                if (Category::where('parent_id', $validated['parent_id'])
                    ->where('name', $validated['name'])
                    ->where('id', '!=', $this->input('id'))->exists()) {
                    $errors->add('name', 'Такая категория уже существует.');
                }
            }
        ];
    }
}
