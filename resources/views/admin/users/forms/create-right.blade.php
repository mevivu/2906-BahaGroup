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
												<span class="ms-2">@lang('avatar')</span>
								</div>
								<div class="card-body p-2">
												<x-input-image-ckfinder name="avatar" showImage="featureImage" />
								</div>
				</div>
				<div class="card mb-3">
								<div class="card-header">
												<span><i class="ti ti-user-check me-2"></i>{{ __('Kích hoạt tài khoản') }}</span>
								</div>
								<div class="card-body p-2">
												<input type="hidden" name="active" value="1">
												<x-input-switch name="active" value="0" :label="__('Kích hoạt tài khoản?')" />
								</div>
				</div>
</div>
