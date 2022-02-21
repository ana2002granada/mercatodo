<?php

namespace App\Traits;

use App\Constants\Permissions;

trait CategoryPermissions
{
    public static function getCategoriesPermissions(): array
    {
        return [
            Permissions::CATEGORIES_INDEX,
            Permissions::CATEGORIES_SHOW,
            Permissions::CATEGORIES_CREATE,
            Permissions::CATEGORIES_UPDATE,
            Permissions::CATEGORIES_DELETE,
            Permissions::CATEGORIES_TOGGLE,
        ];
    }
}
