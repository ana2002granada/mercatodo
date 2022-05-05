<?php

namespace App\Actions\Payment;

use App\Constants\PaymentStatus;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentStoreAction
{
    public static function execute(): Payment
    {
        $payment = new Payment();
        $payment->reference = Str::random(35);
        $payment->status = PaymentStatus::PROCESSING;
        $payment->user_id = auth()->id();
        $payment->save();

        return $payment;
    }
}
