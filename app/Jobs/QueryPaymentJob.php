<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Services\Contracts\GatewayPaymentContract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueryPaymentJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Payment $payment;
    protected GatewayPaymentContract $gateway;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->gateway = resolve(GatewayPaymentContract::class);
    }

    public function handle(): void
    {
        $this->gateway->query($this->payment);
    }
}
