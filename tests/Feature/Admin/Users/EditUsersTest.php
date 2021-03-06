<?php

namespace Tests\Feature\Admin\Users;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class EditUsersTest extends testCase
{
    use RefreshDatabase;
    public function testAnUserWithPermissionsCanSeeEditUsersForm(): void
    {
        $userAdmin = User::factory()->create();
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::USERS_UPDATE)
        );
        $user = User::factory()->create();
        $response = $this->actingAs($userAdmin)->get(route('admin.users.edit', $user));

        $response->assertOk();
        $response->assertViewIs('admin.users.edit');
        $response->assertViewHas('user');
    }

    public function testAnUserWithoutPermissionsCanNotSeeEditUsersForm(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.users.edit', $user));

        $response->assertForbidden();
    }
}
