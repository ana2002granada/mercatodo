<?php

namespace App\Models\Traits\Products;

trait HasProductRoutes
{
    public static function indexRoute(): string
    {
        return route('admin.products.index');
    }

    public static function createRoute(): string
    {
        return route('admin.products.create');
    }

    public static function storeRoute(): string
    {
        return route('admin.products.store');
    }

    public function showRoute(): string
    {
        return route('admin.products.show', $this);
    }

    public function showGuestRoute(): string
    {
        return route('guest.products.show');
    }

    public function editRoute(): string
    {
        return route('admin.products.edit', $this);
    }

    public function updateRoute(): string
    {
        return route('admin.products.update', $this);
    }

    public function deleteRoute(): string
    {
        return route('admin.products.destroy', $this);
    }

    public function toggleRoute(): string
    {
        return route('admin.products.toggle', $this);
    }
}
