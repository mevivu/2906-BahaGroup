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
        'note_other'
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

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->BelongsTo(Vehicle::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }


}
