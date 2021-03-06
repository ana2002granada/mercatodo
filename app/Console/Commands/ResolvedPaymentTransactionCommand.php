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

    public function handle(): void
    {
        $payments = Payment::where('status', PaymentStatus::PENDING)
            ->get();
        foreach ($payments as $payment) {
            $this->info('Processing payment: ' . $payment->id);
            QueryPaymentJob::dispatch($payment);
            $this->info('Processed payment: ' . $payment->id);
        }
        $this->info('All payment are processed');
    }
}
