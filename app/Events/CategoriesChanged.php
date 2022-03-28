<?php

namespace App\Events;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CategoriesChanged
{
    use Dispatchable;
    use SerializesModels;

    public string $action;
    public Category $category;
    public ?User $user;

    public function __construct(string $action, Category $category, ?User $user)
    {
        $this->action = $action;
        $this->category = $category;
        $this->user = $user;
    }
}
