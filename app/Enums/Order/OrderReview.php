<?php

namespace App\Enums\Order;

use App\Supports\Enum;

enum OrderReview: int
{
    use Enum;

    case Not_Reviewed = 1;
    case Reviewed = 2;
}
