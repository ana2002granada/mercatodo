<?php

namespace App\Listeners;

use App\Events\transactionIsApproved;
use App\Exceptions\StockException;
use Illuminate\Support\Facades\Cache;
use function PHPUnit\Framework\throwException;

class DecreaseStock
{
    public function handle(TransactionIsApproved $event)
    {
        foreach ($event->payment->products as $product) {
            if ($product->pivot->count <= $product->stock) {
                $product->stock = $product->stock - $product->pivot->count;
                $product->save();
                break;
            }
            throw new StockException();
        }
    }
}
