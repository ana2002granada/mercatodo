<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PaymentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\CategoriesControllerGuest;
use App\Http\Controllers\Guest\ProductsControllerGuest;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice')
                ->middleware('enabled', 'auth');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['enabled', 'auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['enabled', 'auth', 'verified'])
    ->name('home');

Route::get('/categories/{category}', [CategoriesControllerGuest::class, 'show'])
    ->middleware(['enabled', 'auth', 'verified'])
    ->name('guest.categories.show');

Route::get('/products/{product}', [ProductsControllerGuest::class, 'show'])
    ->middleware(['enabled', 'auth', 'verified', 'productIsEnabled'])
    ->name('guest.products.show');

Route::get('payment/process/{payment}', [PaymentController::class, 'continuousWithPayment'])
    ->middleware(['enabled', 'auth', 'verified'])
    ->name('payment.show');

Route::patch('payment/{payment}/process', [PaymentController::class, 'update'])
    ->middleware(['enabled', 'auth', 'verified'])
    ->name('payment.process');

Route::get('my-payments', [PaymentController::class, 'index'])
    ->middleware(['enabled', 'auth', 'verified'])
    ->name('my-payments');

Route::get('my-payments/{payment}', [PaymentController::class, 'show'])
    ->middleware(['enabled', 'auth', 'verified', 'my.payment'])
    ->name('my-payments.payment');

Route::middleware(['enabled', 'auth', 'verified'])->get('/payment/reload/{payment}', [PaymentController::class, 'reload'])
    ->middleware(['enabled', 'auth', 'verified'])
    ->name('payment.reload');
