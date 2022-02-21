<?php

namespace App\View\Models;

use App\Models\Category;
use App\Models\Product;

class ProductFormViewModel extends FormViewModel
{
    protected ?Product $product;

    public function __construct(Product $product = null)
    {
        $this->product = $product ?? new Product();
        $this->isEdit = (bool)$product;
    }

    public function editRoute(): string
    {
        return $this->product->updateRoute();
    }

    public function createRoute(): string
    {
        return $this->product->storeRoute();
    }

    public function categories(): array
    {
        return Category::categoriesFromCache()->toArray();
    }

    public function toArray(): array
    {
        return [
           'isEdit' => $this->isEdit,
           'product' => $this->product,
           'route' => $this->getRoute(),
           'title' => $this->title(),
           'categories' => $this->categories(),
       ];
    }
}
