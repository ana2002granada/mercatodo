<?php

namespace App\Http\Controllers\Admin\Exports;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExportProductRequest;
use App\Jobs\NotifyUserCompletedExportJob;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ExportProductsController extends Controller
{
    public function exportProductForm(): view
    {
        $this->authorize('export', Product::class);
        $categories = Category::categoriesFromCache();

        return view('admin.products.exports.export-product-form', compact('categories'));
    }

    public function export(ExportProductRequest $request)
    {
        $user = auth()->user();
        $filePath = asset('storage/products.xlsx');
        (new ProductsExport($request))->store('products.xlsx', 'public')->chain([
            new NotifyUserCompletedExportJob($user, $filePath)
        ]);

        return redirect(Product::indexRoute())->with('success', 'La expotación a comenzado, te enviaremos un email cuando tu archivo esté listo');
    }
}
