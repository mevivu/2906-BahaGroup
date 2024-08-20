<?php

namespace App\Enums\Notification;

use App\Supports\Enum;

enum NotificationType: int
{
    use Enum;
    case All = 1;
    case Driver = 2;
    case Store = 3;
    case Customer = 4;
}
