<?php

namespace App\Models;

use App\Enums\DefaultStatus;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\OrderType;
use App\Enums\Payment\PaymentMethod;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        /** ID của người dùng */
        'user_id',
        /** Phương thức thanh toán */
        'payment_method',
        /** Địa chỉ giao hàng */
        'address',
        /** Tổng tiền của đơn hàng */
        'total',
        /** Trạng thái của đơn hàng */
        'status',
        /** Ghi chú cho đơn hàng */
        'note',
        /** Tên người nhận khác */
        'name_other',
        /** Địa chỉ người nhận khác */
        'address_other',
        /** Số điện thoại người nhận khác */
        'phone_other',
        /** Ghi chú người nhận khác */
        'note_other',
        /** ward_id */
        'ward_id',
        /** province_id */
        'province_id',
        /** district_id */
        'district_id',
        /** Giá trị giảm */
        'discount_value',
        /** code */
        'code'
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'payment_method' => PaymentMethod::class,
        'order_type' => OrderType::class,
        'is_deleted' => DefaultStatus::class,
        'total' => 'double',
        'departure_time' => 'datetime',
    ];


    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id')->orderBy('id', 'desc');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function discount(): HasOneThrough
    {
        return $this->hasOneThrough(Discount::class, DiscountApplication::class, 'order_id', 'id', 'id', 'discount_code_id');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
