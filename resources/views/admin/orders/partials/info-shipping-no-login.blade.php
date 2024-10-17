<div class="mb-3">
				<label for="">{{ __('Họ và tên') }}:</label>
				<x-input name="order[fullname]" :value="$order->fullname" :placeholder="__('Họ và tên')" :required="true" />
</div>
<div class="mb-3">
				<label for="">{{ __('Email') }}:</label>
				<x-input-email name="order[email]" :value="$order->email" :required="true" />
</div>
<div class="mb-3">
				<label for="">{{ __('Số điện thoại') }}:</label>
				<x-input-phone name="order[phone]" :value="$order->phone" :required="true" />
</div>
<div class="mb-3">
				<label for="">{{ __('Địa chỉ') }}:</label>
				<x-input name="order[address]" :value="$order->address" :placeholder="__('Địa chỉ')" :required="true" />
</div>
