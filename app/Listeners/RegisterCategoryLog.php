<?php

namespace App\Listeners;

use App\Events\CategoriesChanged;
use Illuminate\Support\Facades\Log;

class RegisterCategoryLog
{
    public function handle(CategoriesChanged $event)
    {
        Log::info('Category ' . $event->action, [
            'id' => $event->category->id,
            'name' => $event->category->name,
            'user' => optional($event->user)->email,
            'date' => now(),
        ]);
    }
}
