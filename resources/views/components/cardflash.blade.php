<div class="card border-0 hover-shadow shadow-sm">
    <div class="position-relative">
        <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
        <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
        <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
        <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
    </div>
    <div class="card-body">
        <h6 class="card-title">
            <x-link class="text-black" :href="route('user.product.detail', ['id' => 1])">
                Cell phone Silver
            </x-link>
        </h6>
        <div class="rating fs-12">
            <span class="star text-warning">★</span>
            <span class="star text-warning">★</span>
            <span class="star text-warning">★</span>
            <span class="star text-warning">★</span>
            <span class="star text-warning">★</span>
            <span>100</span>
        </div>
        <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>

        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success text-white" role="progressbar"
                aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100" style="width: 95%">
                <div class="progress-icon">
                    <i class="fa fa-bolt"></i>
                </div>
                Sold: 95/100
            </div>
        </div>
        <div class="text-center product-hover">
            <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
        </div>
    </div>
</div>