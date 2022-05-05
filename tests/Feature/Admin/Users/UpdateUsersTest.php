<?php

namespace Tests\Admin\Users;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UpdateUsersTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanUpdateUsers(): void
    {
        $userAdmin = User::factory()->create();
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::USERS_UPDATE),
            Permission::findOrCreate(Permissions::USERS_INDEX)
        );
        $user = User::factory()->create();

        $data = array_merge($user->toArray(), [
            'name' => 'name',
        ]);

        $response = $this->actingAs($userAdmin)->patch(route('admin.users.update', $user), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $user->refresh();
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }

    public function testAnUserWithoutPermissionsCanNotUpdateUsers(): void
    {
        $user = User::factory()->create();

        $data = array_merge($user->toArray(), [
            'name' => 'Aname',
            'disabled_at' => false,
        ]);

        $response = $this->actingAs($user)->patch(route('admin.users.update', $user), $data);
        $response->assertForbidden();
    }

    public function testAnUserWithPermissionsCanNotUpdateWithAExistEmail(): void
    {
        $userExist = User::factory()->create();
        $data = [
            'name' => 'A name',
            'email' => $userExist->email,
        ];
        $user = User::factory()->create();
        $user->syncPermissions(
            Permission::findOrCreate(Permissions::USERS_UPDATE)
        );

        $response = $this->actingAs($user)->patch(route('admin.users.update', $user), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);
        $user = $user->refresh();

        $this->assertNotEquals($userExist->email, $user->email);
    }
}
