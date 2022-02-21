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

class StoreCategoriesTest extends testCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAnUserWithPermissionsCanCreateACategory(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_CREATE),
            Permission::findOrCreate(Permissions::CATEGORIES_SHOW)
        );

        $data = [
            'name' => $this->faker->name,
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ];

        $response = $this->post(route('admin.categories.store'), $data);
        $this->assertDatabaseHas('categories', ['name' => $data['name']]);
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithPermissionsCannotCreateACategoryWithInvalidData(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::CATEGORIES_CREATE),
            Permission::findOrCreate(Permissions::CATEGORIES_SHOW)
        );

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->post(route('admin.categories.store'), $data);
        $this->assertDatabaseMissing('categories', ['name' => $data['name']]);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
    }

    public function testAnUserWithoutPermissionsCanNotCreateACategory(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $response = $this->post(route('admin.categories.store'), [
            'name' => 'Tests',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png')
        ]);
        $response->assertForbidden();
    }
}
