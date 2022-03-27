<?php

namespace App\Models;

use App\Helpers\MoneyHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PaymentProduct extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'count',
        'amount',
        'payment_id',
        'product_id',

    ];

    protected $appends =[
      'amount_format'
    ];

    public function getAmountFormatAttribute(): string
    {
        return MoneyHelper::convert($this->amount);
    }
}
