<?php

namespace App\Actions\Category;

use App\Models\Category;

class CategoryShowAction
{
    public static function execute(Category $category): array
    {
        $products = $category->products()->paginate(8);

        return ['category' => $category, 'products' => $products];
    }
}
