@props(['product'])
<div class="card border-0 hover-shadow">
    <div class="position-relative">
        <img onclick="location.href='{{ route('user.product.detail', ['id' => $product->id]) }}';"
            class="card-img-top img-default" src="/2906-BahaGroup/{{ $product->avatar }}" style="cursor: pointer;"
            alt="Product 3">
        <img onclick="location.href='{{ route('user.product.detail', ['id' => $product->id]) }}';"
            class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg"
            alt="Product 3" style="display: none;cursor: pointer;">
        <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
        <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
    </div>
    <div class="card-body shadow-sm">
        <h6 class="card-title mb-1">
            <a class="text-black" href="{{ route('user.product.detail', ['id' => $product->id]) }}">
                {{ $product->name }}
            </a>
        </h6>
        <div class="rating fs-12">
            <span class="star text-warning">★</span>
            <span class="star text-warning">★</span>
            <span class="star text-warning">★</span>
            <span class="star text-warning">★</span>
            <span class="star text-warning">★</span>
            <span>100</span>
        </div>
        @if (!$product->promotion_price && !$product->price)
            <p>
                <strong
                    class="text-red">{{ $product->min_promotion_price ? format_price($product->min_promotion_price) : 0 }}
                    -</strong>
                <strong
                    class="text-red">{{ $product->max_promotion_price ? format_price($product->max_promotion_price) : 0 }}</strong>
            </p>
        @else
            <p>
                <del>{{ $product->price ? format_price($product->price) : 0 }}</del>
                <strong
                    class="text-red">{{ $product->promotion_price ? format_price($product->promotion_price) : 0 }}</strong>
            </p>
        @endif
        <div class="text-center product-hover">
            <a style="cursor: pointer;" class="add-to-cart">
                <i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50"
                    data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i>
            </a>
        </div>

    </div>
</div>
