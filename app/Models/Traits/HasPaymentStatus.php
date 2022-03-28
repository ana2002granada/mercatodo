<?php

namespace App\Models\Traits;

use App\Constants\PaymentStatus;
use Illuminate\Database\Eloquent\Builder;

trait HasPaymentStatus
{
    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function isPending(): bool
    {
        return $this->status === PaymentStatus::PENDING;
    }

    public function isProcessing(): bool
    {
        return $this->status === PaymentStatus::PROCESSING;
    }


    public function isUnprocessed(): bool
    {
        return $this->isPending() || $this->isProcessing();
    }

    public function isSuccessful(): bool
    {
        return $this->status === PaymentStatus::SUCCESSFUL;
    }

    public function isRejected(): bool
    {
        return $this->status === PaymentStatus::REJECTED;
    }

    public function isCanceled(): bool
    {
        return $this->status === PaymentStatus::CANCELED;
    }
}
