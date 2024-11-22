@extends('user.layouts.master')
@section('title', __('Chi tiết đơn hàng'))
@section('content')
				@include('user.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
				<div class="d-flex justify-content-center align-items-center container bg-white">
								<div class="container">
												<div class="row mb-3 mt-3">
																@include('user.auth.menu')
																<div class="col-md-10">
																				<div class="row">
																								<div class="col-md-6 col-12 border-right order-info">
																												<h3>Chi tiết đơn hàng</h3>
																												<p><strong>Mã đơn hàng:</strong> {{ $instance->code }}</p>
																												<p><strong>Ngày đặt:</strong> {{ format_datetime($instance->created_at) }}</p>
																												<p><strong>Phương thức thanh toán:</strong>
																																<span
																																				@class([
																																								'badge-status',
																																								App\Enums\Payment\PaymentMethod::from(
																																												$instance->payment_method->value)->badge(),
																																				])>{{ \App\Enums\Payment\PaymentMethod::getDescription($instance->payment_method->value) }}</span>
																												</p>
																												<p><strong>Trạng thái thanh toán:</strong>
																																<span
																																				@class([
																																								'badge-status',
																																								App\Enums\Order\PaymentStatus::from($instance->payment_status)->badge(),
																																				])>{{ \App\Enums\Order\PaymentStatus::getDescription($instance->payment_status) }}</span>
																												</p>
																												<p><strong>Địa chỉ giao hàng:</strong> {{ $instance->province->name }},
																																{{ $instance->district->name }}, {{ $instance->ward->name }}</p>
																												<p><strong>Địa chỉ chi tiết:</strong> {{ $instance->address }}</p>
																												@if ($instance->discount_value && $instance->status != App\Enums\Order\OrderStatus::Cancelled)
																																<p><strong>Mã giảm giá áp dụng:</strong> {{ $instance->discount->code }}</p>
																												@endif
																												<p><strong>Trạng thái đơn hàng:</strong>
																																<span
																																				@class([
																																								'badge-status',
																																								App\Enums\Order\OrderStatus::from($instance->status->value)->badge(),
																																				])>{{ \App\Enums\Order\OrderStatus::getDescription($instance->status->value) }}</span>
																												</p>
																												<p><strong>Ghi chú:</strong> {{ $instance->note }}</p>
																												</p>
																												<div class="row">
																																<div class="col-6 text-start">Tạm tính</div>
																																<div class="col-6 text-end"><strong>{{ format_price($instance->total) }}</strong>
																																</div>
																																<div class="col-6 text-start">Giảm giá</div>
																																<div class="col-6 text-end">
																																				<strong>{{ format_price($instance->discount_value ?? 0) }}</strong>
																																</div>
																																<div class="col-6 border-bottom pb-1 text-start">Phụ thu</div>
																																<div class="col-6 border-bottom pb-1 text-end">
																																				{{ format_price($instance->surcharge ?? 0) }}</div>
																																<div class="col-6 mt-1 text-start">Tổng</div>
																																<div class="col-6 mb-3 mt-1 text-end">
																																				<strong
																																								id="totalAfterDiscount">{{ format_price($instance->total - $instance->discount_value) }}</strong>
																																</div>
																												</div>
																								</div>

																								<!-- Thông tin người dùng -->
																								<div class="col-md-6 col-12 border-right order-info">
																												<h3>Thông tin người dùng</h3>
																												<p><strong>Tên:</strong> {{ $instance->user->fullname }}</p>
																												<p><strong>Địa chỉ:</strong> {{ $instance->user->address }}</p>
																												<p><strong>Số điện thoại:</strong> {{ $instance->user->phone }}</p>
																												<h3 class="mt-3">Thông tin khác</h3>
																												<p><strong>Tên người nhận:</strong> {{ $instance->name_other }}</p>
																												<p><strong>Địa chỉ người nhận:</strong> {{ $instance->address_other }}</p>
																												<p><strong>Số điện thoại người nhận:</strong> {{ $instance->phone_other }}</p>
																												<p><strong>Ghi chú khác:</strong> {{ $instance->note_other }}</p>
																								</div>

																								<!-- Thông tin khác -->
																								<div class="col-md-4 col-12 mt-md-0 mt-4">
																								</div>
																				</div>

																				<!-- Danh sách sản phẩm -->
																				<div class="mt-4">
																								<h4>Danh sách sản phẩm</h4>
																								<table class="table-center justify-content-center table text-center">
																												<thead>
																																<tr>
																																				<th class="text-start">Sản phẩm</th>
																																				<th>Giá</th>
																																				<th>Số lượng</th>
																																				<th>Tổng</th>
																																</tr>
																												</thead>
																												<tbody>
																																@foreach ($instance->details as $item)
																																				<tr class="bold-text">
																																								<td data-label="Sản phẩm">
																																												<div onclick="location.href='{{ route('user.product.detail', ['slug' => $item->product->slug]) }}';"
																																																style="cursor: pointer" class="align-items-center product-info row">
																																																<div class="col-md-4 col-12"><img src="{{ asset($item->product->avatar) }}"
																																																								class="img-fluid card-item-img"></div>
																																																<div class="col-md-8 col-12">
																																																				<div class="product-name">{{ $item->product->name }}</div>
																																																				<div class="product-color">Xanh, 128GB</div>
																																																</div>
																																												</div>
																																								</td>
																																								<td class="align-middle" data-label="Giá">{{ format_price($item->unit_price) }}
																																								</td>
																																								<td class="align-middle" data-label="Số lượng">{{ $item->qty }}</td>
																																								<td class="text-center align-middle" data-label="Tổng">
																																												{{ format_price($item->unit_price * $item->qty) }}</td>
																																				</tr>
																																@endforeach
																												</tbody>
																								</table>
																				</div>
																</div>
												</div>
								</div>
				</div>
@endsection
