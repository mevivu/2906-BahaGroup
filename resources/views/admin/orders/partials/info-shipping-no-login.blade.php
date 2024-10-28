<div class="mb-3">
    <label for=""><i class="ti ti-user-edit"></i> {{ __('Họ và tên') }}:</label>
    <x-input name="order[fullname]" :value="$order->fullname" :placeholder="__('Họ và tên')" :required="true" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-mail"></i> {{ __('Email') }}:</label>
    <x-input-email name="order[email]" :value="$order->email" :required="true" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-phone"></i> {{ __('Số điện thoại') }}:</label>
    <x-input-phone name="order[phone]" :value="$order->phone" :required="true" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-scan-position"></i> {{ __('Địa chỉ') }}:</label>
    <x-input name="order[address]" :value="$order->address" :placeholder="__('Địa chỉ')" :required="true" />
</div>
