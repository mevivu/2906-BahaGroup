<?php

namespace App\Admin\Services\Review;

use App\Admin\Services\Review\ReviewServiceInterface;
use App\Admin\Repositories\Review\ReviewRepositoryInterface;
use App\Admin\Traits\AuthService;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use App\Api\V1\Repositories\Order\OrderRepositoryInterface;
use App\Enums\Order\OrderReview;
use App\Traits\UseLog;
use Exception;
use Illuminate\Support\Facades\DB;

class ReviewService implements ReviewServiceInterface
{
    use Setup, UseLog, AuthService;
    protected $data;
    protected $repository;
    protected $orderRepository;

    public function __construct(
        ReviewRepositoryInterface $repository,
        OrderRepositoryInterface $orderRepository,
    ) {
        $this->repository = $repository;
        $this->orderRepository = $orderRepository;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $this->data['user_id'] = $this->getCurrentUserId();
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->findOrFail($this->data['order_id']);
            foreach ($order->details as $detail) {
                $this->data['product_id'] = $detail->product_id;
                $this->repository->create($this->data);
            }
            $order->update(['is_reviewed' => OrderReview::Reviewed]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            $this->logError('Failed to process review: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();

        DB::beginTransaction();
        try {
            $this->repository->update($this->data['id'], $this->data);
            DB::commit();
            return true;
        } catch (Exception $e) {

            $this->logError('Failed to process review: ', $e);
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
