@extends('user.layouts.master')
@section('title', __($title))

<head>
				<meta name="description" content="{{ $meta_desc }}">
</head>

@section('content')
				<div class="container mt-3 gap-64">
								<div class="row">
												<div class="col-md-6 order-info">
																<h3>Thông tin đơn hàng</h3>
																<p><strong>Mã đơn hàng:</strong> {{ $order->code }}</p>
																<div class="row">
																				<div class="col-6 text-start">Tạm tính</div>
																				<div class="col-6 text-end"><strong>{{ format_price($order->total) }}</strong></div>
																				<div class="col-6 text-start">Giảm giá</div>
																				<div class="col-6 text-end">
																								<strong>{{ format_price($order->discount_value ?? 0) }}</strong>
																				</div>
																				<div class="col-6 border-bottom pb-1 text-start">Phụ thu</div>
																				<div class="col-6 border-bottom pb-1 text-end">
																								{{ format_price($order->surcharge ?? 0) }}
																				</div>
																				<div class="col-6 mt-1 text-start">Tổng</div>
																				<div class="col-6 mb-3 mt-1 text-end">
																								<strong
																												id="totalAfterDiscount">{{ format_price($order->total - $order->discount_value - $order->surcharge) }}</strong>
																				</div>
																</div>
																<p><strong>Trạng thái đơn hàng:</strong> <span
																								@class([
																												'badge-status',
																												App\Enums\Order\OrderStatus::from($order->status->value)->badge(),
																								])>{{ \App\Enums\Order\OrderStatus::getDescription($order->status->value) }}</span>
																</p>
																<p><strong>Phương thức thanh toán:</strong> <span
																								@class([
																												'badge-status',
																												App\Enums\Payment\PaymentMethod::from(
																																$order->payment_method->value)->badge(),
																								])>{{ \App\Enums\Payment\PaymentMethod::getDescription($order->payment_method->value) }}</span>
																</p>
																<p><strong>Trạng thái thanh toán:</strong> <span
																								@class([
																												'badge-status',
																												App\Enums\Order\PaymentStatus::from($order->payment_status)->badge(),
																								])>{{ \App\Enums\Order\PaymentStatus::getDescription($order->payment_status) }}</span>
																</p>
																<p><strong>Ghi chú:</strong> {{ $order->note }}</p>
																@if (isset($order->payment_image))
																				<p><strong>Hình ảnh chuyển khoản:</strong>
																								<img class="image-preview img-thumbnail" src="{{ asset($order->payment_image) }}" alt="Preview">
																@endif
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
																												@foreach ($order->details as $item)
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
																<a href="{{ route('user.product.indexUser') }}" class="btn btn-default w-100"><strong>Tiếp tục mua sắm <i
																												class="ti ti-arrow-right"></i></strong></a>
												</div>
												<div class="col-md-6 payment-info">
																<h3>Thông tin thanh toán</h3>
																<div class="qr-code">
																				<img src="{{ asset('/userfiles/images/qr/58292bf5-9bc5-4303-a9d7-35f3fa9892a5.jpg') }}" alt="QR Code">
																</div>
																<div class="transfer-note mt-3">
																				<p><strong>Ghi chú:</strong> Vui lòng nhập đúng nội dung chuyển khoản để chúng tôi xác nhận đơn hàng
																								nhanh chóng. Ví dụ: "Thanh toan don hang #HD3B67D1731063448"</p>
																</div>
																<div class="bank-details">
																				{!! $settingsGeneral->where('setting_key', 'banking_information')->first()->plain_value !!}
																</div>
												</div>
								</div>
				</div>
@endsection
