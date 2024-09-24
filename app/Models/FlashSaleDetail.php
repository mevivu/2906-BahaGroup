<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlashSaleDetail extends Model
{
    use HasFactory;

    protected $table = 'flash_sales_products';
    protected $fillable = [
        /** ID flash sale */
        'flash_sale_id',
        /** Số lượng */
        'qty',
        /** Đã bán */
        'sold',
        /** ID sản phẩm */
        'product_id',
    ];

    protected $casts = [

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
