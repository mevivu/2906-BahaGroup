<?php

namespace App\Enums\Order;

use App\Supports\Enum;

enum OrderReview: int
{
    use Enum;

    case Not_Reviewed = 0;
    case Reviewed = 1;
}
