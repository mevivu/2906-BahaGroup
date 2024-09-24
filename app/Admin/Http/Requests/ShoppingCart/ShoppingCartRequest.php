<?php

namespace App\Admin\Http\Requests\ShoppingCart;

use App\Admin\Http\Requests\BaseRequest;

class ShoppingCartRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'product_id' => ['required', 'exists:App\Models\Product,id'],
            'product_variation_id' => ['nullable', 'exists:App\Models\ProductVariation,id'],
            'qty' => ['required', 'integer', 'min:1']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodDelete()
    {
        return [
            'id' => ['required', 'exists:App\Models\ShoppingCart,id'],
        ];
    }
}
