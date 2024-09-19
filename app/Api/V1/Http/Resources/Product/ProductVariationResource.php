<?php

namespace App\Api\V1\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
{
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
            'name' => $this->name,
            'qty' => $this->qty,
            'price' => format_price($this->price),
            'promotion_price' => format_price($this->promotion_price),
        ];
        return $data;
    }
}
