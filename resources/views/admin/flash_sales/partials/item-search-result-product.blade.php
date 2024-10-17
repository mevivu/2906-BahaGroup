<div class="list-group-item">
				<div class="row align-items-center">
								<div class="col-md-10 text-truncate d-flex justify-content-between">
												<div class="">
																<span class=""><img width="64" height="64" class="img-fluid" src="{{ asset($product->avatar) }}"
																								alt=""> {{ $product->name }} -
																				@if ($product->type == App\Enums\Product\ProductType::Simple)
																								{{ format_price($product->promotion_price) }}
																				@else
																								{{ format_price($product->productVariations()->min('promotion_price')) }} ->
																								{{ format_price($product->productVariations()->max('promotion_price')) }}
																				@endif
																				- Số lượng:
																				@if ($product->type == App\Enums\Product\ProductType::Simple)
																								{{ $product->qty }}
																				@else
																								{{ $product->total_qty }}
																				@endif
																				- {{ $product->sku }}
																</span>
												</div>
								</div>
								<div class="col-md-2 text-end">
												<x-button type="button" class="add-product btn-sm btn-outline-primary" :data-product-id="$product->id">
																<i class="ti ti-plus"></i>
																{{ __('Thêm') }}
												</x-button>
								</div>
				</div>
</div>
