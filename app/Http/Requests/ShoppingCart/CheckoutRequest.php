<?php

namespace App\Http\Requests\ShoppingCart;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Payment\PaymentMethod;
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
            'qty' => ['required'],
            'isBuyNow' => ['nullable'],
            'code' => ['nullable', 'exists:App\Models\Discount,code'],
            'shopping_cart_id' => ['required'],
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
        ];
    }
}
