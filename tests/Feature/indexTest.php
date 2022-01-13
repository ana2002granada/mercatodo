<?php

namespace Tests\Feature;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class indexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @param string $route
     * @param string|null $permission
     * @return void
     * @dataProvider routeProvider
     */
    public function testAnUserWithPermissionsCantList(string $route, ?string $permission): void
    {
        $user = User::factory()->create();
        if ($permission) {
            $user->syncPermissions(
                Permission::findOrCreate($permission)
            );
        }
        $response = $this->actingAs($user)->get(route($route));
        $response->assertOk();
    }

    public function routeProvider(): array
    {
        return [
            'its is for user index' => ['route' => 'users.index', 'permission' => Permissions::USERS_INDEX],
            'its is for categories index' => ['route' => 'categories.index', 'permission' => null],
        ];
    }
}
