<?php

namespace App\Models;

use App\Helpers\MoneyHelper;
use App\Http\Requests\Admin\FormProductRequest;
use App\Models\Traits\HasProductRoutes;
use App\Models\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    use HasStatus;
    use HasProductRoutes;

    protected $fillable = [
        'name',
        'price',
        'stock',
        'category_id',
    ];

    protected $appends = [
        'image_route',
        'amount',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getShowRouteAttribute(): string
    {
        return $this->showGuestRoute();
    }

    public function getImageRouteAttribute()
    {
        return '/storage/' . $this->image;
    }

    public function getAmountAttribute(): string
    {
        return MoneyHelper::convert($this->price);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->when($search, function ($query, $search) {
            $query->byNameOrDescription($search)->categoryName($search);
        });
    }

    public function scopeByNameOrDescription(Builder $query, ?string $search): Builder
    {
        return $query->select('*')
            ->selectRaw('
                match(name, description)
                against(? in natural language mode) as score
            ', [$search])
            ->whereRaw('
                match(name, description)
                against(? in natural language mode) > 0.0000001
            ', [$search]);
    }

    public function scopeWithStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeCategoryName(Builder $query, ?string $search): Builder
    {
        return $query->OrWhereHas('category', function ($query) use ($search) {
            $query->nameField($search);
        });
    }

    public function scopePriceFilter(Builder $query, ?string $start, ?string $end): Builder
    {
        return $query->when($start, function ($query) use ($start) {
            $query->where('price', '>=', $start);
        })->when($end, function ($query) use ($end) {
            $query->where('price', '<=', $end);
        });
    }

    public function scopeCategoryFilter(Builder $query, ?string $category): Builder
    {
        return $query->when($category, function ($query) use ($category) {
            $query->where('category_id', $category);
        });
    }

    public static function storeOrUpdateProduct(FormProductRequest $request, ?Product $product = null): Product
    {
        if (!$product) {
            $product = new Product();
            $product->uuid = (string) Str::uuid();
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->category_id = $request->category;

        if ($request->file('image')) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            $product->image = $request->file('image')->storeAs('products', $product->uuid . '_' . $request->file('image')->hashName());
        }

        $product->save();

        return $product;
    }
}
