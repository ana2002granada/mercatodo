<?php

namespace App\Models;

use App\Http\Requests\Admin\FormCategoryRequest;
use App\Models\Traits\Categories\HasCategoryRoutes;
use App\Models\Traits\HasName;
use App\Models\Traits\HasStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    use HasStatus;
    use HasName;
    use HasCategoryRoutes;

    protected $fillable = [
        'uuid',
        'name',
        'image',
    ];

    protected $appends = [
        'show_route',
        'image_route',
        'products_count'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getShowRouteAttribute(): string
    {
        return $this->showGuestRoute();
    }

    public function getImageRouteAttribute(): string
    {
        return '/storage/' . $this->image;
    }

    public function getProductsCountAttribute(): string
    {
        return $this->products()->count();
    }

    public static function storeOrUpdateCategory(FormCategoryRequest $request, ?self $category = null): self
    {
        if (!$category) {
            $category = new self();
            $category->uuid = (string)Str::uuid();
        }

        $category->name = $request->name;

        if ($request->file('image')) {
            if ($category->image && Storage::exists($category->image)) {
                Storage::delete($category->image);
            }

            $category->image = $request->file('image')->storeAs('categories', $category->uuid . '_' . $request->file('image')->hashName());
        }
        $category->save();

        return $category;
    }

    public static function categoriesFromCache(): Collection
    {
        return Cache::tags('categories')->rememberForever('categories', function () {
            return self::orderBy('name')->get();
        });
    }

    public static function categoriesActiveFromCache(): Collection
    {
        return Cache::tags('categories')->rememberForever('categories-active', function () {
            return self::orderBy('name')->active()->get();
        });
    }
}
