<?php

namespace Tests\Admin\Categories;

use App\Constants\Permissions;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ShowCategoriesTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanSeeCategoryDetail(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_SHOW)
        );
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.show', $category));

        $response->assertOk();
        $response->assertViewIs('admin.categories.show');
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithoutPermissionsCanNotSeeCategoryDetail(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.show', $category));

        $response->assertForbidden();
    }
}
