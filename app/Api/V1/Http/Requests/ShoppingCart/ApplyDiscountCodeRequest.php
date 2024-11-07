<?php

namespace App\Api\V1\Http\Requests\ShoppingCart;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Models\Discount;
use App\Models\ShoppingCart;

class ApplyDiscountCodeRequest extends BaseRequest
{
    protected function methodPost()
    {
        return [
            'discount_code' => ['required'],
            'id' => ['required'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $discount = Discount::where('code', $this->discount_code)->first();
            if ($discount) {
                if ($discount->max_usage <= 0) {
                    $validator->errors()->add('code', __('Mã giảm giá đã hết lượt sử dụng'));
                }
            } else {
                $validator->errors()->add('code', __('Mã giảm giá không tồn tại'));
            }
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
            } else {
                $inputIds = request()->input('id', []);
                $cart = session('cart', []);
                $cartIds = array_column($cart, 'id');

                $missingIds = array_diff($inputIds, $cartIds);
                if (!empty($missingIds)) {
                    $validator->errors()->add('id', 'Danh sách id giỏ hàng không hợp lệ.');
                }
            }
        });
    }
}
