<?php

namespace App\Listeners;

use App\Events\ProductsChanged;
use Illuminate\Support\Facades\Log;

class RegisterProductLog
{
    public function handle(ProductsChanged $event): void
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
