<?php

namespace App\Models;

use App\Enums\DefaultActiveStatus;
use App\Enums\Product\ProductInStock;
use App\Enums\Product\ProductManagerStock;
use App\Enums\Product\ProductStatus;
use App\Supports\Eloquent\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use App\Enums\Product\ProductType;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'products';

    protected $guarded = [];

    protected $fillable = [
        'type', // Loại sản phẩm
        'name', // Tên sản phẩm
        'price', // Giá sản phẩm
        'promotion_price', // Giá khuyến mãi
        'sku', // Mã SKU
        'manager_stock', // Quản lý kho
        'qty', // Số lượng
        'in_stock', // Còn hàng
        'is_active', // Hoạt động
        'avatar', // Ảnh
        'gallery', // Bộ sưu tập ảnh
        'desc', // Mô tả
        'informations', // Thông tin chi tiết
        'store_id', // ID cửa hàng
        'is_featured', // Nổi bật
    ];

    protected $columnSlug = 'name';


    protected static function boot()
    {
        parent::boot();
    }

    protected $casts = [
        'gallery' => AsArrayObject::class,
        'type' => ProductType::class,
        'is_active' => ProductStatus::class,
        'in_stock' => ProductInStock::class,
        'manager_stock' => ProductManagerStock::class,
        'is_featured' => DefaultActiveStatus::class,
        'price' => 'double',
        'promotion_price' => 'double'
    ];
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'products_categories', 'product_id', 'category_id')->orderBy('position', 'asc');
    }
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, ProductAttribute::class, 'product_id', 'attribute_id')->orderBy('position', 'asc');
    }
    public function productAttributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class, 'product_id')->orderBy('position', 'asc');
    }

    public function productVariations(): HasMany
    {
        return $this->hasMany(ProductVariation::class, 'product_id')->orderBy('position', 'asc');
    }

    public function getMinPromotionPriceAttribute()
    {
        return $this->productVariations->min('promotion_price');
    }
    public function getMaxPromotionPriceAttribute()
    {
        return $this->productVariations->max('promotion_price');
    }

    public function getTotalQtyAttribute()
    {
        return $this->productVariations->sum('qty');
    }
    public function productVariation(): HasOne
    {
        return $this->hasOne(ProductVariation::class, 'product_id');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function scopeUserDiscount($query)
    {
        return $query->where('is_user_discount', true);
    }
    public function scopeSimple($query)
    {
        return $query->where('type', ProductType::Simple);
    }
    public function scopeVariable($query)
    {
        return $query->where('type', ProductType::Variable);
    }

    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }

    public function getAvgRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }
    public function getTotalSoldAttribute()
    {
        return $this->order_details->count();
    }

    public function isSimple()
    {
        if ($this->type == ProductType::Simple) {
            return true;
        }
        return false;
    }
}
