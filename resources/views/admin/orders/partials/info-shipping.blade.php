<div class="mb-3">
    <label for="">{{ __('Họ và tên') }}:</label>
    <x-input readonly :value="old('order.customer_fullname', $customer_fullname ?? '')" :placeholder="__('Họ và tên')" :required="true" />
</div>
<div class="mb-3">
    <label for="">{{ __('Email') }}:</label>
    <x-input-email readonly :value="old('order.customer_email', $customer_email ?? '')" :required="true" />
</div>
<div class="mb-3">
    <label for="">{{ __('Số điện thoại') }}:</label>
    <x-input-phone :value="old('order.customer_phone', $customer_phone ?? '')" :required="true" />
</div>
<div class="mb-3">
    <label for="">{{ __('Địa chỉ') }}:</label>
    <x-input name="order[address]" :value="old('order.shipping_address', $shipping_address ?? '')" :placeholder="__('Địa chỉ')" :required="true" />
</div>
