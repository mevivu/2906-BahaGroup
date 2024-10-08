<tr @class([
    'item-product',
    'product-'.$product->id,
    'product-variation-'.optional($product->productVariation)->id => $product->productVariation
])>
    <td class="align-middle">
        <span class="cursor-pointer remove-item-product"><i class="ti ti-x"></i></span>
        <x-input type="hidden" name="order_detail[id][]" value="0" />
        <x-input type="hidden" name="order_detail[product_id][]" :value="$product->id" />
        <x-input type="hidden" name="order_detail[product_variation_id][]" :value="$product->productVariation->id ?? 0" />
    </td>
    <td class="align-middle">
        <x-link :href="route('admin.product.edit', $product->id)" :title="$product->name" />
        @includeUnless($product->type == App\Enums\Product\ProductType::Simple, 'admin.orders.partials.product-variation', [
            'attribute_variations' => optional($product->productVariation)->attributeVariations ?? []
        ])
    </td>
    <td class="text-center">
        <x-input type="number" name="order_detail[product_qty][]" value="1" min="1" autocomplete="off"/>
    </td>
    @if($product->type == App\Enums\Product\ProductType::Simple)
        <td class="unit-price align-middle">{{ format_price($product->promotion_price ?? $product->price) }}</td>
        <td class="total-price align-middle">{{ format_price($product->promotion_price ?? $product->price) }}</td>
    @else
        <td class="unit-price align-middle">
            {{ format_price($product->productVariation->promotion_price ?? $product->productVariation->price) }}
        </td>
        <td class="total-price align-middle">
            {{ format_price(($product->productVariation->promotion_price ?? $product->productVariation->price) * 1) }}
        </td>
    @endif
</tr>
