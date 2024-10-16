<div class="col-12 col-md-3">
				<div class="card mb-3">
								<div class="card-header">
												{{ __('Đăng') }}
								</div>
								<div class="card-body p-2">
												<x-button.submit :title="__('Thêm')" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												{{ __('Avatar') }}
								</div>
								<div class="card-body p-2">
												<x-input-image-ckfinder name="avatar" showImage="avatar" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												{{ __('Hiển thị Slider Trang chủ 1') }}
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
												{{ __('Hiển thị Slider Trang chủ 2') }}
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
