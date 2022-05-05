<?php

namespace Tests\Admin\Products;

use App\Constants\Permissions;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class StorePaymentTest extends testCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testCanStoreShoppingCartSuccessful(): void
    {
        $product = Product::factory()->create();
        $items =
            [
                "cart-items" =>
                    [
                        [
                            "id" => $product->id,
                            "name" => $product->name,
                            "count" => 5,
                            "stock" => $product->stock,
                            "price" => $product->price,
                        ]
                    ]
            ];

        Passport::actingAs(
            User::factory()->create()
        );
        $response = $this->postJson(route('api.payment.process'), $items);
        $this->assertDatabaseCount('payments', 1);
        $payment = Payment::first();
        $this->assertDatabaseCount('payment_product', 1);
        $this->assertDatabaseHas('payment_product', [
            'product_id' => $product->id,
            'payment_id' => $payment->id,
            'count' => 5,
       ]);
        $response->assertSessionHasNoErrors();
    }

    public function testAnUserWithoutAuthCanNotAccessToStoreShoppingCart(): void
    {
        $product = Product::factory()->create();
        $items =
            [
                "cart-items" =>
                    [
                        [
                            "id" => $product->id,
                            "name" => $product->name,
                            "count" => 5,
                            "stock" => $product->stock,
                            "price" => $product->price,
                        ]
                    ]
            ];

        $response = $this->postJson(route('api.payment.process'), $items);
        $response->assertUnauthorized();
    }

    public function testAnUserCanNotBuyProductsWithLessStock(): void
    {
        Passport::actingAs(
            User::factory()->create()
        );
        $product = Product::factory()->create();
        $items =
            [
                "cart-items" =>
                    [
                        [
                            "id" => $product->id,
                            "name" => $product->name,
                            "count" => $product->stock + 1,
                            "stock" => $product->stock,
                            "price" => $product->price,
                        ]
                    ]
            ];
        $response = $this->postJson(route('api.payment.process'), $items);
        $response->assertUnprocessable('error');
    }
}
