<?php

namespace App\Models\Traits\Products;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait ReportProducts
{
    public static function mostPurchasedProducts(): Collection
    {
        return self::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->with('product:id,name')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->makeHidden(['amount_format', 'amount']);
    }
}
