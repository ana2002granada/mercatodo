<?php

namespace App\Providers;

use App\Services\Contracts\GatewayPaymentContract;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class GatewayPaymentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(GatewayPaymentContract::class, function ($app) {
            $current = config('gateway.services.current');
            $gateway = config('gateway.services.' . $current);
            $gatewayClass = Arr::get($gateway, 'class');

            return new $gatewayClass(Arr::get($gateway, 'settings'));
        });
    }
}
