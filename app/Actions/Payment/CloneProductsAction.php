<?php

namespace App\Actions\Payment;

use App\Models\Payment;
use App\Models\PaymentProduct;

class CloneProductsAction
{
    public static function execute(Payment $oldPayment, Payment $payment): Payment
    {
        $payment->products()->detach();
        foreach ($oldPayment->products as $item) {
            $productItem = new PaymentProduct();
            $productItem->count = $item->pivot->count;
            $productItem->amount = $item->pivot->amount;
            $productItem->payment_id = $payment->id;
            $productItem->product_id = $item->id;

            $productItem->save();
        }

        $payment->amount = $oldPayment->amount;
        $payment->save();
        return $payment;
    }
}
