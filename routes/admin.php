<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UsersController::class)->except(['create','store'])
    ->middleware(['enabled','auth','verified']);

Route::resource('categories', CategoriesController::class)
    ->middleware(['enabled','auth','verified']);

Route::resource('products', ProductsController::class)
    ->middleware(['enabled','auth','verified']);

Route::post('users/toggle/{user}', [UsersController::class, 'toggle'])
    ->name('users.toggle')
    ->middleware(['enabled','auth','verified']);
