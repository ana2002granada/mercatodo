<?php

namespace App\Events;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductsChanged
{
    use Dispatchable;
    use SerializesModels;

    public string $action;
    public Product $product;
    public ?User $user;

    public function __construct(string $action, Product $product, ?User $user)
    {
        $this->action = $action;
        $this->product = $product;
        $this->user = $user;
    }
}
