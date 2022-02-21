<?php

namespace Tests\Admin\Products;

use App\Constants\Permissions;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class EditProductsTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanSeeProductEditForm(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCTS_UPDATE)
        );
        $product = Product::factory()->create();
        $response = $this->get(route('admin.products.edit', $product));

        $response->assertOk();
        $response->assertViewIs('admin.products.edit');
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithoutPermissionsCanNotSeeProductEditForm(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $product = Product::factory()->create();

        $response = $this->get(route('admin.products.edit', $product));
        $response->assertForbidden();
    }
}
