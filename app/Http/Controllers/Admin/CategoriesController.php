<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('name')->paginate(8);
        return view('admin.categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $products = $category->products()->paginate(8);
        return view('admin.categories.show', compact('category','products'));
    }
}
