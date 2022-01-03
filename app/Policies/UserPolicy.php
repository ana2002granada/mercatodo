<?php

namespace App\Policies;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can(Permissions::USERS_INDEX);
    }

    public function view(User $user): bool
    {
        return $user->can(Permissions::USERS_SHOW);
    }


    public function update(User $user): bool
    {
        return $user->can(Permissions::USERS_UPDATE);
    }

    public function delete(User $user, Model $model): bool
    {
        return $user->can(Permissions::USERS_DELETE)  && $user->getKey() !== $model->getKey();
    }

    public function toggle(User $user, Model $model): bool
    {
        return $user->can(Permissions::USERS_TOGGLE)  && $user->getKey() !== $model->getKey();
    }
}
