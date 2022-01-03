<?php

namespace App\Constants;

class UserPermissions
{
    public const USERS_INDEX = 'users_index';
    public const USERS_SHOW = 'users_show';
    public const USERS_UPDATE = 'users_update';
    public const USERS_DELETE = 'users_delete';
    public const USERS_TOGGLE = 'user_toggle';

    public static function getUserPermissions(): array
    {
        return [
            self::USERS_INDEX,
            self::USERS_SHOW,
            self::USERS_UPDATE,
            self::USERS_DELETE,
            self::USERS_TOGGLE,
        ];
    }
}
