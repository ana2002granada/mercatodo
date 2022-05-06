<?php

namespace App\Http\Controllers\Admin\Imports;

use App\Actions\Products\ImportAction;
use App\Actions\Products\RegisterImportAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportProductRequest;
use App\Models\Import;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ImportProductsController extends Controller
{
    public function importProductForm(): view
    {
        $this->authorize('import', Product::class);
        return view('admin.products.imports.form');
    }

    public function index(): view
    {
        $this->authorize('import', Product::class);
        $imports = Import::orderByDesc('created_at')->paginate(5);
        return view('admin.products.imports.index', compact('imports'));
    }

    public function import(
        RegisterImportAction $register,
        ImportAction $import,
        ImportProductRequest $request
    ): RedirectResponse {
        $this->authorize('import', Product::class);
        $response = $import->execute($register, $request->file('products'));
        return redirect(Import::indexRoute())->with($response['type'], $response['message']);
    }
}
