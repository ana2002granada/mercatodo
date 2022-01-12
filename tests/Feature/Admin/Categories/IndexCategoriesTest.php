<?php

namespace Tests\Admin\Users;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class IndexCategoriesTest extends testCase
{
    use RefreshDatabase;
    public function testAnAuthUserCanListCategories()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('categories.index'));
        $response->assertOk();
    }
}
