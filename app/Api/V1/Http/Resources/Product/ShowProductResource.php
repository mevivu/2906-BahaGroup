<?php

namespace App\Api\V1\Http\Resources\Product;

use App\Enums\Attribute\AttributeType;
use App\Enums\Product\ProductType;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Support\AuthSupport;
use App\Enums\Product\ProductInStock;

class ShowProductResource extends JsonResource
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
        $discount = $this->is_user_discount == true ? $discount : 1;

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'in_stock' => ProductInStock::getDescription($this->in_stock->value),
            'on_flashsale' => $this->on_flash_sale ? true : false,
            'avatar' => asset($this->avatar),
            'gallery' => $this->gallery ? array_map(function ($value) {
                return asset($value);
            }, $this->gallery->toArray()) : [],
            'desc' => $this->desc,
            'avg_rating' => $this->avg_rating,
            'reviews' => $this->reviews
        ];

        if ($this->type == ProductType::Simple) {
            $data['price'] = $this->price * $discount;
            $data['promotion_price'] = $this->promotion_price * $discount ?: null;
            if ($this->on_flash_sale) {
                $data['flashsale_price'] = $this->flashsale_price * $discount ?: null;
            }
        } elseif ($this->productAttributes) {
            $data = array_merge($data, $this->handlePriceVariation($discount));

            $data['attributes'] = $this->productAttributes->map(function ($productAttribute) {
                return $this->handleAttribute($productAttribute);
            });
            $data['productVariations'] = $this->productVariations->map(function ($item) {
                return [
                    'id' => $item->id,
                    "price" => $item->price,
                    "promotion_price" => $item->promotion_price,
                    "flashsale_price" => $this->on_flash_sale ? $item->flashsale_price : null,
                    "image" => $item->image,
                    'attribute_variations' => $item->attribute_variations->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'attribute_id' => $item->attribute_id,
                            'name' => $item->name
                        ];
                    })
                ];
            });
        }
        return $data;
    }

    private function handlePriceVariation($discount)
    {
        $data = [];
        if ($this->productVariations) {
            if ($this->productVariations->count() == 1) {
                $data['price'] = $this->productVariations[0]->price * $discount;
                $data['promotion_price'] = $this->productVariations[0]->promotion_price * $discount ?: null;
            } elseif ($this->productVariations->count() > 1) {
                $price_variation = array_column($this->productVariations->toArray(), 'price');
                $promotion_price_variation = array_column($this->productVariations->toArray(), 'promotion_price');

                $data['min_promotion_price'] = min($promotion_price_variation) * $discount ?: null;
                $data['min_price'] = min($price_variation) * $discount;
                $data['max_price'] = max($price_variation) * $discount;
            }
        }
        return $data;
    }

    private function handleAttribute($productAttribute)
    {
        $attribute = $productAttribute->attribute;
        $attributesVariations = $productAttribute->attribute_variations;
        $productAttribute = [];

        $productAttribute = [
            'id' => $attribute->id,
            'type' => $attribute->type,
            'name' => $attribute->name
        ];
        $productAttribute['variations'] = $attributesVariations->map(function ($attributesVariation) use ($productAttribute) {
            return [
                'id' => $attributesVariation->id,
                'name' => $attributesVariation->name,
                'meta_value' => $productAttribute['type'] == AttributeType::Color ? $attributesVariation->meta_value : null
            ];
        });

        return $productAttribute;
    }
}
