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
    }
    const endTime = '{{ $products[0]->product->on_flash_sale->end_time ?? 0 }}';
    if (endTime != 0) {
        updateCountdown();
        const countdownInterval = setInterval(updateCountdown, 1000);
    }
</script>
@endpush