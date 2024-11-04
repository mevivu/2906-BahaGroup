<?php

namespace App\Api\V1\Http\Resources\Product;

use App\Api\V1\Http\Resources\PaginationResource;
use App\Enums\Product\ProductType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Api\V1\Support\AuthSupport;
use Illuminate\Support\Facades\Log;

class AllProductResource extends ResourceCollection
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
        return  $this->collection->map(function ($product) use ($discount) {
            $discount = $product->is_user_discount == true ? $discount : 1;
            $data = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'on_flashsale' => false,
                'in_stock' => $product->in_stock,
                'avatar' => asset($product->avatar)
            ];
            if ($product->on_flash_sale) {
                $data['flashsale_price'] = $product->flashsale_price * $discount ?: null;
                $data['on_flashsale'] = true;
            }
            if ($product->type == ProductType::Simple) {
                $data['price'] = $product->price * $discount;
                $data['promotion_price'] = $product->promotion_price * $discount ?: null;
            } elseif ($product->productVariations) {
                $price_variation = array_column($product->productVariations->toArray(), 'price');
                $promotion_price_variation = array_column($product->productVariations->toArray(), 'promotion_price');

                $data['min_promotion_price'] = min($promotion_price_variation) * $discount ?: null;
                $data['min_price'] = min($price_variation) * $discount;
                $data['max_price'] = max($price_variation) * $discount;
            }
            return $data;
        });
    }
}
