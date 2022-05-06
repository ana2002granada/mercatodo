<?php

namespace Tests\Feature\Guest;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardIndexTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserCanSeeHomeView(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $response = $this->get(route('home', $product, $category));

        $response->assertOk();
        $response->assertViewIs('dashboard');
        $response->assertSessionHasNoErrors();
    }
}
