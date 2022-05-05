<?php

namespace App\Actions\Payment;

use App\Http\Requests\Auth\StorePaymentRequest;
use App\Models\Payment;
use App\Models\PaymentProduct;
use App\Models\Product;
use Illuminate\Support\Arr;

class PaymentRequestStoreAction
{
    public static function execute(StorePaymentRequest $request, Payment $payment): Payment
    {
        $total = 0;
        $payment->products()->detach();
        foreach ($request->get('cart-items') as $item) {
            $product = Product::find(Arr::get($item, 'id'));
            $productItem = new PaymentProduct();
            $productItem->count = Arr::get($item, 'count');
            $productItem->amount = $productItem->count * $product->price;
            $productItem->payment_id = $payment->id;
            $productItem->product_id = $product->id;
            $total = $total + $productItem->amount;

            $productItem->save();
        }

        $payment->amount = $total;
        $payment->save();
        return $payment;
    }
}
