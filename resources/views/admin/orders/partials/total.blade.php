<table id="tableTotalOrder" class="table-transparent table-responsive table">
				<thead class="d-none">
								<tr>
												<th class="text-center" style="width: 1%"></th>
												<th>{{ __('Sản phẩm') }}</th>
												<th class="text-center" style="width: 15%">{{ __('Số lượng') }}</th>
												<th class="text-end" style="width: 1%">{{ __('Đơn giá') }}</th>
												<th class="text-end" style="width: 1%">{{ __('Tổng tiền') }}</th>
								</tr>
				</thead>
				<tbody>
								<tr>
												<td colspan="4" class="strong text-end">{{ __('Tạm tính') }}</td>
												<td class="text-end">{{ format_price($total ?? 0) }}</td>
								</tr>
								<tr>
												<td colspan="4" class="strong text-end">{{ __('Giảm giá') }}</td>
												<td class="text-end">{{ format_price(isset($order) ? $order->discount_value : $discountValue ?? 0) }}</td>
								</tr>
								<tr>
												<td colspan="4" class="strong text-end">{{ __('Phụ thu') }}</td>
												<td class="text-end">{{ format_price(isset($order) ? $order->surcharge : $surCharge ?? 0) }}</td>
								</tr>
								<tr>
												<td colspan="4" class="font-weight-bold text-uppercase text-end">{{ __('Tổng cộng') }}</td>
												@if (isset($discountValue) && $discountValue > 0)
																<td class="text-end">{{ format_price($totalAfterDiscount + $surCharge) }}</td>
												@elseif (isset($order) && $order->discount_value)
																<td class="text-end">{{ format_price($order->total - $order->discount_value + $order->surcharge) }}
																</td>
												@else
																<td class="text-end">
																				@if (isset($order))
																								{{ format_price($total - $order->discount_value + $order->surcharge) }}
																				@else
																								{{ format_price($total) }}
																				@endif
																</td>
												@endif
								</tr>
				</tbody>
				<x-input type="hidden" name="order[total]" :value="$total ?? 0" />
				<x-input type="hidden" name="order[discount_value]" :value="$discountValue ?? 0" />
</table>
