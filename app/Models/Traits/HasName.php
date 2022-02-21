<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasName
{
    public function scopeNameField(Builder $query, ?string $search): Builder
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}
