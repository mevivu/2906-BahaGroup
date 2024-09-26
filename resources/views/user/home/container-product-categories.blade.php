<div id="product-category" class="container shadow rounded-3">
    <div class="row">
        <div class="col-12 header-box d-flex align-items-center shadow-sm nav-tabs-wrapper bg-white rounded-top">
            <h5 class="mb-0">Thiết bị công nghệ hàng đầu</h5>
            <nav>
                <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                    <button class="nav-link tab-btn" id="nav-sport-tab" data-bs-toggle="tab" data-bs-target="#nav-sport"
                        type="button" role="tab" aria-controls="nav-sport" aria-selected="false">Sports &
                        Travel</button>
                    <button class="nav-link tab-btn" id="nav-tv-tab" data-bs-toggle="tab" data-bs-target="#nav-tv" type="button"
                        role="tab" aria-controls="nav-tv" aria-selected="false">TV & Home
                        Appliances</button>
                    <button class="nav-link tab-btn" id="nav-tv-tab" data-bs-toggle="tab" data-bs-target="#nav-tv" type="button"
                        role="tab" aria-controls="nav-tv" aria-selected="false">TV & Home
                        Appliances</button>
                    <button class="nav-link tab-btn active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home & Kitchen</button>
                    <button id="allBtn" class="nav-link" onclick="location.href='{{ route('user.product.indexUser') }}';"
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
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
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
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
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
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <x-cardproduct />
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
