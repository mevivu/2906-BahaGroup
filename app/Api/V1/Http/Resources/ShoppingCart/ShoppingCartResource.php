<?php

namespace App\Api\V1\Http\Resources\ShoppingCart;

use App\Enums\Product\ProductType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Product\ProductInStock;

class ShoppingCartResource extends ResourceCollection
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

        return $this->collection->map(function ($shoppingCart) use ($discount) {
            $discount = $shoppingCart->product->is_user_discount == true ? $discount : 1;
            $data = [
                'id' => $shoppingCart->id,
                'qty' => $shoppingCart->qty,
                'product' => [
                    'id' => $shoppingCart->product->id,
                    'name' => $shoppingCart->product->name,
                    'slug' => $shoppingCart->product->slug,
                    'in_stock' => ProductInStock::getDescription($shoppingCart->product->in_stock->value),
                    'avatar' => asset($shoppingCart->product->avatar)
                ]
            ];
            if ($shoppingCart->product->on_flash_sale) {
                $data['product']['flashsale_price'] = $shoppingCart->product->flashsale_price * $discount ?: null;
                $data['product']['on_flashsale'] = true;
            }
            if ($shoppingCart->product->type == ProductType::Simple) {
                $data['product']['price'] = $shoppingCart->product->price * $discount;
                $data['product']['promotion_price'] = $shoppingCart->product->promotion_price * $discount ?: null;
            } elseif ($shoppingCart->productVariation) {
                $data['product_variation'] = [
                    'id' => $shoppingCart->productVariation->id,
                    'price' => $shoppingCart->productVariation->price * $discount,
                    'promotion_price' => $shoppingCart->productVariation->promotion_price * $discount ?: null,
                    'flashsale_price' => $shoppingCart->product->on_flash_sale ? $shoppingCart->productVariation->flashsale_price : null,
                    'image' => asset($shoppingCart->productVariation->image),
                    'attribute_variations' => $shoppingCart->productVariation->attribute_variations->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name
                        ];
                    })
                ];
            }
            return $data;
        });
    }
}
