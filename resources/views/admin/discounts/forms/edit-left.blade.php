<div class="col-12 col-md-9">
				<div class="row">
								<!-- name -->
								<div class="col-12">
												<div class="card">
																<div class="card-header justify-content-between">
																				<h2 class="mb-0">{{ __('Sửa phiếu giảm giá') }}</h2>
																</div>
																<div class="card-body row">
																				<!-- name -->
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label"><i class="ti ti-rosette-discount"></i> @lang('code') <span
																																				class="text-danger">*</span></label>
																												<x-input name="code" :value="$discount->code" :required="true" :placeholder="__('code')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label"><i class="ti ti-ticket"></i> @lang('max_usage')<span
																																				class="text-danger">*</span></label>
																												<x-input name="max_usage" :value="$discount->max_usage" :required="true" :placeholder="__('max_usage')" />
																								</div>
																				</div>

																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label"><i class="ti ti-calendar-event"></i> @lang('date_start')<span
																																				class="text-danger">*</span></label>
																												<x-input input type="datetime-local" name="date_start" onblur="checkStartDate(this)"
																																:value="$discount->date_start" :required="true" :placeholder="__('date_start')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label"><i class="ti ti-calendar-event"></i> @lang('date_end')<span
																																				class="text-danger">*</span></label>
																												<x-input name="date_end" input type="datetime-local" onblur="checkEndDate(this)"
																																:value="$discount->date_end" :required="true" :placeholder="__('date_end')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="control-label"><i class="ti ti-receipt-2"></i> @lang('min_order_amount')</label>
																												<x-input-price name="min_order_amount" id="min_order_amount" :value="$discount->min_order_amount"
																																:required="true" :placeholder="__('min_order_amount')" />
																								</div>
																				</div>
																				<div class="col-6">
																								<div class="mb-3">
																												<label class="form-label"><i class="ti ti-category-2"></i> @lang('type'):</label>
																												<x-select name="type" :required="true">
																																@foreach ($types as $key => $value)
																																				<x-select-option :option="$discount->type->value" :value="$key" :title="$value" />
																																@endforeach
																												</x-select>
																								</div>
																				</div>
																				<!-- price_selling -->
																				<div class="col-12">
																								<div class="mb-3">
																												<label class="control-label"><i class="ti ti-discount"></i>
																																{{ __('Giá trị giảm giá') }}</label>
																												<x-input-price onblur="checkDiscountValue(this)" name="discount_value" id="discount_value"
																																:value="$discount->discount_value" :required="true" :placeholder="__('discount_value')" />
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
</div>
