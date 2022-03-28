<?php

namespace App\Actions\Payment;

use App\Constants\PaymentStatus;
use App\Http\Requests\Auth\StorePaymentRequest;
use App\Http\Requests\Auth\UpdatePaymentRequest;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentUpdateAction
{
    public static function execute(UpdatePaymentRequest $request, Payment $payment): Payment
    {
        $payment->payer_document = $request->document;
        $payment->payer_address = $request->address;
        $payment->description = $request->description;
        $payment->save();

        return $payment;
    }
}
