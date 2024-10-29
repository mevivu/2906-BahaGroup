<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-playstation-circle"></i>
            <span class="ms-2">{{ __('Đăng') }}</span>
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Đăng')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-brand-mastercard"></i>
            <span class="ms-2">{{ __('Phương thức thanh toán') }}</span>
        </div>
        <div class="card-body p-2">
            <x-select class="form-select" name="order[payment_method]" :required="true">
                @foreach ($payment_methods as $key => $value)
                    <x-select-option :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="ti ti-discount"></i>
            <span class="ms-2">{{ __('Mã giảm giá') }}</span>
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select name="order[discount_id]" id="discount_id" class="select2-bs5-ajax"
                data-url="{{ route('admin.search.select.discount') }}">
            </x-select>
        </div>
    </div>
</div>
