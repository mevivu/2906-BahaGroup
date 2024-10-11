<div class="col-12 col-md-3">
				<div class="card mb-3">
								<div class="card-header">
												{{ __('Đăng') }}
								</div>
								<div class="card-body d-flex justify-content-between p-2">
												<x-button.submit :title="__('Cập nhật')" />
												<x-button.modal-delete data-route="{{ route('admin.order.delete', $order->id) }}" :title="__('Xóa')" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												{{ __('Trạng thái') }}
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
												{{ __('Phương thức thanh toán') }}
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
												{{ __('Ngày tạo đơn hàng') }}
								</div>
								<div class="card-body p-2">
												<x-input readonly :value="format_date($order->created_at)" type="date" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												{{ __('Mã giảm giá') }}
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
