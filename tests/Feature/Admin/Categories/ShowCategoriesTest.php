<?php

namespace Tests\Admin\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowCategoriesTest extends testCase
{
    use RefreshDatabase;
    public function testAnyUserCanSeeTheProductsOfACategory()
    {
        $userAdmin = User::factory()->create();

        $category= Category::factory()->create();
        $response = $this->actingAs($userAdmin)->get(route('categories.show', $category));

        $response->assertOk();
        $response->assertViewIs('admin.categories.show');

        $response->assertSessionHasNoErrors();
    }
}
