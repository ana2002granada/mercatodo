<?php

namespace App\Providers;

use App\Events\CategoriesChanged;
use App\Events\ProductsChanged;
use App\Events\TransactionIsApproved;
use App\Listeners\DecreaseStock;
use App\Listeners\RefreshCategoryCache;
use App\Listeners\RegisterCategoryLog;
use App\Listeners\RegisterProductLog;
use App\Models\Category;
use App\Models\Product;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CategoriesChanged::class => [
            RefreshCategoryCache::class,
            RegisterCategoryLog::class,
        ],
        ProductsChanged::class => [
            RegisterProductLog::class,
        ],
        TransactionIsApproved::class => [
            DecreaseStock::class,
        ],

    ];

    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
