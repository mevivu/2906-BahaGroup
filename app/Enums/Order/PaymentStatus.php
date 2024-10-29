<?php

namespace App\Enums\Order;

use App\Supports\Enum;

enum PaymentStatus: int
{
    use Enum;

    case UnPaid = 1;
    case Paid = 2;
}
