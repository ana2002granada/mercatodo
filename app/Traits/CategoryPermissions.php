<?php

namespace App\Traits;

use App\Constants\Permissions;

trait CategoryPermissions
{
    public static function getCategoriesPermissions(): array
    {
        return [
            Permissions::CATEGORIES_CREATE,
            Permissions::CATEGORIES_UPDATE,
            Permissions::CATEGORIES_DELETE,
        ];
    }
}
