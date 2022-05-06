<?php

namespace Tests\Feature\Guest;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestCategoryShowTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserCanSeeCategoryDetail(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        $response = $this->get(route('guest.categories.show', $category));

        $response->assertOk();
        $response->assertViewIs('guest.categories.show');
        $response->assertSessionHasNoErrors();
    }
}
