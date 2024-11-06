<div class="col-12 col-md-9">
				<div class="card">
								<div class="card-header justify-content-center">
												<h2 class="mb-0">{{ __('Thông tin Thành viên') }}</h2>

								</div>
								<div class="row card-body">
												<!-- Fullname -->
												<div class="col-md-6 col-sm-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-user-edit"></i> {{ __('Họ và tên') }}:</label>
																				<x-input name="fullname" :value="$user->fullname" :required="true" placeholder="{{ __('Họ và tên') }}" />
																</div>
												</div>
												<!-- email -->
												<div class="col-md-6 col-sm-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-mail"></i> {{ __('Email') }}:</label>
																				<x-input-email name="email" :value="$user->email" :required="true" />
																</div>
												</div>
												<!-- phone -->
												<div class="col-md-6 col-sm-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-phone"></i> {{ __('Số điện thoại') }}:</label>
																				<x-input-phone name="phone" :value="$user->phone" :required="true" />
																</div>
												</div>
												<!-- birthday -->
												<div class="col-md-6 col-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-calendar"></i> @lang('birthday'):</label>
																				<x-input type="date" name="birthday" :value="isset($user->birthday) ? format_date($user->birthday, 'Y-m-d') : null" required="true" />
																</div>
												</div>
												<!-- new password -->
												<div class="col-md-6 col-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-key"></i> {{ __('Mật khẩu') }}: <span
																												class="text-danger">*</span></label>
																				<x-input-password name="password" />
																</div>
												</div>
												<!-- new password confirmation-->
												<div class="col-md-6 col-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-key"></i> {{ __('Xác nhận mật khẩu') }}: <span
																												class="text-danger">*</span></label>
																				<x-input-password name="password_confirmation" data-parsley-equalto="input[name='password']"
																								data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
																</div>
												</div>

												<!-- gender -->
												<div class="col-md-6 col-sm-12">
																<div class="mb-3">
																				<label class="control-label"><i class="ti ti-gender-female"></i> {{ __('Giới tính') }}: <span
																												class="text-danger">*</span></label>
																				<x-select name="gender" :required="true">
																								<x-select-option value="" :title="__('Chọn Giới tính')" />
																								@foreach ($gender as $key => $value)
																												<x-select-option :option="$user->gender->value" :value="$key" :title="__($value)" />
																								@endforeach
																				</x-select>
																</div>
												</div>
												<!-- address -->
												<div class="col-md-12 col-sm-12">
																<div class="mb-3">
																				<label class="control-label"> <i class="ti ti-location-pin"></i> {{ __('Địa chỉ') }}</label>
																				<x-input :label="trans('address')" name="address" :value="$user->address" :placeholder="trans('address')"
																								:required="true" />
																</div>
												</div>

								</div>
				</div>
</div>
