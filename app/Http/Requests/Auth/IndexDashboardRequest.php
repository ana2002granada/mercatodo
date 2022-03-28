<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class IndexDashboardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'search' => 'sometimes|string|nullable|max:100',
            'start_price' => 'sometimes|numeric|nullable|min:0|max:end_price',
            'end_price' => 'sometimes|numeric|nullable|min:' . ($this->start_price ?? '0'),
            'category' => 'sometimes|numeric|nullable|exists:categories,id',
        ];
    }
}
