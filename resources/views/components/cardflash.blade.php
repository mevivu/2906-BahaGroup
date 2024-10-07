@props(['item'])

<div class="card border-0 hover-shadow shadow-sm">
    <div class="position-relative">
        <img onclick="location.href='{{ route('user.product.detail', ['id' => $item->product->id]) }}';" class="card-img-top img-default" src="/Mevivu_Company/2906-BahaGroup/{{ $item->product->avatar }}" style="cursor: pointer;" alt="Product 3">
        <img onclick="location.href='{{ route('user.product.detail', ['id' => $item->product->id]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
        <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">{{ $item->product->price != 0 ? ceil(100 - ($item->product->promotion_price * 100 / $item->product->price)) . '%' : ''}}</span>
        <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
    </div>
    <div class="card-body">
        <h6 class="card-title">
            <x-link class="text-black" :href="route('user.product.detail', ['id' => $item->product->id])">
                {{ $item->product->name }}
            </x-link>
        </h6>
        <div class="rating fs-12">
            @if ($item->avgReviewRate != 0)
                @for ($i = 0; $i < floor($item->avgReviewRate); $i++) 
                    <span class="star text-warning">★</span>
                @endfor
                @for ($i = 5; $i > floor($item->avgReviewRate); $i--)
                    <span style="color: gray" class="star">★</span>
                @endfor
                <span> {{ $item->sumCustomerReview }}</span>
            @else
                <span style="color: gray" class="star">★</span>
                <span style="color: gray" class="star">★</span>
                <span style="color: gray" class="star">★</span>
                <span style="color: gray" class="star">★</span>
                <span style="color: gray" class="star">★</span>
                <span>0</span>
            @endif
        </div>
        <p><del>{{ number_format($item->product->price, 0, '.', ',') }}₫</del> <strong class="text-red">{{ number_format($item->product->promotion_price, 0, '.', ',') }}₫</strong></p>

        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success text-white" role="progressbar"
                aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100" style="width: 95%">
                <div class="progress-icon">
                    <i class="fa fa-bolt"></i>
                </div>
                Sold: {{ $item->sold }}/{{ $item->in_stock }}
            </div>
        </div>
        <div class="text-center product-hover">
            <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="showDetailProductModal(this, {{ $item->product->id }})" aria-hidden="true"></i></a>
        </div>
    </div>
</div>