<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class ImportProductRule
{
    public static function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'price' => ['required','numeric', 'integer', 'min:1'],
            'stock' => ['required','numeric', 'integer', 'min:0'],
            'description' => ['required', 'max:250'],
            'category_id' => ['numeric', 'integer', 'min:1'],
        ];
    }
}
