<?php

namespace App\Api\V1\Http\Resources\ShoppingCart;

use App\Enums\Product\ProductType;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Product\ProductInStock;
use App\Models\Product;
use App\Models\ProductVariation;

class ShoppingCartResourceNoLogin extends ResourceCollection
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
        return $this->collection->map(function ($shoppingCart) {
            $product = Product::find($shoppingCart['product']['id']);
            if ($shoppingCart['productVariation']) {
                $productVariation = ProductVariation::find($shoppingCart['productVariation']['id']);
            }
            $data = [
                'id' => $shoppingCart['id'],
                'qty' => $shoppingCart['qty'],
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'in_stock' => ProductInStock::getDescription($product->in_stock->value),
                    'avatar' => asset($product->avatar)
                ],
            ];
            if ($product->on_flash_sale) {
                $data['product']['flashsale_price'] = $shoppingCart['product']['flashsale_price'];
                $data['product']['on_flashsale'] = true;
            }
            if ($product->type == ProductType::Simple) {
                $data['product']['price'] = $shoppingCart['product']['price'];
                $data['product']['promotion_price'] = $shoppingCart['product']['promotion_price'];
            } elseif ($shoppingCart['productVariation']) {
                $data['product_variation'] = [
                    'id' => $productVariation->id,
                    'price' => $productVariation->price,
                    'promotion_price' => $productVariation->promotion_price,
                    'flashsale_price' => $product->on_flash_sale ? $productVariation->flashsale_price : null,
                    'image' => asset($productVariation->image),
                    'attribute_variations' => $productVariation->attribute_variations->map(function ($item) {
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
