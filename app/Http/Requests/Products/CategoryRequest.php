<?php

namespace App\Http\Requests\Products;

use App\Http\Requests\AppRequest;

class CategoryRequest extends AppRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
        ];
    }
    
    public function validated($key = null, $default = null)
    {
        return [
            'name' => $this->string('name')->trim(),
            'parent_id' => $this->integer('parent_id'),
            'description' => $this->string('description')->trim()
        ];
    }
}
