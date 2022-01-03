<?php

namespace Database\Seeders;

use App\Constants\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserAdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminData = config('auth.admin');
        $user = User::where('email', $adminData['email'])->first();

        if (!$user) {
            $user = new User();
            $user->name = $adminData['name'];
            $user->last_name = $adminData['last_name'];
            $user->email = $adminData['email'];
            $user->password = Hash::make($adminData['password']);
            $user->email_verified_at = now();
            $user->save();
        }

        $role = Role::findByName(Roles::ADMIN);
        $user->syncRoles($role);
    }
}
