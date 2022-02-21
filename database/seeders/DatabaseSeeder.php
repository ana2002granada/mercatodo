<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UserAdminSeeder::class);
    }
}
