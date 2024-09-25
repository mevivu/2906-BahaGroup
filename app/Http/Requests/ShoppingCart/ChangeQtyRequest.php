<?php

namespace App\Http\Requests\ShoppingCart;

use App\Admin\Http\Requests\BaseRequest;

class ChangeQtyRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'id' => ['required', 'exists:App\Models\ShoppingCart,id'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\ShoppingCart,id'],
            'qty' => ['required', 'integer', 'min:1'],
        ];
    }
}
