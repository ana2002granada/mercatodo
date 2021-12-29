<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/users', [UsersController::class, 'index'])
                ->middleware(['auth', 'verified'])
                ->name('users.index');

Route::get('/users/{user}', [UsersController::class, 'show'])
    ->middleware('auth')
    ->name('users.show');

Route::get('/users/update/{user}', [UsersController::class, 'update'])
    ->middleware('auth')
    ->name('users.update');



