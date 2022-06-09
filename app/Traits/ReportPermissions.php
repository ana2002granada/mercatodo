<?php

namespace App\Traits;

use App\Constants\Permissions;

trait ReportPermissions
{
    public static function getReportsPermissions(): array
    {
        return [
            Permissions::REPORTS,
        ];
    }
}
