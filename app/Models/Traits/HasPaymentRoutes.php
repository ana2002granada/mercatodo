<?php

namespace App\Models\Traits;

trait HasPaymentRoutes
{
    public function myPaymentRoute(): string
    {
        return route('my-payments.payment', $this);
    }

    public static function myPaymentsRoute(): string
    {
        return route('my-payments');
    }

    public function showRoute(): string
    {
        return route('payment.show', $this);
    }
}
