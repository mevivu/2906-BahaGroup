<div class="container shadow rounded-3">
    <div class="row">
        <div class="col-12 header-box d-flex align-items-center shadow-sm bg-white rounded-top">
            <h5 class="mb-0">Sản phẩm ưu đãi</h5>
            @if($on_flash_sale)
            @php
                $flash_sale = $products[0]->product->on_flash_sale->details->where('product_id','=', $products[0]->product->id)->first();
            @endphp
            <div class="timer rounded-3 shadow-sm">
                <p class="mt-1"><span id="countdown-flashsale-product">216:19:42:02</span></p>
            </div>
            @endif
        </div>
        <div class="col-12">
            <div id="productCarousel-7" class="carousel slide">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                @for ($i = 0; $i < count($products); $i++)
                                <div class="col-6 col-md-3">
                                    <x-cardflash :item="$products[$i]"/>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    @if (count($products) > 4)
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                @for ($i = 4; $i < count($products); $i++)
                                <div class="col-6 col-md-3">
                                    <x-cardflash :item="$products[$i]"/>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <button class="carousel-control-prev left-btn-slider" type="button" data-bs-target="#productCarousel-7"
                    data-bs-slide="prev">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="carousel-control-next right-btn-slider" type="button" data-bs-target="#productCarousel-7"
                    data-bs-slide="next">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@push('custom-js')
<script>
    function updateCountdown() {
        const startTime = new Date();
        const endTime = new Date('{{ $products[0]->product->on_flash_sale->end_time ?? 0 }}');

        const diffInMs = endTime - startTime;
        const diffInHours = Math.floor(diffInMs / 3600000);
        const diffInMinutes = Math.floor((diffInMs % 3600000) / 60000);
        const diffInSeconds = Math.floor((diffInMs % 60000) / 1000);
        const diffInMilliseconds = diffInMs % 1000;
        const formattedTime =
            `${diffInHours.toString().padStart(2, '0')} : ${diffInMinutes.toString().padStart(2, '0')} : ${diffInSeconds.toString().padStart(2, '0')}`;
        console.log(formattedTime);
        document.getElementById('countdown-flashsale-product').textContent = formattedTime;
        document.getElementById('countdown-flashsale-product-modal').textContent = formattedTime;
    }
    const endTime = '{{ $products[0]->product->on_flash_sale->end_time ?? 0 }}';
    if (endTime != 0) {
        updateCountdown();
        const countdownInterval = setInterval(updateCountdown, 1000);
    }
    function showDetailProductModal(modal, product_id) {
        openModal(modal);
        console.log('product_id: ' + product_id);
        $.ajax({
            type: "GET",
            url: '{{ route("user.product.detailModal", ":id") }}'.replace(':id', product_id),
            data: {
            },
            success: function(res) {
                console.log(res);
                $('#quickViewProductModal1 #modal-title').text('Xem nhanh: ' + res.product.name);
                $('#quickViewProductModal1 #badge-promotion-percent').text(Math.round(100 - res.product.promotion_price / res.product.price * 100) + '%')
                $('#quickViewProductModal1 #product_name_modal').text(res.product.name);
                $('#quickViewProductModal1 #price_modal').text((res.product.price).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                $('#quickViewProductModal1 #promotion_price_modal').text((res.product.promotion_price).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
                $('#quickViewProductModal1 #quantity_product_modal').text(res.product.qty == 0 ? 'Hết Hàng' : `Còn ${res.product.qty} Hàng`);
                if (res.avgReviewRate != 0) {
                    $('#quickViewProductModal1 .rating').html('');
                    for (i = 0; i < parseInt(res.avgReviewRate); i++) {
                        $('#quickViewProductModal1 .rating').append(`<span class="star">★</span>`);
                    }
                    for (i = 5; i > parseInt(res.avgReviewRate); i--) {
                        $('#quickViewProductModal1 .rating').append(`<span style="color: gray" class="star">★</span>`);
                    }
                    $('#quickViewProductModal1 .rating').append(`<span> ${res.sumCustomerReview} khách hàng đánh giá</span>
                            <span class="ms-2 text-uppercase">Đã bán: 4</span>`)
                }
                else {
                    $('#quickViewProductModal1 .rating').html('');
                    $('#quickViewProductModal1 .rating').append(`
                        <span style="color: gray" class="star">★</span>
                        <span style="color: gray" class="star">★</span>
                        <span style="color: gray" class="star">★</span>
                        <span style="color: gray" class="star">★</span>
                        <span style="color: gray" class="star">★</span>
                        <span>0 khách hàng đánh giá</span>
                        <span class="ms-2 text-uppercase">Đã bán: 0</span>
                    `);
                }
            },
            error: function(res) {
                console.log(res.error);
            },
        });
    }
</script>
@endpush