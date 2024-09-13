<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Đăng')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Phương thức thanh toán') }}
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
            {{ __('Mã giảm giá') }}
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-select name="order[discount_id]"
                id="discount_id"
                class="select2-bs5-ajax"
                data-url="{{ route('admin.search.select.discount') }}"
                :required="true">
            </x-select>
        </div>
    </div>
</div>
