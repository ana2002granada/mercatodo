<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ShowProductsTest extends testCase
{
    use RefreshDatabase;

    public function testAnAuthenticatedUserCanSeeProductDetail(): void
    {
        $userAdmin = User::factory()->create();
        Passport::actingAs($userAdmin);

        $product = Product::factory()->create();
        $response = $this->getJson(route('api.products.show', $product));

        $response->assertOk();
        $response->assertSessionHasNoErrors();
    }

    public function testAnUnauthenticatedUserPermissionsCanNotSeeProductDetail(): void
    {
        $product = Product::factory()->create();
        $response = $this->getJson(route('api.products.show', $product));

        $response->assertUnauthorized();
    }
}
