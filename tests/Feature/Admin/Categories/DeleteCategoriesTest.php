<?php

namespace Tests\Admin\Categories;

use App\Constants\Permissions;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteCategoriesTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissonsCanDeleteACategory(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_DELETE),
        );

        $category = Category::factory()->create();
        $response = $this->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect();
        $this->assertEmpty($category->fresh());
    }

    public function testAnUserWithoutPermissionsCanNotDeleteACategory(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $response = $this->delete(route('admin.categories.destroy', $category));

        $response->assertForbidden();
        $this->assertNotEmpty($category->fresh());
    }
}
