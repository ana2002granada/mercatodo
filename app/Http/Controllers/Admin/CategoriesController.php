<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Category\CategoryShowAction;
use App\Helpers\PaginatorHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormCategoryRequest;
use App\Models\Category;
use App\View\Models\CategoryFormViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Category::class);
        $categories = PaginatorHelper::paginate(Category::categoriesFromCache(), 8);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $this->authorize('create', Category::class);
        return view('admin.categories.create', new CategoryFormViewModel());
    }

    public function store(FormCategoryRequest $request): RedirectResponse
    {
        $this->authorize('create', Category::class);
        $category = Category::storeOrUpdateCategory($request);

        return redirect($category->showRoute())
            ->with('success', trans('users.actions.success'));
    }

    public function show(Category $category): View
    {
        $this->authorize('view', $category);
        return view('admin.categories.show', CategoryShowAction::execute($category));
    }

    public function edit(Category $category): View
    {
        $this->authorize('update', $category);
        return view('admin.categories.edit', new CategoryFormViewModel($category));
    }

    public function update(FormCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);
        $category = Category::storeOrUpdateCategory($request, $category);

        return response()->redirectTo($category->showRoute())
            ->with('success', trans('users.actions.success'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);
        if ($category->products_count) {
            return response()->redirectTo(Category::indexRoute())
                ->with('error', trans('categories.error.no_void'));
        }

        Storage::delete($category->image);
        $category->delete();

        return response()->redirectTo(Category::indexRoute())
            ->with('success', trans('users.actions.success'));
    }

    public function toggle(Category $category): RedirectResponse
    {
        $this->authorize('toggle', $category);
        $category->disabled_at = $category->disabled_at ? null : now();
        $category->save();
        return response()->redirectTo(Category::indexRoute())
            ->with('success', trans('users.actions.success'));
    }
}
