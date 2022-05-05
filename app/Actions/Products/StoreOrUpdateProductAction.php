<?php

namespace App\Actions\Products;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreOrUpdateProductAction
{
    public function execute(array $data, ?Product $product = null): Product
    {
        if (!$product) {
            $product = new Product();
            $product->uuid = (string) Str::uuid();
        }

        $product->name = Arr::get($data, 'name');
        $product->description = Arr::get($data, 'description');
        $product->stock = Arr::get($data, 'stock');
        $product->price = Arr::get($data, 'price');
        $product->category_id = Arr::get($data, 'category_id');

        $image = Arr::get($data, 'image');
        if ($image) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $product->image = $image->storeAs('products', $product->uuid . '_' . $image->hashName());
        }

        $product->save();

        return $product;
    }
}
