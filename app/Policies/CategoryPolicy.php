<?php

namespace App\Policies;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;
    public function view(User $user): bool
    {
        return $user->can(Permissions::CATEGORIES_SHOW);
    }

}
