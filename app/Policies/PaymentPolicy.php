<?php

namespace App\Policies;

use App\Constants\Permissions;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can(Permissions::PAYMENT_INDEX);
    }

    public function view(User $user, Payment $payment): bool
    {
        return $user->can(Permissions::PAYMENT_SHOW) || $payment->user_id === $user->id;
    }
}
