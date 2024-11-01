<div @class(['item-product', 'product-' . $product->id]) class="col-12 col-md-9">
				<div class="card mt-3">
								<div class="row card-body">
												<span style="font-size: 1em; max-width: 50px; cursor: pointer;" class="remove-item-product">
																<i class="ti ti-x"></i>
												</span>
												<x-input type="hidden" name="product_id[]" :value="$product->id" />
												@if ($product->type == App\Enums\Product\ProductType::Simple)
																<x-input id="hidden-quantity-{{ $product->id }}" type="hidden" :value="$product->qty" />
												@else
																<x-input id="hidden-quantity-{{ $product->id }}" type="hidden" :value="$product->total_qty" />
												@endif
												<div class="row">
																<div class="col-md-9">
																				<label for=""></label>
																				<div class="mb-3">
																								<span class=""><img width="64" height="64" class="img-fluid"
																																src="{{ asset($product->avatar) }}" alt=""> {{ $product->name }} -
																												@if ($product->type == App\Enums\Product\ProductType::Simple)
																																{{ format_price($product->promotion_price) }}
																												@else
																																{{ format_price($product->productVariations()->min('promotion_price')) }} ->
																																{{ format_price($product->productVariations()->max('promotion_price')) }}
																												@endif -
																												Số lượng:
																												@if ($product->type == App\Enums\Product\ProductType::Simple)
																																{{ $product->qty }}
																												@else
																																{{ $product->total_qty }}
																												@endif
																												- {{ $product->sku }}
																								</span>
																				</div>
																</div>
																<div class="col-md-3">
																				<div class="mb-3">
																								<label for="">{{ __('Số lượng tham gia:') }}</label>
																								<x-input data-id="{{ $product->id }}" class="text-center" type="number"
																												name="qty[{{ $product->id }}]" :required="true" min="1"
																												onblur="checkQuantity(this)" />
																				</div>
																</div>
												</div>
								</div>
				</div>
</div>

<script>
				function checkQuantity(element) {
								var inputQuantity = element.value;
								var id = element.getAttribute('data-id');
								var hiddenQuantity = document.getElementById(`hidden-quantity-${id}`).value;

								if (parseInt(inputQuantity) > parseInt(hiddenQuantity)) {
												Swal.fire({
																icon: 'warning',
																title: 'Lưu ý',
																text: 'Số lượng tham gia phải nhỏ hơn hoặc bằng số lượng sản phẩm còn lại!',
																showConfirmButton: true,
																confirmButtonColor: "#1c5639",
												});
												element.value = hiddenQuantity;
								}
				}
</script>
