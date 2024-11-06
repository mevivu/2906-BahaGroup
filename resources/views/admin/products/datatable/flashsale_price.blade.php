@if ($type == \App\Enums\Product\ProductType::Simple->value)
				<span class="price">{{ format_price($flashsale_price) }}</span>
@elseif(count($product_variations) > 0)
				<span class="price">{{ format_price($product_variations[0]['flashsale_price']) }}</span>
@endif
