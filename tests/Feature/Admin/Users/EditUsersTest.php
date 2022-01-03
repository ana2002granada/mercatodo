<?php

namespace Tests\Admin\Users;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class EditUsersTest extends testCase
{
    use RefreshDatabase;
    public function testAnUserWithPermissionsCanSeeEditUsersForm()
    {
        $userAdmin = User::factory()->create();
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::USERS_UPDATE)
        );
        $user = User::factory()->create();
        $response = $this->actingAs($userAdmin)->get(route('users.edit', $user));

        $response->assertOk();
        $response->assertViewIs('admin.users.edit');
        $response->assertViewHas('user');
    }

    public function testAnUserWithoutPermissionsCanNotSeeEditUsersForm()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('users.edit', $user));

        $response->assertForbidden();
    }
}
