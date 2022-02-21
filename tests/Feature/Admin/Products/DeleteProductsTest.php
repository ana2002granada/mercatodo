<?php

namespace Tests\Admin\Products;

use App\Constants\Permissions;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteProductsTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanDeleteAProduct(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCTS_DELETE),
        );

        $product = Product::factory()->create();
        $response = $this->delete(route('admin.products.destroy', $product));

        $response->assertRedirect();
        $this->assertEmpty($product->fresh());
    }

    public function testAnUserWithoutPermissionsCanNotDeleteAProduct(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::factory()->create();
        $response = $this->delete(route('admin.products.destroy', $product));

        $response->assertForbidden();
        $this->assertNotEmpty($product->fresh());
    }
}
