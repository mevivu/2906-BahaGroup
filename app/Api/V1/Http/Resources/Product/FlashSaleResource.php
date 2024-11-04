<?php

namespace App\Api\V1\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class FlashSaleResource extends JsonResource
{
    public function toArray($request)
    {
        $keywords = $request->input('keywords');
        $productsQuery = $this->details();

        if ($keywords) {
            $productsQuery->whereHas('product', function ($query) use ($keywords) {
                $query->where('name', 'LIKE', '%' . $keywords . '%');
            });
        }

        $products = $productsQuery->paginate(8, ['*'], 'page', $request->input('page', 1))->pluck('product');

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'start_time' => format_datetime($this->start_time),
            'end_time' => format_datetime($this->end_time),
            'products' => new AllProductResource($products),
        ];

        return $data;
    }
}
