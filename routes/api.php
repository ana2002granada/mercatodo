<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Products\ProductsApiController;
use App\Http\Controllers\Auth\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('guest')->post('login', [AuthController::class, 'login'])
    ->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('user/show', [AuthController::class, 'show'])
        ->name('user.show');
    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');
    Route::apiResource('products', ProductsApiController::class);
});

Route::middleware('auth:api')->post('/payment/process', [PaymentController::class, 'store'])
    ->name('payment.process');



