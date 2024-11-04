@if ($type == App\Enums\Discount\DiscountType::Percent->value)
				{{ $discount_value }}%
@else
				{{ format_price($discount_value) }}
@endif
