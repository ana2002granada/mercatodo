<?php

namespace App\Policies;

use App\Constants\Permissions;
use App\Models\User;

class ReportPolicy
{
    public function reports(User $user): bool
    {
        return $user->can(Permissions::REPORTS);
    }
}
