<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscountApplication extends Model
{
    use HasFactory;
    protected $table = 'discount_applications';
    public $timestamps = false;

    protected $fillable = [
        'discount_code_id',
        'user_id',
        'order_id'
    ];

    public function discountCode(): BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount_code_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
