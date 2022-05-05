<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMetricResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'label' => trans('payments.status.' . $this->status),
            'total' => $this->total,
        ];
    }
}
