<?php

namespace App\Models\Traits;

trait HasUserRoutes
{
    public static function indexRoute(): string
    {
        return route('admin.users.index');
    }

    public function showRoute(): string
    {
        return route('admin.users.show', $this);
    }

    public function editRoute(): string
    {
        return route('admin.users.edit', $this);
    }

    public function updateRoute(): string
    {
        return route('admin.users.update', $this);
    }

    public function deleteRoute(): string
    {
        return route('admin.users.destroy', $this);
    }

    public function toggleRoute(): string
    {
        return route('admin.users.toggle', $this);
    }
}
