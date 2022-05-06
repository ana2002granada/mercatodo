<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Tests\TestCase;

class StoreProductsTest extends testCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testAnAuthenticatedUserCanCreateAProduct(): void
    {
        $userAdmin = User::factory()->create();
        Passport::actingAs($userAdmin);

        $category = Category::factory()->create()->id;

        $data = array_merge(Product::factory()->make()->toArray(), [
            'name' => $this->faker->name,
            'category_id' => (string)$category,
            'price' => '10000.10',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ]);

        $response = $this->postJson(route('api.products.store'), $data);
        $this->assertDatabaseHas('products', ['name' => $data['name']]);
        $response->assertSuccessful();
    }

    public function testAnAuthenticatedUserCannotCreateAProductWithInvalidData(): void
    {
        $userAdmin = User::factory()->create();
        Passport::actingAs($userAdmin);

        $data = [
            'name' => $this->faker->name,
        ];

        $this->postJson(route('api.products.store'), $data);
        $this->assertDatabaseMissing('products', ['name' => $data['name']]);
    }

    public function testAnUnauthenticatedUserCanNotCreateAProduct(): void
    {
        $category = Category::factory()->create()->id;

        $data = array_merge(Product::factory()->make()->toArray(), [
            'name' => $this->faker->name,
            'category_id' => (string)$category,
            'price' => '10000.10',
            'image' => UploadedFile::fake()->create('prueba.png', '512', 'png'),
        ]);

        $response = $this->postJson(route('api.products.store'), $data);
        $response->assertUnauthorized();
    }

}
