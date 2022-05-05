<?php

namespace App\Traits;

use App\Constants\Permissions;

trait ProductPermissions
{
    public static function getProductsPermissions(): array
    {
        return [
            Permissions::PRODUCTS_SHOW,
            Permissions::PRODUCTS_INDEX,
            Permissions::PRODUCTS_CREATE,
            Permissions::PRODUCTS_UPDATE,
            Permissions::PRODUCTS_DELETE,
            Permissions::PRODUCTS_TOGGLE,
            Permissions::PRODUCT_EXPORT,
            Permissions::PRODUCT_IMPORT,
        ];
    }
}
