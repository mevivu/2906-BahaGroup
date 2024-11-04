<?php

namespace App\Admin\Http\Controllers\Order;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Admin\DataTables\Order\OrderDataTable;
use App\Admin\DataTables\Order\UserOrderDataTable;
use App\Enums\Order\OrderStatus;
use App\Admin\Http\Requests\Order\OrderRequest;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Admin\Repositories\Product\{ProductRepositoryInterface, ProductVariationRepositoryInterface};
use App\Admin\Traits\AuthService;
use App\Enums\Discount\DiscountType;
use App\Enums\Order\PaymentStatus;
use App\Enums\Payment\PaymentMethod;

class OrderController extends Controller
{
    use AuthService;
    protected UserRepositoryInterface $repositoryUser;
    protected ProductRepositoryInterface $repositoryProduct;
    protected DiscountRepositoryInterface $discountRepository;
    protected ProductVariationRepositoryInterface $repositoryProductVariation;

    public function __construct(
        OrderRepositoryInterface $repository,
        UserRepositoryInterface $repositoryUser,
        ProductRepositoryInterface $repositoryProduct,
        DiscountRepositoryInterface $discountRepository,
        ProductVariationRepositoryInterface $repositoryProductVariation,
        OrderServiceInterface $service
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->repositoryUser = $repositoryUser;
        $this->discountRepository = $discountRepository;
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

    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], []);
    }
    public function create(): Factory|View|Application
    {
        $payment_methods = PaymentMethod::asSelectArray();
        return view($this->view['create'], [
            'payment_methods' => $payment_methods,
            'payment_statuses' => PaymentStatus::asSelectArray()
        ]);
    }
    public function store(OrderRequest $request): RedirectResponse
    {
        $result = $this->service->checkValidDiscount($request);
        if ($result) {
            $order = $this->service->store($request);
            if ($order) {
                return to_route($this->route['edit'], $order->id);
            }
            return back()->with('error', __('notifyFail'));
        }
        return back()->with('error', __('Hóa đơn không đủ điều kiện để nhập mã giảm giá hiện tại'));
    }
    public function edit($id): Factory|View|Application
    {
        return view($this->view['edit'], [
            'order' => $this->repository->findOrFailWithRelations($id),
            'status' => OrderStatus::asSelectArray(),
            'payment_methods' => PaymentMethod::asSelectArray(),
            'payment_statuses' => PaymentStatus::asSelectArray()
        ]);
    }
    public function update(OrderRequest $request): RedirectResponse
    {
        $result = $this->service->checkValidDiscount($request);
        if ($result) {
            $response = $this->service->update($request);
            if ($response) {
                return back()->with('success', __('notifySuccess'));
            }
            return back()->with('error', __('notifyFail'));
        }
        return back()->with('error', __('Hóa đơn không đủ điều kiện để nhập mã giảm giá hiện tại'));
    }

    public function delete($id): RedirectResponse
    {
        $response = $this->service->delete($id);
        if ($response) {
            return to_route($this->route['index'])->with('success', __('notifySuccess'));
        }
        return to_route($this->route['index'])->with('error', __('notifyFail'));
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
        if ($result === 1) {
            return to_route($this->route['index'])->with('error', __('Đơn hàng chứa sản phẩm không còn flash sale -> cần hủy'));
        }
        if ($result !== true && $result !== false) {
            return to_route($this->route['index'])->with('error', __('Không đủ sản phẩm: ' . $result));
        }
        if ($result) {
            return to_route($this->route['index'])->with('success', __('Duyệt đơn hàng thành công'));
        }
        return to_route($this->route['index'])->with('error', __('Duyệt đơn hàng thất bại'));
    }

    public function cancel($id)
    {
        $result = $this->service->cancel($id);
        if ($result) {
            return to_route($this->route['index'])->with('success', __('Từ chối đơn hàng thành công'));
        }
        return to_route($this->route['index'])->with('error', __('Từ chối đơn hàng thất bại'));
    }

    public function addProduct(OrderRequest $request): JsonResponse
    {

        $product = $this->service->addProduct($request);

        if (!$product) {
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
        $totalAfterDiscount = 0;
        $total = 0;
        $discountValue = 0;
        if ($request->input('order_detail.product_id')) {
            $total = $this->service->calculateTotal($request);
            if ($request->input('order.discount_id')) {
                $discountId = $request->input('order.discount_id');
                $discount = $this->discountRepository->findOrFail($discountId);
                if ($total >= $discount->min_order_amount) {
                    if ($discount->type == DiscountType::Money) {
                        $discountValue = $discount->discount_value;
                        $totalAfterDiscount = $total - $discountValue;
                    } else {
                        $discountValue = $total * $discount->discount_value / 100;
                        $totalAfterDiscount = $total - $discountValue;
                    }
                }
            }
        }
        $surCharge = $request->input('order.surcharge', 0);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => view($this->view['total'], compact('total', 'discountValue', 'totalAfterDiscount', 'surCharge'))->render()
        ], 200);
    }
}
