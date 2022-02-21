<?php

namespace Tests\Admin\Categories;

use App\Constants\Permissions;
use App\Models\Category;
use App\Models\User;
use Faker\Provider\File;
use Faker\Provider\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UpdateCategoriesTest extends testCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAnUserWithPermissionsCanUpdateACategory(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_UPDATE),
            Permission::findOrCreate(Permissions::CATEGORIES_SHOW)
        );

        $category = Category::factory()->create();
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->patch(route('admin.categories.update', $category), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('categories', ['name' => $data['name']]);
    }

    public function testAnUserWithPermissionsCannotUpdateACategoryWithInvalidData(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_UPDATE),
            Permission::findOrCreate(Permissions::CATEGORIES_SHOW)
        );

        $data = [];
        $category = Category::factory()->create();
        $response = $this->patch(route('admin.categories.update', $category), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
    }

    public function testAnUserWithoutPermissionsCanNotCreateACategory(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $category = Category::factory()->create();
        $response = $this->patch(route('admin.categories.update', $category), ['name' => 'test']);
        $response->assertForbidden();
    }
}
