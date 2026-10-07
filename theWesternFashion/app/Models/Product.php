<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasUuids;
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'sale_price', 'status', 'featured','reorder_level',
    ];

    protected $casts = ['featured' => 'boolean'];

    public function getStatusAttribute($value)
    {
        return $value ? 'active' : 'draft';
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = in_array($value, ['active', 1, '1', true], true) ? 1 : 0;
    }
    
        public function totalStock(): int
    {
        return (int) $this->variants->sum('stock');
    }

    public function stockStatus(): string
    {
        $total = $this->totalStock();

        return match (true) {
            $total === 0                          => 'Out of stock',
            $total <= (int) $this->reorder_level  => 'Low stock',
            default                               => 'In stock',
        };
    }

    public function stockValue(): float
    {
        return $this->variants->sum(fn ($v) => $v->stock * (float) $v->price);
    }

    public function scopeWithInventory($q)
    {
        return $q->with(['category', 'variants']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}