<?php

namespace App\Api\V1\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Order\OrderStatus;
use App\Enums\Order\PaymentStatus;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Payment\PaymentType;

class ShowOrderResource extends JsonResource
{
    use AuthSupport;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'customer_fullname' => $this->user->fullname,
            'customer_phone' => $this->user->phone,
            'customer_email' => $this->user->email,
            'shipping_address' => $this->user->address,
            'total' => $this->total,
            'code' => $this->code,
            'status' => OrderStatus::getDescription($this->status->value),
            'payment_method' => PaymentMethod::getDescription($this->payment_method->value),
            'payment_type' => PaymentType::getDescription($this->payment_type),
            'note' => $this->note,
            'created_at' => $this->created_at,
            'order_details' => $this->details->map(function ($detail) {
                return new ShowOrderDetailResource($detail);
            })
        ];
        return $data;
    }
}
