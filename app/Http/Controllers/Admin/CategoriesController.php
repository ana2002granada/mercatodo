<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\FormUserRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('name')->paginate(8);
        return view('admin.categories.index', compact('categories'), );
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Category $category): RedirectResponse
    {
        $category->validate([
            'name' => ['required', 'string', 'max:100'],
            'image' => ['required', 'string'],
        ]);
    }

    public function show(Category $category): View
    {
        $products = $category->products()->paginate(8);
        return view('admin.categories.show', compact('category', 'products'));
    }

    public function edit(Category $category): View
    {
        $this->authorize('update', $category);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(FormUserRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);
        $category->name = $request->input('name');
        $category->save();

        return response()->redirectToRoute('category.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);
        $category->delete();

        return response()->redirectToRoute('categories.index');
    }
}
