<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FormProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'category_id' => 'required|string|exists:categories,id',
            'name' => 'required|string|max:100|unique:products,name' . ($this->route('product') ? ',' . $this->route('product')->getKey() : ''),
            'description' => 'required|string|max:255',
            'image' => $this->route('product') ? 'sometimes|nullable' : 'required',
            'price' => 'required|string|min:0',
            'stock' => 'required|numeric|min:0',
        ];
    }
}
