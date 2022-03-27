<?php

namespace App\Traits;

use App\Constants\Permissions;

trait PaymentPermissions
{
    public static function getPaymentPermissions(): array
    {
        return [
            Permissions::PAYMENT_INDEX,
            Permissions::PAYMENT_SHOW,
        ];
    }
}
