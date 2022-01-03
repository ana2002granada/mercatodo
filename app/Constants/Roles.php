<?php

namespace App\Constants;

class Roles
{
    public const ADMIN = 'admin';

    public static function getAll(): array
    {
        return [
            self::ADMIN,
        ];
    }
}
