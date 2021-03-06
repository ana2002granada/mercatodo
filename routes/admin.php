<?php

use App\Constants\Permissions;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\Exports\ExportProductsController;
use App\Http\Controllers\Admin\Imports\ImportProductsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

Route::resource('users', UsersController::class)->except(['create', 'store']);

Route::resource('categories', CategoriesController::class);

Route::resource('products', ProductsController::class);

Route::post('users/toggle/{user}', [UsersController::class, 'toggle'])
    ->name('users.toggle');

Route::post('categories/toggle/{category}', [CategoriesController::class, 'toggle'])
    ->name('categories.toggle');

Route::post('products/toggle/{product}', [ProductsController::class, 'toggle'])
    ->name('products.toggle');

Route::get('logs', [LogViewerController::class, 'index'])
    ->middleware(['permission:' . Permissions::LOGS_VIEW]);

Route::get('export/products/form', [ExportProductsController::class, 'exportProductForm'])
    ->name('products.export.form');

Route::get('export/products/', [ExportProductsController::class, 'export'])
    ->name('products.export');

Route::get('import/products', [ImportProductsController::class, 'index'])
    ->name('products.import.index');

Route::get('import/products/form', [ImportProductsController::class, 'importProductForm'])
    ->name('products.import.form');

Route::post('import/products/', [ImportProductsController::class, 'import'])
    ->name('products.import');

Route::get('reports', [ReportsController::class, 'report'])
    ->name('reports');
