<?php

namespace App\Observers;

use App\Events\ProductsChanged;
use App\Models\Product;

class ProductObserver
{
    public function created(Product $product): void
    {
        event(new ProductsChanged('created', $product, auth()->user()));
    }

    public function updated(Product $product): void
    {
        event(new ProductsChanged('updated', $product, auth()->user()));
    }

    public function deleted(Product $product): void
    {
        event(new ProductsChanged('deleted', $product, auth()->user()));
    }
}
