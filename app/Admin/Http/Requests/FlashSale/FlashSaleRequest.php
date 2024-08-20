<?php

namespace App\Admin\Http\Requests\FlashSale;

use App\Admin\Http\Requests\BaseRequest;


class FlashSaleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'name' => ['required', 'unique:App\Models\FlashSale,name'],
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',

            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:App\Models\Product,id'],
            'qty' => ['required', 'array'],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\FlashSale,id'],
            'name' => ['required', 'unique:App\Models\FlashSale,name,'. $this->id],
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',

            'product_id' => ['required', 'array'],
            'product_id.*' => ['required', 'exists:App\Models\Product,id'],
            'qty' => ['required', 'array'],
        ];
    }

    protected function methodGet(){
        if($this->routeIs('admin.flashsale.add_product')){
            return [
                'product_id' => ['required', 'exists:App\Models\Product,id'],
            ];
        }
        return [

        ];
    }
}
