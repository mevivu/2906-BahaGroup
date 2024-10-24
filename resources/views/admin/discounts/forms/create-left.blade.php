<div class="col-12 col-md-9">
				<div class="row">
								<!-- name -->
								<h2 style="text-align: center; color: red;">Tạo phiếu giảm giá </h2>
								<div class="col-12">
												<div class="card">
																<div class="card-body row">
																				<!-- name -->
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label"><i class="ti ti-receipt-tax"></i>
																																{{ __('Mã code') }}:</label>
																												<span class="text-danger">*</span>
																												<x-input name="code" :value="old('code')" :required="true" :placeholder="__('Ví dụ: CODE01')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label">@lang('max_usage')</label>
																												<x-input name="max_usage" :value="old('max_usage')" :required="true" :placeholder="__('max_usage')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label">@lang('date_start')</label>
																												<x-input input type="datetime-local" name="date_start" onblur="checkStartDate(this)"
																																:value="old('date_start')" :required="true" :placeholder="__('date_start')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label">@lang('date_end')</label>
																												<x-input name="date_end" input type="datetime-local" onblur="checkEndDate(this)"
																																:value="old('date_end')" :required="true" :placeholder="__('date_end')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label">@lang('min_order_amount')</label>
																												<x-input-price name="min_order_amount" id="min_order_amount" :value="old('min_order_amount')"
																																:required="true" :placeholder="__('min_order_amount')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="form-label">@lang('type'):</label>
																												<x-select name="type" :required="true">
																																@foreach ($types as $key => $value)
																																				<x-select-option :value="$key" :title="$value" />
																																@endforeach
																												</x-select>
																								</div>
																				</div>
																				<!-- price_selling -->
																				<div class="col-12">
																								<div class="mb-3">
																												<label class="control-label">{{ __('Giá trị giảm giá') }}</label>
																												<x-input-price onblur="checkDiscountValue(this)" name="discount_value" id="discount_value"
																																:value="old('discount_value')" :required="true" :placeholder="__('discount_value')" />
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
</div>
