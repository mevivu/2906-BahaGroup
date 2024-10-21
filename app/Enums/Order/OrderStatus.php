<?php

namespace App\Enums\Order;

use App\Supports\Enum;

enum OrderStatus: int
{
    use Enum;

        // Chờ xác nhận
    case Pending = 1;
        // Đã xác nhận
    case Confirmed = 2;
        // Hủy bỏ
    case Cancelled = 3;

    public function badge(): string
    {
        return match ($this) {
            self::Pending => 'bg-orange',
            self::Confirmed => 'bg-blue',
            self::Cancelled => 'bg-red',
        };
    }
}
