<?php

namespace App\Listeners;

use App\Events\CategoriesChanged;
use Illuminate\Support\Facades\Cache;

class RefreshCategoryCache
{
    public function handle(CategoriesChanged $event): void
    {
        Cache::tags(['categories'])->flush();
    }
}
