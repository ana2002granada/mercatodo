<?php

namespace Tests\Admin\Users;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ShowUsersTest extends testCase
{
    use RefreshDatabase;
    public function testAnUserWithPermissionsCanSeeAnUsersDetail()
    {
        $userAdmin = User::factory()->create();
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::USERS_SHOW)
        );
        $user = User::factory()->create();
        $response = $this->actingAs($userAdmin)->get(route('users.show', $user));

        $response->assertOk();
        $response->assertViewIs('admin.users.show');
        $response->assertViewHas('user');
        $response->assertSessionHasNoErrors();
    }
    public function testAnUserWithoutPermissionsCanNotSeeAnUsersDetail()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('users.show', $user));

        $response->assertForbidden();
    }
}
