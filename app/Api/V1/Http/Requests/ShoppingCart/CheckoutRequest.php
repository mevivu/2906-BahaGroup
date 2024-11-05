<?php

namespace App\Api\V1\Http\Requests\ShoppingCart;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Order\OrderStatus;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Payment\PaymentType;
use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Validation\Rules\Enum;

class CheckoutRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'id' => ['required'],
            'discount_code' => ['nullable', 'exists:App\Models\Discount,code'],
            'order.payment_method' => ['required', new Enum(PaymentMethod::class)],
            'order.email' => ['required'],
            'order.province_id' => ['required', 'exists:App\Models\Province,id'],
            'order.district_id' => ['required', 'exists:App\Models\District,id'],
            'order.ward_id' => ['required', 'exists:App\Models\Ward,id'],
            'order.fullname' => ['required'],
            'order.address' => ['required'],
            'order.phone' => ['required'],
            'order.note' => ['nullable'],
            'order.name_other' => ['nullable'],
            'order.address_other' => ['nullable'],
            'order.phone_other' => ['nullable'],
            'order.note_other' => ['nullable'],
            'order.note' => ['nullable'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (auth()->id()) {
                $userId = auth()->id();
                $cartIds = $this->input('id');

                $invalidCartIds = ShoppingCart::whereIn('id', $cartIds)
                    ->where('user_id', '!=', $userId)
                    ->pluck('id')
                    ->all();

                if (!empty($invalidCartIds)) {
                    $validator->errors()->add('id', 'Một hoặc nhiều giỏ hàng không thuộc về người dùng hiện tại.');
                }
                // $pendingOrdersCount = Order::where('user_id', $userId)
                //     ->where('status', OrderStatus::Pending)
                //     ->count();

                // if ($pendingOrdersCount >= 3) {
                //     $validator->errors()->add('order_limit', 'Bạn chỉ được phép có tối đa 3 đơn hàng đang chờ xác nhận. Hãy chờ người bán xác nhận đơn hàng');
                // }
            }
        });
    }
}
