<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header justify-content-between">
            <h2 class="mb-0">{{ __('Thông tin đơn hàng') .' #'.$order->code }}</h2>
        </div>
        <x-input type="hidden" :value="$order->user_id" id="orderUserId"/>
        <div class="row card-body">
            <div class="col-12 col-md-6">
                <h3>{{ __('Thông tin chung') }}</h3>
                <div class="mb-3">
                    <label class="control-label">{{ __('Khách hàng') }}:</label>
                    <x-select name="order[user_id]"
                    id="user_id"
                    class="select2-bs5-ajax"
                    data-url="{{ route('admin.search.select.user') }}"
                    :required="true">
                    <x-select-option :option="$order->user_id" :value="$order->user_id" :title="$order->user->fullname"/>
                    </x-select>
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Ghi chú') }}:</label>
                    <textarea name="order[note]" class="form-control">{{ $order->note }}</textarea>
                </div>
                @if ($order->name_other || $order->phone_other || $order->phone_other || $order->note_other)
                    <div class="mb-3">
                        <input type="checkbox" checked id="toggleShippingInfoOther"> Giao đến địa chỉ khác
                    </div>
                    <div class="col-12" id="infoShippingOther">
                        <h3>{{ __('Thông tin giao hàng khác') }}</h3>
                        <div>
                            @include('admin.orders.partials.info-shipping-other')
                        </div>
                    </div>
                @else
                    <div class="mb-3">
                        <input type="checkbox" id="toggleShippingInfoOther"> Giao đến địa chỉ khác
                    </div>
                    <div class="col-12 d-none" id="infoShippingOther">
                        <h3>{{ __('Thông tin giao hàng khác') }}</h3>
                        <div>
                            @include('admin.orders.partials.info-shipping-other')
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-12 col-md-6">
                <h3>{{ __('Thông tin giao hàng') }}</h3>
                <div id="infoShipping">
                    @include('admin.orders.partials.info-shipping')
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Tỉnh/Thành phố') }}</label>
                    <x-select name="order[province_id]"
                    id="province_id"
                    class="select2-bs5-ajax"
                    data-url="{{ route('admin.search.select.province') }}"
                    :required="true">
                    <x-select-option :option="$order->province_id" :value="$order->province_id" :title="$order->province->name"/>
                    </x-select>
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Quận/Huyện') }}</label>
                    <x-select name="order[district_id]"
                    id="district_id"
                    class="select2-bs5-ajax"
                    data-url="{{ route('admin.search.select.district') }}"
                    :required="true">
                    <x-select-option :option="$order->district_id" :value="$order->district_id" :title="$order->district->name"/>
                    </x-select>
                </div>
                <div class="mb-3">
                    <label for="">{{ __('Phường/Xã') }}</label>
                    <x-select name="order[ward_id]"
                    id="ward_id"
                    class="select2-bs5-ajax"
                    data-url="{{ route('admin.search.select.ward') }}"
                    :required="true">
                    <x-select-option :option="$order->ward_id" :value="$order->ward_id" :title="$order->ward->name"/>
                    </x-select>
                </div>
            </div>
            <div class="col-12">
                @include('admin.orders.partials.products')
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('toggleShippingInfoOther').addEventListener('change', function() {
        var shippingInfoDiv = document.getElementById('infoShippingOther');
        shippingInfoDiv.classList.toggle('d-none')
    });
</script>
