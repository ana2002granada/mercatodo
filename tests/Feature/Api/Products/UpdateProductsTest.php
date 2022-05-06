<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateProductsTest extends testCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAnAuthenticatedUserCanUpdateAProduct(): void
    {
        $userAdmin = User::factory()->create();
        Passport::actingAs($userAdmin);

        $product = Product::factory()->create();

        $data = array_merge(Product::factory()->make()->toArray(), [
            'name' => $this->faker->name,
            'category_id' => (string)$product->category_id,
            'price' => '10000.10',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ]);

        $response = $this->patchJson(route('api.products.update', $product), $data);
        $response->assertSuccessful();
        $this->assertDatabaseHas('products', ['name' => $data['name']]);
    }

    public function testAnAuthenticatedUserCannotUpdateAProductWithInvalidData(): void
    {
        $userAdmin = User::factory()->create();
        Passport::actingAs($userAdmin);

        $data = [];
        $product = Product::factory()->create();
        $response = $this->patch(route('api.products.update', $product), $data);
        $response->assertRedirect();
        $response->assertSessionHasErrors();
    }

    public function testAnUnauthenticatedUserCanNotCreateAProduct(): void
    {
        $product = Product::factory()->create();

        $data = array_merge(Product::factory()->make()->toArray(), [
            'name' => $this->faker->name,
            'category_id' => (string)$product->category_id,
            'price' => '10000.10',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ]);
        $response = $this->patchJson(route('api.products.update', $product), $data);
        $response->assertUnauthorized();
    }
}
