<?php

namespace Tests\Admin\Products;

use App\Constants\Permissions;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Faker\Provider\File;
use Faker\Provider\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UpdateProductsTest extends testCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAnUserWithPermissionsCanUpdateAProduct(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCTS_UPDATE),
            Permission::findOrCreate(Permissions::PRODUCTS_SHOW)
        );

        $product = Product::factory()->create();

        $data = array_merge(Product::factory()->make()->toArray(), [
            'name' => $this->faker->name,
            'category' => (string)$product->category_id,
            'price' => '10000.10',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ]);

        $response = $this->patch(route('admin.products.update', $product), $data);
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('Products', ['name' => $data['name']]);
    }

    public function testAnUserWithPermissionsCannotUpdateAProductWithInvalidData(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCTS_UPDATE),
            Permission::findOrCreate(Permissions::PRODUCTS_SHOW)
        );

        $data = [];
        $product = Product::factory()->create();
        $response = $this->patch(route('admin.products.update', $product), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
    }

    public function testAnUserWithoutPermissionsCanNotCreateAProduct(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $product = Product::factory()->create();

        $data = array_merge(Product::factory()->make()->toArray(), [
            'name' => $this->faker->name,
            'category' => (string)$product->category_id,
            'price' => '10000.10',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ]);
        $response = $this->patch(route('admin.products.update', $product), $data);
        $response->assertForbidden();
    }
}
