<?php

namespace App\Api\V1\Http\Controllers\Order;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Services\Order\OrderServiceInterface;
use App\Api\V1\Repositories\Order\OrderRepositoryInterface;
use App\Api\V1\Http\Requests\Order\OrderRequest;
use App\Api\V1\Http\Resources\Order\AllOrderResource;
use App\Api\V1\Http\Resources\Order\ShowOrderResource;

/**
 * @group Đơn hàng
 */

class OrderController extends Controller
{

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }
    /**
     * Danh sách đơn hàng
     *
     * Lấy danh sách đơn hàng của user.
     *
     * <strong>Trạng thái của đơn hàng bao gồm:</strong>
     * + 1: Chưa xác nhận
     * + 2: Đã xác nhận
     * + 3: Đã hủy
     *
     * @queryParam status integer
     * Trạng thái của đơn hàng. Example: 1
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
     *         {
     *          "id": 112,
     *          "discount_code": "SALE10",
     *          "customer_fullname": "Phạm Minh Mạnh",
     *          "customer_phone": "0961592552",
     *          "customer_email": "marispham1509@gmail.com",
     *          "shipping_address": "Thành phố Hồ Chí Minh, Hồ Chí Minh, Việt Nam",
     *          "note": null,
     *          "customer_fullname_other": null,
     *          "customer_phone_other": null,
     *          "shipping_address_other": null,
     *          "note_other": null,
     *          "total": 4500000,
     *          "surcharge": 0,
     *          "discount_value": 1125000,
     *          "code": "HDAEE771730110899",
     *          "status": "Chờ xác nhận",
     *          "payment_method": "Online",
     *          "created_at": "2024-10-28T10:21:39.000000Z",
     *          "province": "Tỉnh Lào Cai",
     *          "district": "Huyện Si Ma Cai",
     *          "ward": "Xã Thào Chư Phìn",
     *          "order_details": [
     *              {
     *                  "id": 16,
     *                  "name": "CELL PHONE X",
     *                  "qty": 5,
     *                  "unit_price": 1000000,
     *                  "slug": "cell-phone-x",
     *                  "avatar": "http://localhost:8080/2906-BahaGroup/userfiles/files/d1.jpg",
     *                  "attribute_variations": [
     *                      {
     *                          "id": 1,
     *                          "name": "Màu đen"
     *                      }
     *                  ]
     *              },
     *              {
     *                  "id": 10,
     *                  "name": "Điện thoại OPPO Reno5",
     *                  "qty": 5,
     *                  "unit_price": 11000000,
     *                  "slug": "dien-thoai-oppo-reno5",
     *                  "avatar": "http://localhost:8080/2906-BahaGroup/userfiles/files/d1.jpg"
     *              }
     *          ]
     *          }
     *      ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderRequest $request)
    {
        $filter = $request->validated();

        $orders = $this->repository->getByKeyAuthCurrent($filter);
        $orders = new AllOrderResource($orders);
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $orders
        ]);
    }
    /**
     * Chi tiết đơn hàng
     *
     * Lấy chi tiết đơn hàng của user.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @pathParam id integer required
     * id của đơn hàng. Example: 1
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 112,
     *          "discount_code": "SALE10",
     *          "customer_fullname": "Phạm Minh Mạnh",
     *          "customer_phone": "0961592552",
     *          "customer_email": "marispham1509@gmail.com",
     *          "shipping_address": "Thành phố Hồ Chí Minh, Hồ Chí Minh, Việt Nam",
     *          "note": null,
     *          "customer_fullname_other": null,
     *          "customer_phone_other": null,
     *          "shipping_address_other": null,
     *          "note_other": null,
     *          "total": 4500000,
     *          "surcharge": 0,
     *          "discount_value": 1125000,
     *          "code": "HDAEE771730110899",
     *          "status": "Chờ xác nhận",
     *          "payment_method": "Online",
     *          "created_at": "2024-10-28T10:21:39.000000Z",
     *          "province": "Tỉnh Lào Cai",
     *          "district": "Huyện Si Ma Cai",
     *          "ward": "Xã Thào Chư Phìn",
     *          "order_details": [
     *              {
     *                  "id": 16,
     *                  "name": "CELL PHONE X",
     *                  "qty": 5,
     *                  "unit_price": 1000000,
     *                  "slug": "cell-phone-x",
     *                  "avatar": "http://localhost:8080/2906-BahaGroup/userfiles/files/d1.jpg",
     *                  "attribute_variations": [
     *                      {
     *                          "id": 1,
     *                          "name": "Màu đen"
     *                      }
     *                  ]
     *              },
     *              {
     *                  "id": 10,
     *                  "name": "Điện thoại OPPO Reno5",
     *                  "qty": 5,
     *                  "unit_price": 11000000,
     *                  "slug": "dien-thoai-oppo-reno5",
     *                  "avatar": "http://localhost:8080/2906-BahaGroup/userfiles/files/d1.jpg"
     *              }
     *          ]
     *          }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->repository->findOrFail($id);
        $order = new ShowOrderResource($order);
        return response()->json([
            'status' => 200,
            'message' => __('Thực hiện thành công.'),
            'data' => $order
        ]);
    }

    /**
     * Hủy đơn hàng
     *
     * Hủy đơn hàng của user.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @authenticated Authorization string required
     * access_token được cấp sau khi đăng nhập. Example: Bearer 1|WhUre3Td7hThZ8sNhivpt7YYSxJBWk17rdndVO8K
     *
     * @bodyParam id integer required
     * id đơn hàng. Example: 1
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
    public function cancel($id)
    {
        $response = $this->service->cancel($id);
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
}
