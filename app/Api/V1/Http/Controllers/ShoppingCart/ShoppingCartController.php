<?php

namespace App\Api\V1\Http\Controllers\ShoppingCart;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Traits\AuthService;
use App\Api\V1\Http\Requests\ShoppingCart\CheckoutRequest;
use App\Api\V1\Services\ShoppingCart\ShoppingCartServiceInterface;
use App\Api\V1\Repositories\ShoppingCart\ShoppingCartRepositoryInterface;
use App\Api\V1\Http\Requests\ShoppingCart\ShoppingCartRequest;
use App\Api\V1\Http\Resources\ShoppingCart\ShoppingCartResource;
use App\Api\V1\Http\Resources\ShoppingCart\ShoppingCartResourceNoLogin;
use Illuminate\Http\Request;

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
    public function index(Request $request)
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
            // Lấy giỏ hàng từ cookie
            $shoppingCart = json_decode($request->cookie('cart', '[]'), true);
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
     * @authenticated
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
    public function store(ShoppingCartRequest $request)
    {
        $response = $this->service->store($request);
        if ($response === 1) {
            return response()->json([
                'status' => 400,
                'message' => __('Thêm sản phẩm thất bại, số lượng có thể mua đã đạt tối đa.'),
            ], 400);
        }
        return response()->json([
            'status' => 200,
            'message' => __('Thêm vào giỏ hàng thành công.'),
        ])->withCookie(cookie('cart', json_encode($response), 86400));
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
     * Danh sách qty phải tương ứng với ds id (nếu qty = 0 item sẽ bị xóa). Example: 1
     *
     * @authenticated
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
    public function update(ShoppingCartRequest $request)
    {
        $response = $this->service->update($request);
        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.')
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Thực hiện không thành công.')
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
     *
     * @authenticated
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
    public function delete(ShoppingCartRequest $request)
    {
        $response = $this->service->deleteMultiple($request);
        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => __('Thực hiện thành công.')
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Thực hiện không thành công.')
        ], 400);
    }

    public function checkout(CheckoutRequest $request)
    {
        $order = $this->service->checkout($request);
        if ($order) {
            return response()->json([
                'status' => 200,
                'message' => __('Đặt hàng thành công.')
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('Đặt hàng thất bại.')
        ], 400);
    }
}
