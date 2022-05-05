<?php

namespace Tests\Feature\Admin\Products;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CreateProductsTest extends testCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanSeeProductCreateForm(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCTS_CREATE)
        );
        $response = $this->get(route('admin.products.create'));

        $response->assertOk();
        $response->assertViewIs('admin.products.create');
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithoutPermissionsCanNotSeeProductCreateForm(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $response = $this->get(route('admin.products.create'));
        $response->assertForbidden();
    }
}
