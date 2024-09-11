<?php

namespace App\Admin\Http\Controllers\Order;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Admin\DataTables\Order\OrderDataTable;
use App\Enums\Order\OrderStatus;
use App\Admin\Http\Requests\Order\OrderRequest;
use App\Admin\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Admin\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Enums\Payment\PaymentMethod;
use App\Traits\ResponseController;

class OrderController extends Controller
{
    use ResponseController;
    protected UserRepositoryInterface $repositoryUser;
    protected ProductRepositoryInterface $repositoryProduct;
    protected ProductVariationRepositoryInterface $repositoryProductVariation;

    public function __construct(
        OrderRepositoryInterface $repository,
        UserRepositoryInterface $repositoryUser,
        ProductRepositoryInterface $repositoryProduct,
        ProductVariationRepositoryInterface $repositoryProductVariation,
        OrderServiceInterface $service
    )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->repositoryUser = $repositoryUser;
        $this->repositoryProduct = $repositoryProduct;
        $this->repositoryProductVariation = $repositoryProductVariation;
        $this->service = $service;
    }
    public function getView(): array
    {
        return [
            'index' => 'admin.orders.index',
            'indexUser' => 'user.orders.index',
            'detail' => 'user.orders.order-detail',
            'create' => 'admin.orders.create',
            'edit' => 'admin.orders.edit',
            'info_shipping' => 'admin.orders.partials.info-shipping',
            'add_item_product' => 'admin.orders.partials.add-item-product',
            'total' => 'admin.orders.partials.total'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.order.index',
            'create' => 'admin.order.create',
            'edit' => 'admin.order.edit',
            'delete' => 'admin.order.delete',
        ];
    }

    public function indexUser()
    {
        return view($this->view['indexUser']);
    }

    public function detail($id)
    {
        return view($this->view['detail']);
    }

    public function index(OrderDataTable $dataTable){
        return $dataTable->render($this->view['index'], [
            'status' => OrderStatus::asSelectArray()
        ]);
    }
    public function create(): Factory|View|Application
    {
        return view($this->view['create']);
    }
    public function store(OrderRequest $request): RedirectResponse
    {
        $order = $this->service->store($request);
        if($order){
            return to_route($this->route['edit'], $order->id);
        }
        return back()->with('error', __('notifyFail'));
    }
    public function edit($id): Factory|View|Application
    {
        $order = $this->repository->findOrFailWithRelations($id);
        $status = OrderStatus::asSelectArray();
        $payment_methods = PaymentMethod::asSelectArray();
        return view($this->view['edit'], compact('order', 'status', 'payment_methods'));
    }
    public function update(OrderRequest $request): RedirectResponse
    {
        $response = $this->service->update($request);
        if($response){
            return back()->with('success', __('notifySuccess'));
        }
        return back()->with('error', __('notifyFail'));
    }

    public function delete($id): RedirectResponse
    {
        $response = $this->service->delete($id);
        return $this->handleDeleteResponse($response, $this->route['index']);
    }

    public function renderInfoShipping(OrderRequest $request): Factory|View|Application
    {
        $user = $this->repositoryUser->findOrFail($request->input('user_id'));
        return view($this->view['info_shipping'], [
            'customer_fullname' => $user->fullname,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone,
            'shipping_address' => $user->address
        ]);
    }

    public function confirm($id)
    {
        $result = $this->service->confirm($id);
        if($result){
            return to_route($this->route['index'])->with('success', __('Duyệt đơn hàng thành công'));
        }
        return to_route($this->route['index'])->with('error', __('Duyệt đơn hàng thất bại'));
    }

    public function cancel($id)
    {
        $result = $this->service->cancel($id);
        if($result){
            return to_route($this->route['index'])->with('success', __('Từ chối đơn hàng thành công'));
        }
        return to_route($this->route['index'])->with('error', __('Từ chối đơn hàng thất bại'));
    }

    public function addProduct(OrderRequest $request): JsonResponse
    {

        $product = $this->service->addProduct($request);

        if(!$product){
            return response()->json([
                'status' => 400,
                'message' => __('notifyFail')
            ], 400);
        }
        $response = view($this->view['add_item_product'], compact('product'))->render();

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => $response
        ], 200);
    }

    public function calculateTotalBeforeSaveOrder(OrderRequest $request): JsonResponse
    {
        if(!$request->input('order_detail.product_id')){
            $total = 0;
        }else{
            $total = $this->service->calculateTotal($request);
        }
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => view($this->view['total'], compact('total'))->render()
        ], 200);
    }
}
