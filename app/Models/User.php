<?php

namespace App\Models;

use App\Models\Traits\Users\HasUserRoutes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasUserRoutes;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function fullname(): string
    {
        return strtolower($this->name . ' ' . $this->last_name);
    }

    public function image(): string
    {
        return 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $this->fullname()) ;
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function imports(): HasMany
    {
        return $this->hasMany(Import::class);
    }
}
