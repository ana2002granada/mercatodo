<?php

namespace Tests\Admin\Products;

use App\Constants\Permissions;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class StoreProductsTest extends testCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAnUserWithPermissionsCanCreateAProduct(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCTS_CREATE),
            Permission::findOrCreate(Permissions::PRODUCTS_SHOW)
        );

        $category = Category::factory()->create()->id;

        $data = array_merge(Product::factory()->make()->toArray(), [
            'name' => $this->faker->name,
            'category_id' => (string)$category,
            'price' => '10000.10',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ]);

        $response = $this->post(route('admin.products.store'), $data);
        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['name' => $data['name']]);
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithPermissionsCannotCreateAProductWithInvalidData(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCTS_CREATE),
            Permission::findOrCreate(Permissions::PRODUCTS_SHOW)
        );

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->post(route('admin.products.store'), $data);
        $this->assertDatabaseMissing('products', ['name' => $data['name']]);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
    }

    public function testAnUserWithoutPermissionsCanNotCreateAProduct(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);

        $category = Category::factory()->create()->id;

        $data = array_merge(Product::factory()->make()->toArray(), [
            'name' => $this->faker->name,
            'category_id' => (string)$category,
            'price' => '10000.10',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ]);

        $response = $this->post(route('admin.products.store'), $data);
        $response->assertForbidden();
    }
}
