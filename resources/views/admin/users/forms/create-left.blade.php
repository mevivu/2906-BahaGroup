<div class="col-12 col-md-9">
				<div class="card">
								<div class="card-header justify-content-center">
												<h2 class="mb-0">{{ __('Thông tin thành viên') }}</h2>
								</div>
								<div class="row card-body">
												<!-- Fullname -->
												<div class="col-md-6 col-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-user-edit"></i> {{ __('Họ và tên') }}: <span
																												class="text-danger">*</span></label>
																				<x-input name="fullname" :value="old('fullname')" :required="true" placeholder="{{ __('Họ và tên') }}" />
																</div>
												</div>
												<!-- email -->
												<div class="col-md-6 col-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-mail"></i> {{ __('Email') }}: <span
																												class="text-danger">*</span></label>
																				<x-input-email name="email" :value="old('email')" :required="true" />
																</div>
												</div>
												<!-- phone -->
												<div class="col-md-6 col-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-phone"></i> {{ __('Số điện thoại') }}: <span
																												class="text-danger">*</span></label>
																				<x-input-phone name="phone" :value="old('phone')" :required="true" />
																</div>
												</div>
												<!-- birthday -->
												<div class="col-md-6 col-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-calendar"></i> @lang('birthday'):</label>
																				<x-input type="date" name="birthday" :required="true" />
																</div>
												</div>
												<!-- gender -->
												<div class="col-md-6 col-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-gender-female"></i> {{ __('Giới tính') }}: D</label>
																				<x-select name="gender" :required="true">
																								@foreach ($gender as $key => $value)
																												<x-select-option :value="$key" :title="__($value)" />
																								@endforeach
																				</x-select>
																</div>
												</div>
												<!-- address -->
												<div class="col-md-12 col-12">
																<div class="mb-3">
																				<label class="control-label"> <i class="ti ti-location-pin"></i> {{ __('Địa chỉ') }} <span
																												class="text-danger">*</span></label>
																				<x-input :label="trans('address')" name="address" :placeholder="trans('pickAddress')" :required="true" />
																</div>
												</div>

								</div>
				</div>
</div>
