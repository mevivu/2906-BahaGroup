@extends('user.layouts.master')
@section('title', __('Thanh toán'))

@push('libs-css')
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush

@section('content')
    @include('user.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    <div class="d-flex justify-content-center align-items-center container bg-white">
        <div class="container">
            <x-form id="formCheckout" :action="route('user.cart.checkoutFinal')" type="post" :validate="true">
                @if (isset($code))
                    <x-input :value="$code" type="hidden" name="code" />
                @endif
                <div class="row">
                    <div class="col-md-6 col-12 mt-3">
                        <h4>Thông tin thanh toán</h4>
                        @include('user.cart.partials.customer-info')
                        <div class="mb-3">
                            <label for="">{{ __('Tỉnh/Thành phố') }}</label>
                            <x-select name="order[province_id]" id="province_id" class="select2-bs5-ajax"
                                data-url="{{ route('admin.search.select.province') }}" :required="true">
                            </x-select>
                        </div>
                        <div class="mb-3">
                            <label for="">{{ __('Quận/Huyện') }}</label>
                            <x-select name="order[district_id]" id="district_id" class="select2-bs5-ajax" data-url=""
                                :required="true">
                            </x-select>
                        </div>
                        <div class="mb-3">
                            <label for="">{{ __('Phường/Xã') }}</label>
                            <x-select name="order[ward_id]" id="ward_id" class="select2-bs5-ajax" data-url=""
                                :required="true">
                            </x-select>
                        </div>
                        @include('user.cart.partials.customer-info-other')
                    </div>
                    <div class="col-md-6 col-12 mt-3">
                        <h4>Đơn đặt hàng</h4>
                        <div class="mt-4">
                            <table class="justify-content-center table">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-end">Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shoppingCart as $item)
                                        <tr class="bold-text">
                                            <td data-label="Sản phẩm">
                                                <div onclick="location.href='{{ route('user.product.detail', ['id' => $item->product->id]) }}';"
                                                    style="cursor: pointer" class="align-items-center product-info row">
                                                    <div class="col-md-3 col-12"><img
                                                            src="{{ asset($item->product->avatar) }}"
                                                            class="img-fluid card-item-img"></div>
                                                    <div class="col-md-9 col-12">
                                                        <div class="product-name">{{ $item->product->name }}<span
                                                                class="text-777777">(x{{ $item->qty }})</span></div>
                                                        @if ($item->product_variation_id)
                                                            <div class="product-color">
                                                                @foreach ($item->productVariation->attributeVariations as $attributeVariation)
                                                                    {{ $attributeVariation->name }}
                                                                    @if (!$loop->last)
                                                                        ,
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-label="Tổng">
                                                {{ $item->product_variation_id
                                                    ? ($item->product->on_flash_sale
                                                        ? format_price($item->productVariation->flashsale_price * $item->qty)
                                                        : format_price($item->productVariation->promotion_price * $item->qty))
                                                    : ($item->product->on_flash_sale
                                                        ? format_price($item->product->flashsale_price * $item->qty)
                                                        : format_price($item->product->promotion_price * $item->qty)) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6 text-start">Tạm tính</div>
                            <div class="col-6 text-end"><strong>{{ format_price($total) }}</strong></div>
                            <div class="col-6 text-start">Giảm giá</div>
                            <div class="col-6 text-end"><strong>{{ format_price($discount_value) }}</strong></div>
                            <div class="col-6 border-bottom pb-1 text-start">Giao hàng</div>
                            <div class="col-6 border-bottom pb-1 text-end">Giao hàng miễn phí</div>
                            <div class="col-6 mt-1 text-start">Tổng</div>
                            <div class="col-6 mb-3 mt-1 text-end">
                                <strong>{{ format_price($total - $discount_value) }}</strong>
                            </div>
                        </div>
                        <h4>Phương thức thanh toán</h4>
                        <div class="col-12 mt-4">
                            @foreach ($payment_methods as $key => $value)
                                <div class="form-check">
                                    <input class="form-check-input ms-2" type="radio" name="order[payment_method]"
                                        id="payment_method{{ $key }}" value="{{ $key }}">
                                    <label class="form-check-label" for="payment_method{{ $key }}">
                                        {{ $value }}
                                    </label>
                                </div>
                                @if ($key == App\Enums\Payment\PaymentMethod::Online->value)
                                    <p class="text-777777">Thực hiện thanh toán vào ngay tài khoản ngân hàng của chúng tôi.
                                        Vui
                                        lòng
                                        sử dụng Mã đơn hàng của bạn trong phần Nội dung thanh toán. Đơn hàng sẽ được giao
                                        sau
                                        khi
                                        tiền
                                        đã chuyển.</p>
                                @endif
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-default w-100 mb-3"><strong>Đặt hàng</strong></button>
                    </div>
                </div>
            </x-form>

        </div>
    </div>
    <script>
        document.getElementById('formCheckout').addEventListener('submit', function(event) {
            var selectedRadioButton = document.querySelector('input[name="order[payment_method]"]:checked');
            if (!selectedRadioButton) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Lưu ý',
                    text: `Vui lòng chọn một phương thức thanh toán!`,
                    showConfirmButton: true
                });
            }
        });
        document.getElementById('showDetails').addEventListener('change', function() {
            var details = document.getElementById('details');
            if (this.checked) {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        });
    </script>
@endsection

@push('libs-js')
    <script src="{{ asset('/public/libs/select2/dist/js/select2.min.js') }}"></script>
@endpush

@push('custom-js')
    <script>
        $(document).ready(function(e) {
            select2LoadData($('#province_id').data('url'), '#province_id');

            let urlDistrict = "{{ route('admin.search.select.district') }}";
            let urlWard = "{{ route('admin.search.select.ward') }}";
            select2LoadData(urlDistrict, '#district_id');
            select2LoadData(urlWard, '#ward_id');
        });
        $(document).on('change', 'select[name="order[province_id]"]', function(e) {
            provinceId = $(this).val();
            let url = "{{ route('admin.search.select.district') }}";
            select2LoadData(url + '?province_id=' + provinceId, '#district_id');
            select2LoadData('', '#ward_id');
            $('#district_id').val(null).trigger('change');
            $('#ward_id').val(null).trigger('change');
        });

        $(document).on('change', 'select[name="order[district_id]"]', function(e) {
            districtId = $(this).val();
            let url = "{{ route('admin.search.select.ward') }}";
            select2LoadData(url + '?district_id=' + districtId, '#ward_id');
            $('#ward_id').val(null).trigger('change');
        });
    </script>
@endpush
