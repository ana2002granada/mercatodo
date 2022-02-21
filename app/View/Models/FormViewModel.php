<?php

namespace App\View\Models;

use Illuminate\Contracts\Support\Arrayable;

abstract class FormViewModel implements Arrayable
{
    protected bool $isEdit = false;

    public function title(): string
    {
        return $this->isEdit ? trans('dashboard.btnUpdate') : trans('users.actions.create');
    }

    public function getRoute(): string
    {
        return $this->isEdit ? $this->editRoute() : $this->createRoute();
    }

    abstract public function editRoute(): string;
    abstract public function createRoute(): string;
    abstract public function toArray(): array;
}
