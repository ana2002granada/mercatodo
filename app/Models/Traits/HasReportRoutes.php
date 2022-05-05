<?php

namespace App\Models\Traits;

trait HasReportRoutes
{
    public static function showRoute(): string
    {
        return route('admin.reports');
    }
}
