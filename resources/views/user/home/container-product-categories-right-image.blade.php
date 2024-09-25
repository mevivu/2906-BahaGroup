<div id="product-category" class="container shadow rounded-3">
    <div class="row">
        <div class="col-12 header-box d-flex align-items-center shadow-sm bg-white rounded-top">
            <h5 class="mb-0">Đồ gia dụng hiện đại</h5>
            <nav>
                <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                    <button class="nav-link tab-btn" data-bs-toggle="tab" data-bs-target="#nav-sport-1"
                        type="button" role="tab" aria-selected="false">Sports &
                        Travel</button>
                    <button class="nav-link tab-btn" id="nav-tv-1-tab" data-bs-toggle="tab" data-bs-target="#nav-tv-1" type="button"
                        role="tab" aria-controls="nav-tv-1" aria-selected="false">TV & Home
                        Appliances</button>
                    <button class="nav-link active tab-btn" id="nav-home-1-tab" data-bs-toggle="tab" data-bs-target="#nav-home-1"
                        type="button" role="tab" aria-controls="nav-home-1" aria-selected="true">Home & Kitchen</button>
                    <button id="allBtn" class="nav-link" onclick="location.href='{{ route('user.product.indexUser') }}';"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Tất cả</button>
                </div>
            </nav>
        </div>
        <div class="col-12 col-md-10">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home-1" role="tabpanel" aria-labelledby="nav-home-1-tab">
                    <div id="productCarousel-4" class="carousel slide">
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
                        <button class="carousel-control-prev left-btn-slider" type="button" data-bs-target="#productCarousel-4"
                            data-bs-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next right-btn-slider" type="button" data-bs-target="#productCarousel-4"
                            data-bs-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-sport-1" role="tabpanel">
                    <div id="productCarousel-5" class="carousel slide">
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
                        <button class="carousel-control-prev left-btn-slider" type="button" data-bs-target="#productCarousel-5"
                            data-bs-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next right-btn-slider" type="button" data-bs-target="#productCarousel-5"
                            data-bs-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-tv-1" role="tabpanel" aria-labelledby="nav-tv-1-tab">
                    <div id="productCarousel-6" class="carousel slide">
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
                        <button class="carousel-control-prev left-btn-slider" type="button" data-bs-target="#productCarousel-6"
                            data-bs-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next right-btn-slider" type="button" data-bs-target="#productCarousel-6"
                            data-bs-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-2 p-0">
            <a href="#" class="banner-img">
                <img loading="lazy" decoding="async"
                    src="{{ asset('public/user/assets/images/banner-home2-04.jpg') }}"
                    class="d-none d-xl-inline-block" alt="" width="100%">
            </a>
        </div>
    </div>
</div>