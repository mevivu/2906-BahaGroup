<?php

namespace App\Api\V1\Services\Order;

use App\Api\V1\Services\Order\OrderServiceInterface;
use App\Api\V1\Repositories\Order\{OrderRepositoryInterface, OrderDetailRepositoryInterface};
use App\Api\V1\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Order\OrderStatus;
use App\Traits\UseLog;
use Exception;

class OrderService implements OrderServiceInterface
{
    use AuthSupport, UseLog;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(
        OrderRepositoryInterface $repository,
    ) {
        $this->repository = $repository;
    }
    public function cancel($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->repository->findOrFail($id);
            if ($order->status != OrderStatus::Cancelled) {
                $this->repository->update($id, ['status' => OrderStatus::Cancelled]);
                DB::commit();
                return true;
            }
            return false;
        } catch (Exception $e) {
            $this->logError('Failed to cancel order: ', $e);
            DB::rollBack();
            return false;
        }
    }
}
