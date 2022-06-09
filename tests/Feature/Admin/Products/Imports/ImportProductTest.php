<?php

namespace Tests\Feature\Admin\Products\Imports;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ImportProductTest extends TestCase
{
    use RefreshDatabase;

    public function testAnUserWithPermissionsCanImport(): void
    {
        $userAdmin = User::factory()->create();
        $this->actingAs($userAdmin);
        $userAdmin->syncPermissions(
            Permission::findOrCreate(Permissions::PRODUCT_IMPORT)
        );

        $file = new UploadedFile(
            base_path('tests/Files/productsImport.xlsx'),
            'productsImport.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        Excel::fake();
        $response = $this->actingAs($userAdmin)->post(route('admin.products.import'), [
            'file' => $file,
        ]);
        $response->assertRedirect();
    }

    public function testAnUserWithoutPermissionsCanNotImport(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $file = new UploadedFile(
            base_path('tests/Files/productsImport.xlsx'),
            'productsImport.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        Excel::fake();
        $response = $this->actingAs($user)->post(route('admin.products.import'), [
            'file' => $file,
        ]);
        $response->assertRedirect();
    }
}
