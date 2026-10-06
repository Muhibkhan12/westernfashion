<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasUuids;
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'sale_price', 'status', 'featured',
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