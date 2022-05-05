<?php

namespace App\Models;

use App\Models\Traits\Imports\HasImportRoutes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Import extends Model
{
    use HasFactory;
    use HasImportRoutes;

    protected $fillable = [
        'user_id',
        'status',
        'errors',
    ];

    protected $casts = [
      'errors' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
