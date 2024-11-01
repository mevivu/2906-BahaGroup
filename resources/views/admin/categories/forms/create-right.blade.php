<div class="col-12 col-md-3">
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-playstation-circle"></i>
												<span class="ms-2">{{ __('Đăng') }}</span>
								</div>
								<div class="card-body p-2">
												<x-button.submit :title="__('Thêm')" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-photo-scan"></i>
												<span class="ms-2">{{ __('Avatar') }}</span>
								</div>
								<div class="card-body p-2">
												<x-input-image-ckfinder name="avatar" showImage="avatar" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<span><i class="ti ti-star me-2"></i>{{ __('Hiển thị trên menu') }}</span>
								</div>
								<div class="card-body p-2">
												<input type="hidden" name="is_menu" value="{{ App\Enums\DefaultActiveStatus::UnActive->value }}">
												<x-input-switch name="is_menu" value="{{ App\Enums\DefaultActiveStatus::Active->value }}"
																:label="__('Hiển thị trên menu?')" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-star"></i>
												<span class="ms-2">{{ __('Hiển thị Slider Trang chủ 1') }}</span>
								</div>
								<div class="card-body p-2">
												<x-select class="select2-bs5" name="is_home_slider_1" :required="true">
																@foreach ($options as $key => $value)
																				<x-select-option :value="$key" :title="$value" />
																@endforeach
												</x-select>
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<i class="ti ti-star"></i>
												<span class="ms-2">
																{{ __('Hiển thị Slider Trang chủ 2') }}
												</span>
								</div>
								<div class="card-body p-2">
												<x-select class="select2-bs5" name="is_home_slider_2" :required="true">
																@foreach ($options as $key => $value)
																				<x-select-option :value="$key" :title="$value" />
																@endforeach
												</x-select>
								</div>
				</div>
</div>
