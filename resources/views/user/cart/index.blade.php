@extends('user.layouts.master')

@section('title', __('Giỏ hàng'))

@include('user.cart.scripts.scripts')

@section('content')
				<div class="d-flex align-items-center container bg-white">
								<div class="container gap-64">
												<div class="row">
																<div class="col-md-8 mb-3 mt-3">
																				<table class="table-center table text-center">
																								<thead>
																												<tr>
																																<th class="text-start">Sản phẩm</th>
																																<th>Giá</th>
																																<th>Số lượng</th>
																																<th>Tổng</th>
																																<th class="delete-header"></th>
																												</tr>
																								</thead>
																								<tbody>
																												@foreach ($shoppingCart as $item)
																																<tr class="bold-text">
																																				<td data-label="Sản phẩm">
																																								<div onclick="location.href='{{ route('user.product.detail', ['id' => $item->product_id]) }}';"
																																												style="cursor: pointer" class="align-items-center product-info row">
																																												<div class="col-md-4 col-12"><img
																																																				src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg"
																																																				class="img-fluid card-item-img"></div>
																																												<div class="col-md-8 col-12">
																																																<div class="product-name">{{ $item->product->name }}</div>
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
																																				<td class="align-middle" data-label="Giá">
																																								{{ $item->product_variation_id
																																								    ? ($item->product->on_flash_sale
																																								        ? format_price($item->productVariation->flash_sale_price)
																																								        : format_price($item->productVariation->promotion_price))
																																								    : ($item->product->on_flash_sale
																																								        ? format_price($item->product->flash_sale_price)
																																								        : format_price($item->product->promotion_price)) }}
																																				</td>
																																				<td class="align-middle" data-label="Số lượng">
																																								<div class="d-flex align-items-center justify-content-center">
																																												@if ($item->product_variation_id)
																																																<x-input type="hidden" name="hidden_product_qty{{ $item->id }}"
																																																				:value="$item->productVariation->qty" />
																																												@else
																																																<x-input type="hidden" name="hidden_product_qty{{ $item->id }}"
																																																				:value="$item->product->qty" />
																																												@endif
																																												<button data-id="{{ $item->id }}" class="btn btn-default" type="button"
																																																onclick="decrementCart(this)">-</button>
																																												<input data-id="{{ $item->id }}" onblur="isEnoughQuantityCart(this)"
																																																id="quantity-input{{ $item->id }}" class="form-control mx-2 text-center"
																																																value="{{ $item->qty }}" min="1" style="width: 60px;">
																																												<button data-id="{{ $item->id }}" class="btn btn-default" type="button"
																																																onclick="incrementCart(this)">+</button>
																																								</div>
																																				</td>
																																				<td class="text-center align-middle" data-label="Tổng">
																																								{{ $item->product_variation_id
																																								    ? ($item->product->on_flash_sale
																																								        ? format_price($item->productVariation->flash_sale_price * $item->qty)
																																								        : format_price($item->productVariation->promotion_price * $item->qty))
																																								    : ($item->product->on_flash_sale
																																								        ? format_price($item->product->flash_sale_price * $item->qty)
																																								        : format_price($item->product->promotion_price * $item->qty)) }}
																																				</td>
																																				<td class="delete-cell align-middle" style="font-size: 1.5em;"><i
																																												data-id="{{ $item->id }}" style="cursor: pointer"
																																												onclick="removeCart(this)" class="fa fa-trash text-danger"></i></td>
																																</tr>
																												@endforeach
																								</tbody>
																				</table>
																				<div class="progress d-flex align-items-center">
																								<div style="font-size: 16px; color: {{ ($total / $object) * 100 >= 50 ? '#ffffff' : '#000000' }}"
																												class="progress-text">
																												<strong
																																class="progress-percent">{{ ($total / $object) * 100 >= 100 ? '100%' : round(($total / $object) * 100) }}</strong>
																								</div>
																								<div class="progress-bar" role="progressbar"
																												style="width: {{ ($total / $object) * 100 >= 100 ? '100' : round(($total / $object) * 100) }}%; background-color: #1C5639;">
																												.</div>
																				</div>
																				<p class="mt-3 text-center">Bạn đã chi
																								<strong id="total-spend" class="text-default">{{ format_price($total) }}</strong>
																								Chúng tôi sẽ <strong>MIỄN PHÍ VẬN CHUYỂN!</strong> giao hàng miễn phí cho đơn hàng từ<br>
																								<strong class="text-default">3,000,000₫</strong>
																				</p>
																</div>

																<div class="col-md-4 mb-3 mt-3">
																				<div class="card mb-3">
																								<div class="card-body">
																												<h5>Áp dụng mã giảm giá</h5>
																												<div class="input-group">
																																<x-input id="discount_code" type="text" class="form-control"
																																				placeholder="Nhập mã giảm giá" />
																																<button onclick="applyDiscountCode()" class="btn btn-default" type="button">Áp
																																				dụng</button>
																												</div>
																								</div>
																				</div>
																				<div class="card mb-3">
																								<div class="card-body">
																												<div class="d-flex justify-content-between">
																																<h6 class="card-title">Tạm tính</h6>
																																<p class="card-text text-default"><strong
																																								id="totalOrder">{{ format_price($total) }}</strong></p>
																												</div>
																												<div class="d-flex justify-content-between">
																																<h6 class="card-title">Giảm giá</h6>
																																<p class="card-text text-default"><strong
																																								id="discountValue">{{ format_price($discount_value) }}</strong></p>
																												</div>
																												<div class="d-flex justify-content-between">
																																<h6 class="card-title">Giao hàng</h6>
																																<p class="card-text"><strong id="shippingValue">Giao hàng miễn phí</strong></p>
																												</div>
																												<div class="d-flex justify-content-between border-top border-1">
																																<h6 class="card-title mt-3">Tổng tiền</h6>
																																<p class="card-text text-default mt-3"><strong
																																								id="totalAfterDiscount">{{ format_price($total - $discount_value) }}</strong></p>
																												</div>
																								</div>
																				</div>
																				<a onclick="handleCheckOut()" class="btn btn-default w-100"><strong>Tiến hành thanh
																												toán</strong></a>
																</div>
												</div>
								</div>
				</div>
@endsection
