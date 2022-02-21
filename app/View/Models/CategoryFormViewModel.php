<?php

namespace App\View\Models;

use App\Models\Category;

class CategoryFormViewModel extends FormViewModel
{
    protected ?Category $category;

    public function __construct(Category $category = null)
    {
        $this->category = $category ?? new Category();
        $this->isEdit = (bool)$category;
    }

    public function editRoute(): string
    {
        return $this->category->updateRoute();
    }

    public function createRoute(): string
    {
        return $this->category->storeRoute();
    }

    public function categories(): array
    {
        return Category::categoriesFromCache()->toArray();
    }

    public function toArray(): array
    {
        return [
           'isEdit' => $this->isEdit,
           'category' => $this->category,
           'route' => $this->getRoute(),
           'title' => $this->title(),
           'categories' => $this->categories(),
       ];
    }
}
