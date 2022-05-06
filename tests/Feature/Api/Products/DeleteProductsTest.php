<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DeleteProductsTest extends testCase
{
    use RefreshDatabase;

    public function testAnAuthenticatedUserCanDeleteAProduct(): void
    {
        $userAdmin = User::factory()->create();
        Passport::actingAs($userAdmin);

        $product = Product::factory()->create();
        $response = $this->deleteJson(route('api.products.destroy', $product));

        $response->assertOk();
        $this->assertEmpty($product->fresh());
    }

    public function testAnUnauthenticatedUserCanNotDeleteAProduct(): void
    {
        $product = Product::factory()->create();
        $response = $this->deleteJson(route('api.products.destroy', $product));

        $response->assertUnauthorized();
        $this->assertNotEmpty($product->fresh());
    }
}
