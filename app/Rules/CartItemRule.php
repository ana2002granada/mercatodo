<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class CartItemRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $product = Product::find(Arr::get($value, 'id'));
        return (new MaxStock($product))->passes('count', Arr::get($value, 'count'));
    }

    public function message(): string
    {
        return 'The validation error message.';
    }
}
