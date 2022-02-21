<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class CategoryViewComposer
{
    protected Collection $categories;

    public function __construct()
    {
        $this->categories = Category::categoriesActiveFromCache();
    }

    public function compose(View $view): void
    {
        $view->with('categorySelect', $this->categories);
    }
}
