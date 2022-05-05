<?php

namespace App\Models\Traits\Imports ;

trait HasImportRoutes
{
    public static function indexRoute(): string
    {
        return route('admin.products.import.index');
    }

    public static function formRoute(): string
    {
        return route('admin.products.import.form');
    }
}
