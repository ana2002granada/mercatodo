<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExportProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_price' => 'sometimes|numeric|nullable|min:0|max:end_price',
            'end_price' => 'sometimes|numeric|nullable|min:' . ($this->start_price ?? '0'),
            'start_stock' => 'sometimes|numeric|nullable|min:0|max:end_price',
            'end_stock' => 'sometimes|numeric|nullable|min:' . ($this->start_stock ?? '0'),
            'category' => 'sometimes|numeric|nullable|exists:categories,id',
        ];
    }
}
