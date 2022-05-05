<?php

namespace App\Models;

use App\Helpers\MoneyHelper;
use App\Models\Traits\Payments\HasPaymentRoutes;
use App\Models\Traits\Payments\HasPaymentStatus;
use App\Models\Traits\Payments\ReportPayments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Payment extends Model
{
    use HasPaymentStatus;
    use HasFactory;
    use HasPaymentRoutes;
    use ReportPayments;

    protected $fillable = [
        'reference',
        'receipt',
        'payer_document',
        'payer_address',
        'description',
        'amount',
        'status',
        'paid_at',
        'process_url',
        'request_id',
        'user_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->using(PaymentProduct::class)
            ->withPivot('amount', 'count');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAmountFormatAttribute(): string
    {
        return MoneyHelper::convert($this->amount);
    }
}
