<?php

namespace App\Constants;

use App\Traits\CategoryPermissions;
use App\Traits\ProductPermissions;
use App\Traits\UserPermissions;

class Permissions
{
    use UserPermissions;
    use ProductPermissions;
    use CategoryPermissions;

    public const USERS_INDEX = 'users_index';
    public const USERS_SHOW = 'users_show';
    public const USERS_UPDATE = 'users_update';
    public const USERS_DELETE = 'users_delete';
    public const USERS_TOGGLE = 'user_toggle';

    public static function getAll(): array
    {
        return array_merge(
            [],
            static::getUserPermissions(),
            static::getProductsPermissions(),
            static::getCategoriesPermissions(),
        );
    }
}
