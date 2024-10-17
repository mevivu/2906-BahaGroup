<div class="col-12 col-md-9">
				<div class="card">
								<div class="card-header justify-content-between">
												<h2 class="mb-0">{{ __('Thông tin đơn hàng') }}</h2>
								</div>
								<div class="row card-body">
												<div class="col-12 col-md-6">
																<h3>{{ __('Thông tin chung') }}</h3>
																<div class="mb-3">
																				<label for="">{{ __('Khách hàng') }}</label>
																				<x-select name="order[user_id]" id="user_id" class="select2-bs5-ajax"
																								data-url="{{ route('admin.search.select.user') }}" :required="true">
																				</x-select>
																</div>
																<div class="mb-3">
																				<label for="">{{ __('Tỉnh/Thành phố') }}</label>
																				<x-select name="order[province_id]" id="province_id" class="select2-bs5-ajax"
																								data-url="{{ route('admin.search.select.province') }}" :required="true">
																				</x-select>
																</div>
																<div class="mb-3">
																				<label for="">{{ __('Quận/Huyện') }}</label>
																				<x-select name="order[district_id]" id="district_id" class="select2-bs5-ajax" data-url=""
																								:required="true">
																				</x-select>
																</div>
																<div class="mb-3">
																				<label for="">{{ __('Phường/Xã') }}</label>
																				<x-select name="order[ward_id]" id="ward_id" class="select2-bs5-ajax" data-url=""
																								:required="true">
																				</x-select>
																</div>
																<div class="mb-3">
																				<label for="">{{ __('Ghi chú') }}:</label>
																				<textarea name="order[note]" class="form-control">{{ old('order.note') }}</textarea>
																</div>
												</div>
												<div class="col-12 col-md-6">
																<h3>{{ __('Thông tin giao hàng') }}</h3>
																<div id="infoShipping">
																				@include('admin.orders.partials.info-shipping')
																</div>
												</div>
												<div class="col-12 col-md-6 d-none" id="infoShippingOther">
																<h3>{{ __('Thông tin giao hàng khác') }}</h3>
																<div>
																				@include('admin.orders.partials.info-shipping-other')
																</div>
												</div>
												<div class="col-12">
																@include('admin.orders.partials.products')
												</div>
								</div>
				</div>
</div>

<script>
				document.getElementById('toggleShippingInfoOther').addEventListener('change', function() {
								var shippingInfoDiv = document.getElementById('infoShippingOther');
								shippingInfoDiv.classList.toggle('d-none')
				});
</script>
