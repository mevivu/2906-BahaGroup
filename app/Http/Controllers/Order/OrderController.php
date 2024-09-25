<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Admin\DataTables\Order\UserOrderDataTable;
use App\Admin\Traits\AuthService;
use App\Traits\ResponseController;

class OrderController extends Controller
{
    use ResponseController, AuthService;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderServiceInterface $service
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }
    public function getView(): array
    {
        return [
            'indexUser' => 'user.orders.index',
            'detail' => 'user.orders.order-detail',
        ];
    }

    public function getRoute(): array
    {
        return [
        ];
    }

    public function indexUser(UserOrderDataTable $dataTable)
    {
        return $dataTable->render($this->view['indexUser'], []);
    }

    public function detail($id)
    {
        $instance = $this->repository->findOrFail($id);
        return view($this->view['detail'], [
            'instance' => $instance
        ]);
    }

    public function cancel($id)
    {
        $result = $this->service->cancel($id);
        if ($result) {
            return to_route($this->route['index'])->with('success', __('Từ chối đơn hàng thành công'));
        }
        return to_route($this->route['index'])->with('error', __('Từ chối đơn hàng thất bại'));
    }
}
