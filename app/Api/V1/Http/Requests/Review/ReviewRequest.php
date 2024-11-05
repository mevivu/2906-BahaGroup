<?php

namespace App\Api\V1\Http\Requests\Review;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Enums\Order\OrderReview;
use App\Enums\Order\OrderStatus;
use App\Models\Order;
use Illuminate\Validation\Validator;

class ReviewRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'order_id' => ['required', 'exists:App\Models\Order,id'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'content' => ['nullable']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [
            'product_id' => ['required', 'exists:App\Models\Product,id']
        ];
    }

    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->isMethod('post')) {
                $orderId = $this->input('order_id');

                if ($orderId) {
                    $order = Order::find($orderId);

                    // Kiểm tra nếu đơn hàng đã được đánh giá
                    if ($order && $order->is_reviewed == OrderReview::Reviewed->value) {
                        $validator->errors()->add('order_id', __('Đơn hàng này đã được đánh giá.'));
                    }

                    // Kiểm tra nếu đơn hàng chưa được xác nhận (Confirmed)
                    if ($order && $order->status != OrderStatus::Confirmed) {
                        $validator->errors()->add('order_id', __('Đơn hàng chưa hoàn thành, không thể đánh giá.'));
                    }

                    // Kiểm tra nếu đơn hàng không thuộc về người dùng hiện tại
                    if ($order && $order->user_id != auth()->id()) {
                        $validator->errors()->add('order_id', __('Đơn hàng này không thuộc về bạn.'));
                    }
                }
            }
        });
    }
}
