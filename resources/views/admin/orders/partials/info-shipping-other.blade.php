<div class="mb-3">
    <label for=""><i class="ti ti-user-edit"></i> {{ __('Họ và tên khác') }}:</label>
    <x-input name="order[name_other]" :value="$order->name_other ?? ''" :placeholder="__('Họ và tên')" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-phone"></i> {{ __('Số điện thoại khác') }}:</label>
    <x-input-phone name="order[phone_other]" :value="$order->phone_other ?? ''" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-scan-position"></i> {{ __('Địa chỉ khác') }}:</label>
    <x-input name="order[address_other]" :value="$order->address_other ?? ''" :placeholder="__('Địa chỉ')" />
</div>
<div class="mb-3">
    <label for=""><i class="ti ti-note"></i> {{ __('Ghi chú') }}:</label>
    <textarea name="order[note_other]" class="form-control">{{ $order->note_other ?? '' }}</textarea>
</div>
