<?php

namespace App\Observers;

use App\Events\CategoriesChanged;
use App\Models\Category;

class CategoryObserver
{
    public function created(Category $category): void
    {
        event(new CategoriesChanged('created', $category, auth()->user()));
    }

    public function updated(Category $category): void
    {
        event(new CategoriesChanged('updated', $category, auth()->user()));
    }

    public function deleted(Category $category): void
    {
        event(new CategoriesChanged('deleted', $category, auth()->user()));
    }
}
