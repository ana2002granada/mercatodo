<?php

namespace Tests\Feature\Admin\Products;

use App\Constants\Permissions;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ShowProductsTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanSeeProductDetail(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCTS_SHOW)
        );
        $product = Product::factory()->create();
        $response = $this->get(route('admin.products.show', $product));

        $response->assertOk();
        $response->assertViewIs('admin.products.show');
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithoutPermissionsCanNotSeeProductDetail(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $product = Product::factory()->create();
        $response = $this->get(route('admin.products.show', $product));

        $response->assertForbidden();
    }
}
