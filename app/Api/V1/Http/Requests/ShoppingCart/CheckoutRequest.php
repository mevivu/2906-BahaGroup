<?php

namespace App\Api\V1\Http\Requests\ShoppingCart;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Payment\PaymentType;
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
            'shopping_cart_id' => ['required'],
            'payment_method' => ['required', new Enum(PaymentMethod::class)],
            'payment_type' => ['required', new Enum(PaymentType::class)],
            'note' => ['nullable'],
        ];
    }
}
