<?php

namespace App\Models\Traits\Categories;

trait HasCategoryRoutes
{
    public static function indexRoute(): string
    {
        return route('admin.categories.index');
    }

    public static function createRoute(): string
    {
        return route('admin.categories.create');
    }

    public static function storeRoute(): string
    {
        return route('admin.categories.store');
    }

    public function showRoute(): string
    {
        return route('admin.categories.show', $this);
    }

    public function showGuestRoute(): string
    {
        return route('guest.categories.show', $this);
    }

    public function editRoute(): string
    {
        return route('admin.categories.edit', $this);
    }

    public function updateRoute(): string
    {
        return route('admin.categories.update', $this);
    }

    public function deleteRoute(): string
    {
        return route('admin.categories.destroy', $this);
    }

    public function toggleRoute(): string
    {
        return route('admin.categories.toggle', $this);
    }
}
