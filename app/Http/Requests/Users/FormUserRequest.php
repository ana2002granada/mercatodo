<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|string',
            'last_name' => 'required|string|max:100',
            'phone_number' => 'required|string|size:10',
            'email' =>  [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->route('user')->getKey()),
            ],
        ];
    }
}
