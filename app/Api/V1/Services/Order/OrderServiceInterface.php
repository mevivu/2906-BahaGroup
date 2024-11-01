<?php

namespace App\Api\V1\Services\Order;

use Illuminate\Http\Request;

interface OrderServiceInterface
{
    public function cancel($id);
}
