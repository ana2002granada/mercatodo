<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:categories,name' . ($this->route('category') ? ',' . $this->route('category')->getKey() : ''),
            'image' => ($this->route('category') ? 'sometimes|nullable' : 'required'),
        ];
    }
}
