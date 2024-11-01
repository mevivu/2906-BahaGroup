<div class="mb-3">
    <label for=""><i class="ti ti-user-edit"></i> {{ __('Họ và tên') }}: <span class="text-danger">*</span></label>
    <x-input readonly :value="old('order.customer_fullname', $customer_fullname ?? '')" :placeholder="__('Họ và tên')" :required="true" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-mail"></i> {{ __('Email') }}: <span class="text-danger">*</span></label>
    <x-input-email readonly :value="old('order.customer_email', $customer_email ?? '')" :required="true" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-phone"></i> {{ __('Số điện thoại') }}: <span
            class="text-danger">*</span></label>
    <x-input-phone readonly :value="old('order.customer_phone', $customer_phone ?? '')" :required="true" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-scan-position"></i> {{ __('Địa chỉ') }}: <span
            class="text-danger">*</span></label>
    <x-input readonly name="order[address]" :value="old('order.shipping_address', $shipping_address ?? '')" :placeholder="__('Địa chỉ')" :required="true" />
</div>
