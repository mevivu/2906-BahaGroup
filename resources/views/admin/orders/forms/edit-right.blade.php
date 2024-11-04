<div class="col-12 col-md-3">
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-playstation-circle"></i>
												<span class="ms-2">{{ __('Đăng') }}</span>
								</div>
								<div class="card-body d-flex justify-content-between p-2">
												<x-button.submit :title="__('Cập nhật')" />
												<x-button.modal-delete data-route="{{ route('admin.order.delete', $order->id) }}" :title="__('Xóa')" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-toggle-right"></i>
												<span class="ms-2">{{ __('Trạng thái') }}</span>
								</div>
								<div class="card-body p-2">
												<x-select class="form-select" name="order[status]" :required="true">
																@foreach ($status as $key => $value)
																				<x-select-option :option="$order->status->value" :value="$key" :title="$value" />
																@endforeach
												</x-select>
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-brand-mastercard"></i>
												<span class="ms-2">{{ __('Phương thức thanh toán') }}</span>
								</div>
								<div class="card-body p-2">
												<x-select class="form-select" name="order[payment_method]" :required="true">
																@foreach ($payment_methods as $key => $value)
																				<x-select-option :option="$order->payment_method->value" :value="$key" :title="$value" />
																@endforeach
												</x-select>
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<span><i class="ti ti-credit-card-pay me-2"></i>{{ __('Trạng thái thanh toán') }}</span>
								</div>
								<div class="card-body p-2">
												<x-select class="form-select" name="order[payment_status]" :required="true">
																@foreach ($payment_statuses as $key => $value)
																				<x-select-option :option="$order->payment_status" :value="$key" :title="$value" />
																@endforeach
												</x-select>
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-calendar"></i>
												<span class="ms-2">{{ __('Ngày tạo đơn hàng') }}</span>
								</div>
								<div class="card-body p-2">
												<x-input readonly :value="format_date($order->created_at)" type="date" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-discount"></i>
												<span class="ms-2">{{ __('Mã giảm giá') }}</span>
								</div>
								@if ($order->discount)
												@php
																if ($order->type == App\Enums\Discount\DiscountType::Money) {
																    $type = $order->discount->discount_value . 'đ';
																} else {
																    $type = $order->discount->discount_value . '%';
																}
												@endphp
												<div class="card-body d-flex justify-content-between p-2">
																<x-select name="order[discount_id]" id="discount_id" class="select2-bs5-ajax"
																				data-url="{{ route('admin.search.select.discount') }}">
																				<x-select-option :option="$order->discount->id" :value="$order->discount->id" :title="$order->discount->code .
																				    ' - Tối thiểu: ' .
																				    $order->discount->min_order_amount .
																				    'đ - Còn lại: ' .
																				    $order->discount->max_usage .
																				    ' - Giảm: ' .
																				    $type" />
																</x-select>
												</div>
								@else
												<div class="card-body d-flex justify-content-between p-2">
																<x-select name="order[discount_id]" id="discount_id" class="select2-bs5-ajax"
																				data-url="{{ route('admin.search.select.discount') }}">
																</x-select>
												</div>
								@endif
				</div>
</div>
