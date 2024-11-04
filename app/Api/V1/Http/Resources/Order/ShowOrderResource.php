<?php

namespace App\Api\V1\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Order\OrderStatus;
use App\Enums\Payment\PaymentMethod;

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
            'discount_code' => $this->discount ? $this->discount->code : null,
            'customer_fullname' => $this->fullname,
            'customer_phone' => $this->phone,
            'customer_email' => $this->email,
            'shipping_address' => $this->address,
            'note' => $this->note,
            'customer_fullname_other' => $this->fullname_other,
            'customer_phone_other' => $this->phone_other,
            'shipping_address_other' => $this->address_other,
            'note_other' => $this->note_other,
            'total' => $this->total,
            'surcharge' => $this->surcharge,
            'discount_value' => $this->discount_value ?? 0,
            'code' => $this->code,
            'status' => OrderStatus::getDescription($this->status->value),
            'payment_method' => PaymentMethod::getDescription($this->payment_method->value),
            'created_at' => $this->created_at,
            'province' => $this->province->name,
            'district' => $this->district->name,
            'ward' => $this->ward->name,
            'order_details' => $this->details->map(function ($detail) {
                return new ShowOrderDetailResource($detail);
            })
        ];
        return $data;
    }
}
