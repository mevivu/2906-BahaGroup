<div @class(['item-product', 'product-'.$flash_sale_detail['product']['id']]) class="col-12 col-md-9">
    <div class="card mt-3">
        <div class="row card-body">
            <span data-id="{{ $flash_sale_detail->id }}" style="font-size: 1em; max-width: 50px; cursor: pointer;" class="remove-item-product">
                <i class="ti ti-x"></i>
            </span>
            <x-input type="hidden" name="product_id[]" :value="$flash_sale_detail['product']['id']" />
            @if ($flash_sale_detail['product']['type'] == App\Enums\Product\ProductType::Simple)
                <x-input id="hidden-quantity-{{ $flash_sale_detail['product']['id'] }}" type="hidden" :value="$flash_sale_detail['product']['qty']" />
            @else
                <x-input id="hidden-quantity-{{ $flash_sale_detail['product']['id'] }}" type="hidden" :value="$flash_sale_detail['product']['total_qty']" />
            @endif
            <div class="row">
                <div class="col-md-9">
                    <label for=""></label>
                    <div class="mb-3">
                        <span class=""><img width="64" height="64" class="img-fluid" src="{{ asset($flash_sale_detail['product']['avatar']) }}" alt=""> - {{ $flash_sale_detail['product']['name'] }} - {{ format_price($flash_sale_detail['product']['selling_price']) }} -
                            Số lượng:
                                @if ($flash_sale_detail['product']['type'] == App\Enums\Product\ProductType::Simple)
                                    {{ $flash_sale_detail['product']['qty'] }}
                                @else
                                    {{ $flash_sale_detail['product']['total_qty'] }}
                                @endif
                            - {{ $flash_sale_detail['product']['sku'] }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="">{{ __('Số lượng tham gia:') }}</label>
                        <x-input data-id="{{ $flash_sale_detail['product']['id'] }}" id="input-quantity" type="number" name="qty[{{ $flash_sale_detail['product']['id'] }}]" :value="$flash_sale_detail['qty']" :required="true" min="1" class="text-center" onblur="checkQuantity(this)"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkQuantity(element) {
        var inputQuantity = element.value;
        var id = element.getAttribute('data-id');
        var hiddenQuantity = document.getElementById(`hidden-quantity-${id}`).value;

        if (parseInt(inputQuantity) > parseInt(hiddenQuantity)) {
            Swal.fire({
                icon: 'warning',
                title: 'Lưu ý',
                text: 'Số lượng tham gia phải nhỏ hơn hoặc bằng số lượng sản phẩm còn lại!',
                showConfirmButton: true
            });
            element.value = hiddenQuantity;
        }
    }
</script>
