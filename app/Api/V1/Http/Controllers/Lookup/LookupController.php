<?php

namespace App\Api\V1\Http\Controllers\Lookup;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Api\V1\Http\Resources\Discount\AllDiscountResource;
use App\Api\V1\Support\Response;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentStatus;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Payment\PaymentType;
use App\Enums\User\Gender;
use Illuminate\Http\JsonResponse;

/**
 * @group DS Bổ sung
 */

class LookupController extends Controller
{
    use Response;

    protected DiscountRepositoryInterface $discountRepository;

    public function __construct(DiscountRepositoryInterface $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * Danh sách mã giảm giá
     *
     * Lấy danh sách mã giảm giá.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "1": "Online",
     *          "2": "Trực tiếp"
     *      }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function discount(): JsonResponse
    {
        return $this->jsonResponseSuccess(new AllDiscountResource($this->discountRepository->getValid()));
    }

    /**
     * Danh sách phương thức thanh toán
     *
     * Lấy danh sách phương thức thanh toán.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "1": "Online",
     *          "2": "Trực tiếp"
     *      }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentMethod(): JsonResponse
    {
        return $this->jsonResponseSuccess(PaymentMethod::asSelectArray());
    }

    /**
     * Danh sách trạng thái thanh toán
     *
     * Lấy danh sách trạng thái thanh toán.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "1": "Chưa thanh toán",
     *          "2": "Đã thanh toán"
     *      }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentStatus(): JsonResponse
    {
        return $this->jsonResponseSuccess(PaymentStatus::asSelectArray());
    }

    /**
     * Danh sách loại thanh toán
     *
     * Lấy danh sách loại thanh toán.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "1": "Trả toàn bộ",
     *          "2": "Trả góp"
     *      }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentType(): JsonResponse
    {
        return $this->jsonResponseSuccess(PaymentType::asSelectArray());
    }

    /**
     * Danh sách trạng thái đơn hàng
     *
     * Lấy danh sách trạng thái đơn hàng.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "1": "Chờ xác nhận",
     *          "2": " Đã xác nhận",
     *          "3": "Hủy bỏ"
     *      }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function orderStatus(): JsonResponse
    {
        return $this->jsonResponseSuccess(OrderStatus::asSelectArray());
    }

    /**
     * Danh sách giới tính
     *
     * Lấy danh sách giới tính.
     *
     * @headersParam X-TOKEN-ACCESS string
     * token để lấy dữ liệu. Example: ijCCtggxLEkG3Yg8hNKZJvMM4EA1Rw4VjVvyIOb7
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "1": "Nam",
     *          "2": "Nữ",
     *          "3": "Khác"
     *      }
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function gender(): JsonResponse
    {
        return $this->jsonResponseSuccess(Gender::asSelectArray());
    }
}
