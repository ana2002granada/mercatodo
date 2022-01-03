<?php

namespace App\Constants;

class Permissions extends UserPermissions
{
    public static function getAll(): array
    {
        return array_merge(
            [],
            static::getUserPermissions(),
        );
    }
}
