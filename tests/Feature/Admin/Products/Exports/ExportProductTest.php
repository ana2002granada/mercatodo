<?php

namespace Tests\Feature\Admin\Products\Exports;

use App\Constants\Permissions;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ExportProductTest extends TestCase
{
    public function testAnUserWithPermissionsCanExport(): void
    {
        Excel::fake();

        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCT_EXPORT)
        );

        $this->get(route('admin.products.export'));
        Excel::assertQueued('products.xlsx', 'public');
    }

    public function testAnUserWithoutPermissionsCanExport(): void
    {
        Excel::fake();

        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);

        $response = $this->get(route('admin.products.export'));
        $response->assertForbidden();
    }
}
