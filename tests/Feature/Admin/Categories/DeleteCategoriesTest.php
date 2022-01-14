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

    public function testAnUserWithPermissonsCanDeleteACategory()
    {
        $userAdmin = User::factory()->create();
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_DELETE),
        );

        $category = Category::factory()->create();
        $response = $this->actingAs($userAdmin)->delete(route('categories.destroy', $category));

        $response->assertRedirect();
        $this->assertEmpty($category->fresh());
    }

    public function testAnUserWithoutPermissionsCanNotDeleteACategory()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->delete(route('categories.destroy', $category));

        $response->assertForbidden();
        $this->assertNotEmpty($category->fresh());
    }
}
