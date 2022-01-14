<?php

namespace App\Policies;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can(Permissions::CATEGORIES_CREATE);
    }

    public function update(User $user): bool
    {
        return $user->can(Permissions::CATEGORIES_UPDATE);
    }

    public function delete(User $user): bool
    {
        return $user->can(Permissions::CATEGORIES_DELETE);
    }
}
