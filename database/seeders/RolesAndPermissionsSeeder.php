<?php

namespace Database\Seeders;

use App\Constants\Permissions;
use App\Constants\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::findByName(Roles::ADMIN);
        $this->setPermissions($role);
    }

    public function setPermissions(Role $role): void
    {
        $permissions = [];
        foreach (Permissions::getAll() as $permission) {
            $permissions[] = Permission::findOrCreate($permission);
        }

        $role->syncPermissions($permissions);
    }
}
