<?php

namespace App\Traits;

use App\Constants\Permissions;

trait UserPermissions
{
    public static function getUserPermissions(): array
    {
        return [
            Permissions::USERS_INDEX,
            Permissions::USERS_SHOW,
            Permissions::USERS_UPDATE,
            Permissions::USERS_DELETE,
            Permissions::USERS_TOGGLE,
        ];
    }
}
