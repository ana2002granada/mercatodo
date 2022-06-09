<?php

namespace Tests\Feature\Admin\Users;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteUsersTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissonsCanDeleteAnUser(): void
    {
        $userAdmin = User::factory()->create();
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::USERS_DELETE),
            Permission::findOrCreate(Permissions::USERS_INDEX)
        );

        $user = User::factory()->create();
        $response = $this->actingAs($userAdmin)->delete(route('admin.users.destroy', $user));

        $response->assertRedirect();
        $this->assertEmpty($user->fresh());
    }

    public function testAnUserWithoutPermissionsCanNotDeleteAnUser(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('admin.users.destroy', $user));

        $response->assertForbidden();
        $this->assertNotEmpty($user->fresh());
    }

    public function testYouCanNotDeleteYourself(): void
    {
        $userAdmin = User::factory()->create();
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::USERS_DELETE),
            Permission::findOrCreate(Permissions::USERS_INDEX)
        );

        $response = $this->actingAs($userAdmin)->delete(route('admin.users.destroy', $userAdmin));

        $response->assertForbidden();
        $this->assertNotEmpty($userAdmin->fresh());
    }
}
