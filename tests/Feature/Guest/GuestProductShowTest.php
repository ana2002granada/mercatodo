<?php

namespace Tests\Feature\Guest;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestProductShowTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserCanSeeProductDetail(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $response = $this->get(route('guest.products.show', $product));

        $response->assertOk();
        $response->assertViewIs('guest.products.show');
        $response->assertSessionHasNoErrors();
    }
}
