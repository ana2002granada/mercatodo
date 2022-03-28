<?php

namespace App\Console\Commands;

use App\Constants\PaymentStatus;
use App\Jobs\QueryPaymentJob;
use App\Models\Payment;
use Illuminate\Console\Command;

class ResolvedPaymentTransactionCommand extends Command
{
    protected $signature = 'payment:resolved';

    protected $description = 'This resolves pending payments';

    public function handle()
    {
        $payments = Payment::whereIn('status', [PaymentStatus::PENDING, PaymentStatus::PROCESSING])
            ->get();
        foreach ($payments as $payment) {
            QueryPaymentJob::dispatch($payment);
        }
    }
}
