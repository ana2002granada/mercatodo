<?php

namespace App\Constants;

use App\Traits\CategoryPermissions;
use App\Traits\PaymentPermissions;
use App\Traits\ProductPermissions;
use App\Traits\UserPermissions;

class Permissions
{
    use UserPermissions;
    use ProductPermissions;
    use CategoryPermissions;
    use PaymentPermissions;

    public const USERS_INDEX = 'users_index';
    public const USERS_SHOW = 'users_show';
    public const USERS_UPDATE = 'users_update';
    public const USERS_DELETE = 'users_delete';
    public const USERS_TOGGLE = 'user_toggle';
    public const CATEGORIES_INDEX = 'categories_index';
    public const CATEGORIES_SHOW = 'categories_show';
    public const CATEGORIES_CREATE = 'categories_create';
    public const CATEGORIES_UPDATE = 'categories_update';
    public const CATEGORIES_DELETE = 'categories_delete';
    public const CATEGORIES_TOGGLE = 'categories_toggle';
    public const PRODUCTS_INDEX = 'products_index';
    public const PRODUCTS_SHOW = 'products_create';
    public const PRODUCTS_CREATE = 'products_create';
    public const PRODUCTS_UPDATE = 'products_update';
    public const PRODUCTS_DELETE = 'products_delete';
    public const PRODUCTS_TOGGLE = 'categories_toggle';
    public const LOGS_VIEW = 'logs_view';
    public const PAYMENT_INDEX = 'payment_index';
    public const PAYMENT_SHOW = 'payment_show';
    public const PRODUCT_EXPORT = 'product_export';

    public static function getAll(): array
    {
        return array_merge(
            [self::LOGS_VIEW],
            static::getUserPermissions(),
            static::getProductsPermissions(),
            static::getCategoriesPermissions(),
            static::getPaymentPermissions(),
        );
    }
}
