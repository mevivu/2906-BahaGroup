<div id="product-category" class="container shadow rounded-3">
    <div class="row">
        <div class="col-12 header-box d-flex align-items-center shadow-sm">
            <h4 class="mb-0">Thiết bị công nghệ hàng đầu</h4>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link" id="nav-sport-tab" data-bs-toggle="tab" data-bs-target="#nav-sport"
                        type="button" role="tab" aria-controls="nav-sport" aria-selected="false">Sports &
                        Travel</button>
                    <button class="nav-link" id="nav-tv-tab" data-bs-toggle="tab" data-bs-target="#nav-tv" type="button"
                        role="tab" aria-controls="nav-tv" aria-selected="false">TV & Home
                        Appliances</button>
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home & Kitchen</button>
                    <button class="nav-link" onclick="location.href='{{ route('user.product.indexUser') }}';"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tất cả</button>
                </div>
            </nav>
        </div>
        <div class="col-12 col-md-2 p-0">
            <a href="#" class="banner-img">
                <img loading="lazy" decoding="async"
                    src="{{ asset('public/user/assets/images/banner-home2-04.jpg') }}"
                    class="d-none d-xl-inline-block" alt="">
            </a>
        </div>
        <div class="col-12 col-md-10">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div id="productCarousel-1" class="carousel slide">
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Điều khiển carousel -->
                        <button class="carousel-control-prev left-btn-slider" type="button" data-bs-target="#productCarousel-1"
                            data-bs-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next right-btn-slider" type="button" data-bs-target="#productCarousel-1"
                            data-bs-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-sport" role="tabpanel" aria-labelledby="nav-sport-tab">
                    <div id="productCarousel-2" class="carousel slide">
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a class="add-to-cart" href="#"><i style="border-radius: 20px;" class="fa fa-shopping-cart w-100" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a class="add-to-cart" href="#"><i style="border-radius: 20px;" class="fa fa-shopping-cart w-100" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Thêm nhiều slide khác ở đây nếu cần -->
                        </div>
                        <!-- Điều khiển carousel -->
                        <button class="carousel-control-prev left-btn-slider" type="button" data-bs-target="#productCarousel-2"
                            data-bs-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next right-btn-slider" type="button" data-bs-target="#productCarousel-2"
                            data-bs-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-tv" role="tabpanel" aria-labelledby="nav-tv-tab">
                    <div id="productCarousel-3" class="carousel slide">
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-default" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" style="cursor: pointer;" alt="Product 3">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" class="card-img-top img-hover" src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3" style="display: none;cursor: pointer;">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3 text-white">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body shadow-sm">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span class="star text-warning">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center product-hover">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Thêm nhiều slide khác ở đây nếu cần -->
                        </div>
                        <!-- Điều khiển carousel -->
                        <button class="carousel-control-prev left-btn-slider" type="button" data-bs-target="#productCarousel-3"
                            data-bs-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next right-btn-slider" type="button" data-bs-target="#productCarousel-3"
                            data-bs-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
