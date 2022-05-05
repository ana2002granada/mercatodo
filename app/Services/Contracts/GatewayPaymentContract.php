<?php

namespace App\Services\Contracts;

use App\Models\Payment;
use Illuminate\Http\Request;

interface GatewayPaymentContract
{
    public function request(Payment $payment, Request $request): Payment;
    public function query(Payment $payment): Payment;
}
