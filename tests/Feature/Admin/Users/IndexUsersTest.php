<?php

namespace Tests\Admin\Users;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class IndexUsersTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithoutCanNotListUsers(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.users.index'));
        $response->assertForbidden();
    }
}
