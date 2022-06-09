<?php

namespace Tests\Feature\Admin\Categories;

use App\Constants\Permissions;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class EditCategoriesTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanSeeCategoryEditForm(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_UPDATE)
        );
        $category = Category::factory()->create();
        $response = $this->get(route('admin.categories.edit', $category));

        $response->assertOk();
        $response->assertViewIs('admin.categories.edit');
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithoutPermissionsCanNotSeeCategoryEditForm(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $category = Category::factory()->create();

        $response = $this->get(route('admin.categories.edit', $category));
        $response->assertForbidden();
    }
}
