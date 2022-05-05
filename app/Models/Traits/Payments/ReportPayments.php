<?php

namespace App\Models\Traits\Payments;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait ReportPayments
{
    public static function paymentsReport(): Collection
    {
        return self::select('status', DB::raw('count(*) as total'))->groupBy('status')
            ->get();
    }
}
