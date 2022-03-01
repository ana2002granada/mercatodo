<?php

namespace App\Listeners;

use App\Events\CategoriesChanged;
use App\Events\ProductsChanged;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class RegisterProductLog
{
    public function handle(ProductsChanged $event)
    {
        Log::info('Product ' . $event->action, [
            'id' => $event->product->id,
            'name' => $event->product->name,
            'category' => $event->product->category->name,
            'user' => optional($event->user)->email,
            'date' => now(),
        ]);
    }
}
