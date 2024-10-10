@extends('user.layouts.master')
@section('title', __('Thanh toán'))

@section('content')
				@include('user.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
				<div class="d-flex justify-content-center align-items-center container bg-white">
								<div class="container">
												<div class="row">
																<div class="col-md-6 col-12 mt-3">
																				<h4>Thông tin thanh toán</h4>
																				@include('user.cart.partials.customer-info')
																				@include('user.cart.partials.customer-info-other')
																</div>

																<div class="col-md-6 col-12 mt-3">
																				<h4>Đơn đặt hàng</h4>
																				<div class="mt-4">
																								<table class="justify-content-center table">
																												<thead>
																																<tr>
																																				<th>Sản phẩm</th>
																																				<th class="text-end">Tạm tính</th>
																																</tr>
																												</thead>
																												<tbody>
																																@foreach ($shoppingCart as $item)
																																				<tr class="bold-text">
																																								<td data-label="Sản phẩm">
																																												<div onclick="location.href='{{ route('user.product.detail', ['id' => $item->product->id]) }}';"
																																																style="cursor: pointer" class="align-items-center product-info row">
																																																<div class="col-md-3 col-12"><img src="{{ asset($item->product->avatar) }}"
																																																								class="img-fluid card-item-img"></div>
																																																<div class="col-md-9 col-12">
																																																				<div class="product-name">{{ $item->product->name }}<span
																																																												class="text-777777">(x{{ $item->qty }})</span></div>
																																																				@if ($item->product_variation_id)
																																																								<div class="product-color">
																																																												@foreach ($item->productVariation->attributeVariations as $attributeVariation)
																																																																{{ $attributeVariation->name }}
																																																																@if (!$loop->last)
																																																																				,
																																																																@endif
																																																												@endforeach
																																																								</div>
																																																				@endif
																																																</div>
																																												</div>
																																								</td>
																																								<td data-label="Tổng">
																																												{{ $item->product_variation_id
																																												    ? ($item->product->on_flash_sale
																																												        ? format_price($item->productVariation->flash_sale_price * $item->qty)
																																												        : format_price($item->productVariation->promotion_price * $item->qty))
																																												    : ($item->product->on_flash_sale
																																												        ? format_price($item->product->flash_sale_price * $item->qty)
																																												        : format_price($item->product->promotion_price * $item->qty)) }}
																																								</td>
																																				</tr>
																																@endforeach
																												</tbody>
																								</table>
																				</div>
																				<div class="row mt-4">
																								<div class="col-6 text-start">Tạm tính</div>
																								<div class="col-6 text-end"><strong>{{ format_price($total) }}</strong></div>
																								<div class="col-6 text-start">Giảm giá</div>
																								<div class="col-6 text-end"><strong>{{ format_price($discount_value) }}</strong></div>
																								<div class="col-6 text-start">Giao hàng</div>
																								<div class="col-6 text-end">Giao hàng miễn phí</div>
																								<div class="col-6 mt-5 text-start">Tổng</div>
																								<div class="col-6 mb-3 mt-5 text-end"><strong>{{ format_price($total - $discount_value) }}</strong>
																								</div>
																				</div>
																				<h4>Phương thức thanh toán</h4>
																				<div class="col-12 mt-4">
																								<div class="form-check">
																												<input class="form-check-input ms-2" type="radio" name="paymentMethod" id="bankTransfer"
																																value="bankTransfer" checked>
																												<label class="form-check-label" for="bankTransfer">
																																Chuyển khoản ngân hàng
																												</label>
																								</div>
																								<p class="text-777777">Thực hiện thanh toán vào ngay tài khoản ngân hàng của chúng tôi. Vui lòng
																												sử dụng Mã đơn hàng của bạn trong phần Nội dung thanh toán. Đơn hàng sẽ được giao sau khi tiền
																												đã chuyển.</p>
																								<div class="form-check">
																												<input class="form-check-input ms-2" type="radio" name="paymentMethod" id="cashOnDelivery"
																																value="cashOnDelivery">
																												<label class="form-check-label" for="cashOnDelivery">
																																Trả tiền mặt khi nhận hàng
																												</label>
																								</div>
																				</div>
																				<a class="btn btn-default w-100 mb-3"><strong>Đặt hàng</strong></a>
																</div>
												</div>
								</div>
				</div>
				<script>
								document.getElementById('showDetails').addEventListener('change', function() {
												var details = document.getElementById('details');
												if (this.checked) {
																details.style.display = 'block';
												} else {
																details.style.display = 'none';
												}
								});
				</script>
@endsection
