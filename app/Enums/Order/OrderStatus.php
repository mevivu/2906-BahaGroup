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
    // Hoàn thành
    case Completed = 3;
    // Hủy bỏ
    case Cancelled = 4;

    public function badge(): string
    {
        return match($this) {
            self::Pending => 'bg-orange',
            self::Confirmed => 'bg-blue',
            self::Completed => 'bg-green',
            self::Cancelled => 'bg-red',
        };
    }

}
