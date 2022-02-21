<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductsControllerGuest extends Controller
{
    public function show(Product $product): View
    {
        $similarProducts = $product->category->products()->take(4)->get();
        return view('guest.products.show', compact('product', 'similarProducts'));
    }
}
