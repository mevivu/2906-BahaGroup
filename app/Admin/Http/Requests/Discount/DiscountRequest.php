<?php

namespace App\Admin\Http\Requests\Discount;

use App\Admin\Http\Requests\BaseRequest;


class DiscountRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
            'code' => 'required|max:255|unique:discounts',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'max_usage' => 'nullable|integer',
            'min_order_amount' => 'nullable|numeric',
            'type' => 'required|integer',
            'discount_value' => 'required|numeric',
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\Discount,id'],
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
            'max_usage' => 'nullable|integer',
            'min_order_amount' => 'nullable|numeric',
            'type' => 'required|integer',
            'discount_value' => 'required|numeric',
        ];
    }
}
