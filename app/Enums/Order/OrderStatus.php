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
            self::Pending => 'bg-yellow-lt',
            self::Confirmed => 'bg-blue-lt',
            self::Completed => 'bg-green-lt',
            self::Cancelled => 'bg-red-lt',
        };
    }

}
