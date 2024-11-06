<?php

namespace App\Api\V1\Http\Controllers\ShoppingCart;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Traits\AuthService;
use App\Api\V1\Http\Requests\ShoppingCart\CheckoutRequest;
use App\Api\V1\Http\Requests\ShoppingCart\DeleteShoppingCartRequest;
use App\Api\V1\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Api\V1\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Api\V1\Http\Requests\ShoppingCart\CreateShoppingCartRequest;
use App\Api\V1\Http\Requests\ShoppingCart\UpdateShoppingCartRequest;
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
    public function __construct(
        ShoppingCartRepositoryInterface $repository,
        ShoppingCartServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
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
     *      "message": "Đặt hàng thành công."
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
        if ($response === true) {
            return response()->json([
                'status' => 200,
                'message' => __('Đặt hàng thành công.')
            ]);
        } else if ($response === false) {
            return response()->json([
                'status' => 500,
                'message' => __('Đặt hàng thất bại.')
            ], 500);
        }
        session(['cart' => $response]);
        return response()->json([
            'status' => 200,
            'message' => __('Đặt hàng thành công.'),
        ]);
    }
}
