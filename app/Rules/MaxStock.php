<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class MaxStock implements Rule
{
    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function passes($attribute, $value): bool
    {
        return $this->product->stock >= $value;
    }

    public function message(): bool
    {
        return 'The validation error message.';
    }
}
