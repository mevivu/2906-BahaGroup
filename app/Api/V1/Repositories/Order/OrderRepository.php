<?php

namespace App\Api\V1\Repositories\Order;

use App\Admin\Repositories\Order\OrderRepository as AdminOrderRepository;
use App\Api\V1\Repositories\Order\OrderRepositoryInterface;
use App\Enums\Order\OrderStatus;

class OrderRepository extends AdminOrderRepository implements OrderRepositoryInterface
{
    public function getByKeyAuthCurrent($filter)
    {
        $this->instance = $this->model->currentAuth()
            ->with('details');
        foreach ($filter as $column => $value) {
            $this->instance = $this->instance->where($column, $value);
        }
        $this->instance = $this->instance->orderBy('id', 'desc')->get();
        return $this->instance;
    }

    public function findOrFail($id)
    {
        $this->instance = $this->model->findOrFail($id);

        $this->authorize('view', 'sanctum');

        return $this->instance;
    }
}
