<?php

namespace App\Api\V1\Http\Controllers\ShoppingCart;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Admin\Traits\AuthService;
use App\Api\V1\Http\Requests\ShoppingCart\ApplyDiscountCodeRequest;
use App\Api\V1\Http\Requests\ShoppingCart\CheckoutRequest;
use App\Api\V1\Http\Requests\ShoppingCart\DeleteShoppingCartRequest;
use App\Api\V1\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Api\V1\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Api\V1\Http\Requests\ShoppingCart\CreateShoppingCartRequest;
use App\Api\V1\Http\Requests\ShoppingCart\UpdateShoppingCartRequest;
use App\Api\V1\Http\Resources\Order\ShowOrderResource;
use App\Api\V1\Http\Resources\ShoppingCart\ShoppingCartResource;
use App\Api\V1\Http\Resources\ShoppingCart\ShoppingCartResourceNoLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Giỏ hàng
 */

class ShoppingCartController extends Controller
{
    use AuthService;
    protected $discountRepository;
    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        DiscountRepositoryInterface $discountRepository,
        ShoppingCartServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;

        $this->discountRepository = $discountRepository;
    }
    /**
     * Danh sách sản phẩm trong giỏ hàng
     *
     * Lấy danh sách sản phẩm trong giỏ hàng của user.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *       "id": 7,
     *       "qty": 2,
     *       "product": {
     *           "id": 5,
     *           "name": "Iphone 16",
     *           "slug": "iphone-16-1",
     *           "in_stock": true,
     *           "on_flashsale": true,
     *           "avatar": "/public/assets/images/default-image.png"
     *       },
     *       "product_variation": {
     *           "id": 6,
     *           "price": 50000,
     *           "promotion_price": 40000,
     *           "flashsale_price": 30000,
     *           "image": "/public/assets/images/default-image.png",
     *           "attribute_variations": [
     *               {
     *                   "id": 2,
     *                   "name": "Màu đỏ"
     *               },
     *               {
     *                   "id": 3,
     *                   "name": "128GB"
     *               }
     *           ]
     *       }
     *   }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->getCurrentUser()) {
            $shoppingCart = $this->repository->getAuthCurrent();
            $shoppingCart = new ShoppingCartResource($shoppingCart);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $shoppingCart
            ]);
        } else {
            $shoppingCart = session('cart', []);
            $shoppingCart = new ShoppingCartResourceNoLogin($shoppingCart);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
                'data' => $shoppingCart
            ]);
        }
    }
    /**
     * Thêm sản phẩm vào giỏ hàng
     *
     * Thêm sản phẩm vào giỏ hàng của user.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam product_id integer required
     * id sản phẩm. Example: 1
     *
     * @bodyParam variation_id[] option
     * số id biến thể sản phẩm phải tương ứng với thuộc tính sp. Example: 1
     *
     * @bodyParam qty integer required
     * Số lượng sản phẩm. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShoppingCartRequest $request)
    {
        $response = $this->service->store($request);
        if ($response === 1) {
            return response()->json([
                'status' => 400,
                'message' => __('Thêm sản phẩm thất bại, số lượng có thể mua đã đạt tối đa.'),
            ], 400);
        }
        if ($response === true) {
            return response()->json([
                'status' => 200,
                'message' => __('Thêm vào giỏ hàng thành công.'),
            ], 200);
        }
        session(['cart' => $response]);
        return response()->json([
            'status' => 200,
            'message' => __('Thêm vào giỏ hàng thành công.'),
        ]);
    }

    /**
     * Cập nhật giỏ hàng
     *
     * Cập nhật hoặc xóa item giỏ hàng của user.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id[] integer required
     * Danh sách id item giỏ hàng. Example: 1
     *
     * @bodyParam qty[] integer required
     * Danh sách qty phải tương ứng với ds id. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShoppingCartRequest $request)
    {
        $response = $this->service->update($request);
        if ($response === true) {
            return response()->json([
                'status' => 200,
                'message' => __('Cập nhật giỏ hàng thành công.')
            ]);
        } else if ($response) {
            session(['cart' => $response]);
            return response()->json([
                'status' => 200,
                'message' => __('Cập nhật giỏ hàng thành công.'),
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Cập nhật giỏ hàng không thành công.')
        ], 400);
    }
    /**
     * Xóa item giỏ hàng
     *
     * Truyền vào mảng id item giỏ hàng để xóa.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id[] integer required
     * Danh sách id item giỏ hàng. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteShoppingCartRequest $request)
    {
        $response = $this->service->deleteMultiple($request);
        if ($response === true) {
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.')
            ]);
        } else if ($response) {
            session(['cart' => $response]);
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.'),
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Thực hiện không thành công.')
        ], 400);
    }

    /**
     * Đặt hàng
     *
     * Tiến hành đặt hàng.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam id[] integer required
     * Danh sách id item giỏ hàng. Example: 1
     *
     * @bodyParam discount_code string optional
     * Mã giảm giá. Example: SALE10
     *
     * @bodyParam order[payment_method] string required
     * Phương thức thanh toán. Example: "1"
     *
     * @bodyParam order[email] string required
     * Email của người đặt hàng. Example: "example@example.com"
     *
     * @bodyParam order[province_id] integer required
     * ID của tỉnh. Example: 1
     *
     * @bodyParam order[district_id] integer required
     * ID của huyện. Example: 10
     *
     * @bodyParam order[ward_id] integer required
     * ID của xã/phường. Example: 100
     *
     * @bodyParam order[fullname] string required
     * Họ tên đầy đủ của người nhận. Example: "Nguyen Van A"
     *
     * @bodyParam order[address] string required
     * Địa chỉ nhận hàng. Example: "123 Nguyen Trai, Ha Noi"
     *
     * @bodyParam order[phone] string required
     * Số điện thoại người nhận. Example: "0123456789"
     *
     * @bodyParam order[note] string optional
     * Ghi chú đơn hàng. Example: "Giao hàng giờ hành chính"
     *
     * @bodyParam order[name_other] string optional
     * Tên người nhận khác. Example: "Nguyen Thi B"
     *
     * @bodyParam order[address_other] string optional
     * Địa chỉ người nhận khác. Example: "456 Le Loi, Ho Chi Minh"
     *
     * @bodyParam order[phone_other] string optional
     * Số điện thoại người nhận khác. Example: "0987654321"
     *
     * @bodyParam order[note_other] string optional
     * Ghi chú khác. Example: "Chuyển khoản trước khi giao"
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Đặt hàng thành công.",
     *      "order": {
     *          "id": 38,
     *          "customer_fullname": "Phạm Minh Mạnh",
     *          "customer_phone": "0961592552",
     *          "customer_email": "marispham1509@gmail.com",
     *          "shipping_address": "Thành phố Hồ Chí Minh, Hồ Chí Minh, Việt Nam",
     *          "total": 3300000,
     *          "code": "HDBA1B51730986340",
     *          "status": "Chờ xác nhận",
     *          "payment_method": "Online",
     *          "payment_type": "Trả góp",
     *          "note": "Ghi chú",
     *          "created_at": "2024-11-07T13:32:20.000000Z",
     *      }
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Đặt hàng thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(CheckoutRequest $request)
    {
        $response = $this->service->checkout($request);
        if (!isset($response[1])) {
            return response()->json([
                'status' => 200,
                'message' => __('Đặt hàng thành công.'),
                'order' => $response

            ]);
        } else if ($response === false) {
            return response()->json([
                'status' => 500,
                'message' => __('Đặt hàng thất bại.')
            ], 500);
        }
        session(['cart' => $response[1]]);
        return response()->json([
            'status' => 200,
            'message' => __('Đặt hàng thành công.'),
            'order' => $response[0]
        ]);
    }

    /**
     * Áp dụng mã giảm giá
     *
     * Áp dụng mã giảm giá trước khi đặt hàng.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam id[] integer required
     * Danh sách id item giỏ hàng. Example: 1
     *
     * @bodyParam discount_code string required
     * Mã giảm giá. Example: SALE10
     *
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Áp dụng mã giảm giá thành công.",
     *      "data": {
     *          "total": 1000000,
     *          "discount_value": 50000
     *      }
     * }
     *
     * @response 400 {
     *      "status": 400,
     *      "message": "Áp dụng mã giảm giá không thành công."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function applyDiscountCode(ApplyDiscountCodeRequest $request)
    {
        $user = $this->getCurrentUser();
        if ($user) {
            $shoppingCart = $this->repository->getQueryBuilder()->whereIn('id', $request->input('id'))->get();
            $total = $this->service->calculateTotal($shoppingCart);
            $discount = $this->discountRepository->findByField('code', $request->input('discount_code'));
            if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                        . format_price($total) . ', giá trị đơn hàng đủ điều kiện: '
                        . format_price($discount->min_order_amount) . '.',
                    'data' => [
                        'total' => $total,
                        'discount_value' => 0
                    ]
                ], 400);
            }
            return response()->json([
                'status' => 200,
                'message' => __('Áp dụng mã giảm giá thành công.'),
                'data' => [
                    'total' => $total,
                    'discount_value' => $this->service->calculateDiscountValue($total, $discount)
                ]
            ]);
        } else {
            $cart = session()->get('cart', []);
            $cartCollection = collect($cart)->map(function ($item) {
                return (object) $item;
            });
            $cartCollection = $cartCollection->whereIn('id', $request->input('id'));
            $total = $this->service->calculateTotal($cartCollection);
            $discount = $this->discountRepository->findByField('code', $request->input('discount_code'));
            if ($total < $discount->min_order_amount || $discount->max_usage <= 0) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Mã giảm giá đã hết hoặc Đơn hàng chưa đủ điều kiện sử dụng mã giảm giá này. Giá trị đơn hàng hiện tại: '
                        . format_price($total) . ', giá trị đơn hàng đủ điều kiện: '
                        . format_price($discount->min_order_amount) . '.',
                    'data' => [
                        'total' => $total,
                        'discount_value' => 0
                    ]
                ], 400);
            }
            return response()->json([
                'status' => 200,
                'message' => __('Áp dụng mã giảm giá thành công.'),
                'data' => [
                    'total' => $total,
                    'discount_value' => $this->service->calculateDiscountValue($total, $discount)
                ]
            ]);
        }
    }

    /**
     * Tạo url thanh toán vnpay sau khi đặt hàng
     *
     * Tiến hành Tạo url thanh toán vnpay sau khi đặt hàng.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @bodyParam order_id integer required
     * id đơn hàng cần thanh toán. Example: 1
     *
     * @bodyParam language string required
     * Mã ngôn ngữ. Example: "vn"
     *
     * @bodyParam bankcode string required
     * Mã ngân hàng. Example: "ncb"
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Khởi tạo thành công.",
     *      "redirect_url": "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=15000000&vnp_BankCode=ncb&vnp_Command=pay&vnp_CreateDate=20241107200136&vnp_CurrCode=VND&vnp_IpAddr=%3A%3A1&vnp_Locale=vn&vnp_OrderInfo=Thanh+to%C3%A1n+tr%E1%BA%A3+g%C3%B3p+%C4%91%E1%BB%A3t+3+cho+h%C3%B3a+%C4%91%C6%A1n+HD5EEEE1730975142&vnp_OrderType=billpayment&vnp_ReturnUrl=http%3A%2F%2Flocalhost%3A8080%2F2976-AppBanSach%2Fapi%2Fv1%2Fshopping-cart%2Freturn-installment-vnpay&vnp_TmnCode=91FYLEJN&vnp_TxnRef=98&vnp_Version=2.1.0&vnp_SecureHash=229468f03afe6b0f482d9ec738aa7a1cbf0e1ab13b9867cf11fed80633aab497161ce14596cc00360592c2802f0c267c4b877c1e4c5a49ce0802130c91b8a77f"
     * }
     *
     * @response 500 {
     *      "status": 500,
     *      "message": "Thao tác thất bại."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createPaymentVnpay(Request $request)
    {
        return $this->service->handleVnpay($request);
    }

    public function handleVnpayReturn(Request $request)
    {
        return $this->service->handleVnpayReturn($request);
    }
}
