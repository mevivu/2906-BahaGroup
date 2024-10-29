<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-playstation-circle"></i>
            <span class="ms-2">{{ __('Đăng') }}</span>
        </div>
        <div class="card-body d-flex justify-content-between p-2">
            <x-button.submit :title="__('Cập nhật')" />
            <x-button.modal-delete data-route="{{ route('admin.category.delete', $category->id) }}" :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-photo-scan"></i>
            <span class="ms-2">{{ __('Avatar') }}</span>
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="avatar" showImage="avatar" :value="$category->avatar" />
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
                    <x-select-option :option="$category->is_home_slider_1" :value="$key" :title="$value" />
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
                    <x-select-option :option="$category->is_home_slider_2" :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>
</div>
