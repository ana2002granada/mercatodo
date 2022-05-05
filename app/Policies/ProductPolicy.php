<?php

namespace App\Policies;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can(Permissions::PRODUCTS_INDEX);
    }

    public function view(User $user): bool
    {
        return $user->can(Permissions::PRODUCTS_SHOW);
    }
    public function create(User $user): bool
    {
        return $user->can(Permissions::PRODUCTS_CREATE);
    }

    public function update(User $user): bool
    {
        return $user->can(Permissions::PRODUCTS_UPDATE);
    }

    public function delete(User $user): bool
    {
        return $user->can(Permissions::PRODUCTS_DELETE);
    }

    public function toggle(User $user): bool
    {
        return $user->can(Permissions::PRODUCTS_TOGGLE);
    }

    public function export(User $user): bool
    {
        return $user->can(Permissions::PRODUCT_EXPORT);
    }

    public function import(User $user): bool
    {
        return $user->can(Permissions::PRODUCT_IMPORT);
    }
}
