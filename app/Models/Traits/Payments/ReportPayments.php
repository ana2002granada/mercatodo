<?php

namespace App\Models\Traits\Payments;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait ReportPayments
{
    public static function paymentsReport(): Collection
    {
        return self::select('status', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->subDays(1)->endOfDay()])
            ->groupBy('status')
            ->get();
    }
}
