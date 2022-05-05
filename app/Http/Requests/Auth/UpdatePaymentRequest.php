<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'document' => 'required|string|min:8|max:10',
            'address' => 'required|string|min:5|max:255',
            'description' => 'nullable|string|max:255',
        ];
    }
}
