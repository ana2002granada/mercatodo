<?php

namespace Database\Seeders;

use App\Constants\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $this->setRoles();
    }

    public function setRoles(): void
    {
        foreach (Roles::getAll() as $role) {
            Role::findOrCreate($role);
        }
    }
}
