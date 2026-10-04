<?php
// NOTE: This is 3 models shown in one file for easy reading.
// Put each one in its own file inside app/Models/

// ============================================================
// app/Models/Product.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'sale_price', 'status', 'featured',
    ];

    // A product belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A product has many images
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    // A product has many variants (size/color combinations)
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}

// ============================================================
// app/Models/ProductImage.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image_path', 'is_primary', 'sort_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

// ============================================================
// app/Models/ProductVariant.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'sku', 'size', 'color', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}