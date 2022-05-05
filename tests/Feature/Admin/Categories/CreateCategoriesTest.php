<?php

namespace Tests\Feature\Admin\Categories;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CreateCategoriesTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanSeeCategoryCreateForm(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_CREATE)
        );
        $response = $this->get(route('admin.categories.create'));

        $response->assertOk();
        $response->assertViewIs('admin.categories.create');
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithoutPermissionsCanNotSeeCategoryCreateForm(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $response = $this->get(route('admin.categories.create'));
        $response->assertForbidden();
    }
}
