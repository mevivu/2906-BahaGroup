<?php

namespace App\Http\Requests\ShoppingCart;

use App\Admin\Http\Requests\BaseRequest;

class ApplyDiscountCodeRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'code' => ['required', 'exists:App\Models\Discount,code'],
            'cart_id' => ['nullable', 'exists:App\Models\ShoppingCart,id'],
            'qty' => ['nullable'],
        ];
    }

    protected function methodPut()
    {
        return [
            'code' => ['required', 'exists:App\Models\Discount,code'],
        ];
    }
}
