<?php

namespace App\Models;

use App\Helpers\MoneyHelper;
use App\Models\Traits\Products\ReportProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PaymentProduct extends Pivot
{
    use HasFactory;
    use ReportProducts;

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
