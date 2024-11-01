<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Admin\Repositories\Order\OrderRepositoryInterface;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Admin\DataTables\Order\UserOrderDataTable;
use App\Admin\Traits\AuthService;
use App\Repositories\User\UserRepositoryInterface;
use App\Traits\ResponseController;
use Illuminate\Http\Request;
use App\Admin\Repositories\Review\ReviewRepositoryInterface;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Enums\Order\OrderReview;
use App\Http\Requests\ShoppingCart\CreatePaymentRequest;

class OrderController extends Controller
{
    use ResponseController, AuthService;

    protected ReviewRepositoryInterface $reviewRepository;
    protected UserRepositoryInterface $userRepository;
    protected ProductRepositoryInterface $productRepository;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderServiceInterface $service,
        ReviewRepositoryInterface $reviewRepository,
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository,
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
        $this->reviewRepository = $reviewRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }
    public function getView(): array
    {
        return [
            'indexUser' => 'user.orders.index',
            'detail' => 'user.orders.order-detail',
            'review' => 'user.orders.review',
        ];
    }

    public function getRoute(): array
    {
        return [];
    }

    public function indexUser(UserOrderDataTable $dataTable)
    {
        return $dataTable->render($this->view['indexUser'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách đơn hàng'))->getBreadcrumbs()
        ]);
    }

    public function review($id, Request $request)
    {
        $ordersDetail = $this->repository->findOrFailWithRelations($id)->details;
        $productIds = $ordersDetail->pluck('product_id')->toArray();

        $reviewedProducts = [];
        foreach ($productIds as $productId) {
            if (
                $this->reviewRepository->getQueryBuilder()
                ->where('product_id', $productId)
                ->where('order_id', $id)->first()
            ) {
                continue;
            }

            $data = [
                'user_id' => auth()->id(),
                'rating' => $request->query('rating'),
                'content' => $request->query('review'),
                'product_id' => $productId,
                'order_id' => $id,
            ];

            $this->reviewRepository->create($data);
            $reviewedProducts[] = $productId;
        }

        if (!empty($reviewedProducts)) {
            $this->repository->update($id, [
                'is_reviewed' => OrderReview::Reviewed->value,
            ]);

            return back()->with([
                'success' => __('Đánh giá đơn hàng thành công'),
            ]);
        }
        return back()->with('error', __('Đánh giá đơn hàng thất bại'));
    }

    public function review_detail($id)
    {
        $reviews = $this->reviewRepository->getQueryBuilder()
            ->where('order_id', $id)
            ->where('user_id', auth()->id())
            ->get();

        $user = $this->userRepository->findOrFail(auth()->id());

        $combinedArray = [];
        foreach ($reviews as $review) {
            $product = $this->productRepository->findOrFail($review->product_id);
            $combinedArray[] = [
                'product_name' => $product->name,
                'review_content' => $review->content,
                'review_rating' => $review->rating,
                'review_created_at' => $review->created_at->format('d-m-Y'),
            ];
        }

        $response = [
            'reviewsDetail' => $combinedArray,
            'user' => [
                'avatar' => asset($user->avatar),
                'fullname' => $user->fullname,
            ],
        ];

        return response()->json(['response' => $response]);
    }

    public function detail($id)
    {
        $instance = $this->repository->findOrFail($id);
        return view($this->view['detail'], [
            'instance' => $instance,
            'breadcrumbs' => $this->crums->add(__('Dach sách đơn hàng'), route('user.order.indexUser'))->add(__('Chi tiết đơn hàng'))->getBreadcrumbs()
        ]);
    }

    public function cancel($id)
    {
        $result = $this->service->cancel($id);

        if ($result) {
            if (auth('admin')->user()) {
                return to_route('admin.order.index')->with('success', __('Từ chối đơn hàng thành công'));
            } else {
                return to_route('user.order.indexUser')->with('success', __('Hủy đơn hàng thành công'));
            }
        }
        return to_route($this->route['index'])->with('error', __('Từ chối đơn hàng thất bại'));
    }
}
