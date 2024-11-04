<?php

namespace App\Api\V1\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Product\ProductType;
use Illuminate\Support\Facades\Log;

class ShowOrderDetailResource extends JsonResource
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
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'unit_price' => $this->unit_price,
            'slug' => $this->product->slug,
            'avatar' => asset($this->product->avatar)
        ];
        if ($this->product->type == ProductType::Variable) {
            $data['attribute_variations']  = collect($this->productVariation->attribute_variations)->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name
                ];
            });
        }
        return $data;
    }
}
