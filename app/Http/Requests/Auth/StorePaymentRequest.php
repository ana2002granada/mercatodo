<?php

namespace App\Http\Requests\Auth;

use App\Rules\CartItemRule;
use App\Rules\MaxStock;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'cart-items' => 'required|array',
            'cart-items.*.count' => 'required|numeric|min:1',
            'cart-items.*' => ['required','array',new CartItemRule()],
        ];
    }
}
