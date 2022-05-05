<?php

namespace App\Events;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionIsApproved
{
    use Dispatchable;
    use SerializesModels;

    public Payment $payment;
    public User $user;

    public function __construct(Payment $payment, User $user)
    {
        $this->payment = $payment;
        $this->user = $user;
    }
}
