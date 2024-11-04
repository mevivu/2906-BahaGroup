<?php

namespace App\Api\V1\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Support\AuthSupport;

class ShowProductVariationResource extends JsonResource
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
        $discount = 1 - $this->getDiscountProduct() / 100;
        $data = [
            'id' => $this->id,
            'price' => $this->price * $discount,
            'promotion_price' => $this->promotion_price * $discount ?: null,
            'image' => asset($this->image)
        ];
        if ($this->product->on_flash_sale) {
            $data['flashsale_price'] = $this->flashsale_price * $discount ?: null;
            $data['on_flashsale'] = true;
        }

        return $data;
    }
}
