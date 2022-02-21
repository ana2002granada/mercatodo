<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormProductRequest;
use App\Models\Product;
use App\View\Models\ProductFormViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Product::class);
        $products = Product::orderBy('name')->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $this->authorize('create', Product::class);
        return view('admin.products.create', new ProductFormViewModel());
    }

    public function store(FormProductRequest $request): RedirectResponse
    {
        $this->authorize('create', Product::class);
        $product = Product::storeOrUpdateProduct($request);

        return redirect($product->showRoute())
            ->with('success', trans('users.actions.success'));
    }

    public function show(Product $product): View
    {
        $this->authorize('view', $product);
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $this->authorize('update', $product);
        return view('admin.products.edit', new ProductFormViewModel($product));
    }

    public function update(FormProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('update', $product);
        $product = Product::storeOrUpdateProduct($request, $product);

        return response()->redirectTo($product->showRoute())
            ->with('success', trans('users.actions.success'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);
        Storage::delete($product->image);
        $product->delete();

        return response()->redirectTo(Product::indexRoute())
            ->with('success', trans('users.actions.success'));
    }

    public function toggle(Product $product): RedirectResponse
    {
        $this->authorize('toggle', $product);
        $product->disabled_at = $product->disabled_at ? null : now();
        $product->save();
        return response()->redirectTo(Product::indexRoute())
            ->with('success', 'El producto se ha actualizado correctamente');
    }
}
