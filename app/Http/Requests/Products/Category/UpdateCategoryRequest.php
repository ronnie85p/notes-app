<?php

namespace App\Http\Requests\Products\Category;

use App\Http\Requests\Products\CategoryRequest;

class UpdateCategoryRequest extends CategoryRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
