<?php

namespace App\Models\Traits\Payments;

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

    public static function indexRoute(): string
    {
        return route('admin.payments.index');
    }
}
