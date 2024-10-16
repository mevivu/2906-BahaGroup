<?php

namespace App\Enums\Category;

use App\Supports\Enum;

enum HomeSliderOption: int
{
    use Enum;

    case Active = 1;

    case InActive = 2;
    public function badge(): string
    {
        return match ($this) {
            self::Active => 'bg-yellow-lt',
            self::InActive => 'bg-green-lt',
        };
    }
}
