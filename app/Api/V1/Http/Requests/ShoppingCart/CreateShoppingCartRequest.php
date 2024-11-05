<?php

namespace App\Api\V1\Http\Requests\ShoppingCart;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Api\V1\Rules\Product\ProductCheckVariation;
use App\Models\Product;

class CreateShoppingCartRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        $product = Product::findOrFail($this->product_id);
        if ($product && $product->isSimple()) {
            return [
                'product_id' => ['required', 'exists:App\Models\Product,id'],
                'qty' => ['required', 'integer', 'min:1']
            ];
        } else {
            return [
                'product_id' => ['required', 'exists:App\Models\Product,id'],
                'variation_id' => ['nullable', 'array', new ProductCheckVariation($this->product_id)],
                'variation_id.*' => ['nullable', 'exists:App\Models\AttributeVariation,id'],
                'qty' => ['required', 'integer', 'min:1']
            ];
        }
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $product = Product::find($this->product_id);

            if ($product && !$product->isSimple()) {
                $variation_id = $this->variation_id;
                $isExist = $product->productVariations()->where('product_id', $product->id)
                    ->whereHas('attribute_variations', function ($query) use ($variation_id) {
                        $query->whereIn('id', $variation_id);
                    }, '=', count($variation_id))
                    ->first();
                if (!$isExist) {
                    $validator->errors()->add('variation_id', 'id biến thể không hợp lệ.');
                }
            }
        });
    }
}
