@extends('user.layouts.master')
@section('title', __('Trang chủ'))

@section('content')
<div id="quickViewProductModal1" class="modal">
    <div class="modal-dialog modal-dialog-product-preview">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">Xem nhanh: Cell phone Silver</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body row">
                <div class="col-md-5 mt-5 mb-5">
                    <div class="position-relative text-center">
                        <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
                            <img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" alt="Product 1">
                            <img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" alt="Product 2">
                            <img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" alt="Product 3">
                            <img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" alt="Product 4">
                        </div>
                        <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                        <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                    </div>
                </div>

                <!-- Main content -->
                <div class="col-md-7 mt-5 mb-5">
                    <div style="border-bottom: 1px solid #f5f5f5" class="row align-items-center">
                        <div class="col-md-8">
                            <h3>Phụ kiện điện tử</h3>
                            <div class="rating">
                                <span class="star" style="color: #ffa200;">★</span>
                                <span class="star" style="color: #ffa200;">★</span>
                                <span class="star" style="color: #ffa200;">★</span>
                                <span class="star" style="color: #ffa200;">★</span>
                                <span class="star" style="color: #ffa200;">★</span>
                                <span>100 khách hàng đánh giá</span>
                                <span class="ms-2"><strong> Đã bán:</strong> 4</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end justify-content-between align-items-center">
                            <a class="lead" href="https://www.facebook.com/people/BaHa-Group/61559205100698/"><i class="fa-brands fa-facebook text-black"></i></a>
                            <a class="lead ms-2 me-2" href="https://www.tiktok.com/@baha_group_official"><i class="fa-brands fa-tiktok text-black"></i></a>
                            <a class="lead" href="https://www.linkedin.com/company/baha-group-joint-stock-company/?viewAsMember=true"><i class="fa-brands fa-linkedin text-black"></i></a>
                        </div>
                    </div>
                    <div class="row align-items-center ms-1 mt-3 mb-3">
                        <div class="col-md-8 bg-default text-white text-center h-100">End in
                            <strong>121 : 09 : 47 : 39</strong>
                        </div>
                        <div style="background-color: #f5f5f5;" class="col-md-4 text-center">Sold : 4/100</div>
                    </div>
                    <p class="lead"><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                    <div class="row">
                        <ul style="list-style-type: disc;">
                            <li>Multi port</li>
                            <li>Fast file transfer</li>
                            <li>Portable in design</li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span>Màu sắc: <strong>Black</strong></span><br>
                            <div class="row me-3 mt-2">
                                <a class="col-2 mb-2 bg-red custom-col btn btn-sm square-btn w-16 h-16 color-btn"></a>
                                <a class="col-2 mb-2 bg-yellow custom-col btn btn-sm square-btn w-16 h-16 color-btn"></a>
                                <a class="col-2 mb-2 bg-green custom-col btn btn-sm square-btn w-16 h-16 color-btn"></a>
                                <a class="col-2 mb-2 bg-pink custom-col btn btn-sm square-btn w-16 h-16 color-btn"></a>
                                <a class="col-2 mb-2 bg-black custom-col btn btn-sm square-btn w-16 h-16 color-btn out-of-stock"></a>
                                <a class="col-2 mb-2 bg-cyan custom-col btn btn-sm square-btn w-16 h-16 color-btn out-of-stock"></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span>Dung lượng:</span><br>
                            <div class="row me-3 mt-2">
                                <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-5 capacity-btn out-of-stock">
                                    <p class="ms-2 me-2 mt-3">128GB</p>
                                </a>
                                <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-5 capacity-btn">
                                    <p class="ms-2 me-2 mt-3">64GB</p>
                                </a>
                                <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-5 capacity-btn">
                                    <p class="ms-2 me-2 mt-3">32GB</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <span>Trạng thái: <span class="text-green">còn 96 Hàng</span></span>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="input-group mt-2">
                                <button class="btn btn-default" type="button" onclick="decrement()">-</button>
                                <input id="filter-input" class="form-control text-center" value="1" min="1">
                                <button class="btn btn-default" type="button" onclick="increment()">+</button>
                            </div>
                        </div>
                        <div class="col-md-4"><button class="btn btn-default-primary w-100 mt-2"><strong>Thêm vào giỏ</strong></button></div>
                        <div class="col-md-3"><button class="btn btn-default w-100 mt-2"><strong>Mua ngay</strong></button></div>
                    </div>
                    <div style="border-top: 1px solid #f5f5f5" class="row mt-5">
                        <p class="mt-2">SKU: 1558691521024</p>
                        <p>Danh mục:
                            <a href="#">Books & Audible</a>,
                            <a href="#">Garden</a>,
                            <a href="#">Health & Beauty</a>,
                            <a href="#">Home & Kitchen</a>,
                            <a href="#">Home Audio</a>,
                            <a href="#">Phụ kiện điện tử</a>,
                            <a href="#">Sports & Travel</a>,
                            <a href="#">Thiết bị điện tử</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div id="content" class="container-fluid d-flex justify-content-center align-items-center">
        @include('user.home.slider')
    </div>
    <div id="container-category" class="position-relative d-flex mt-3">
        @include('user.home.container-categories')
    </div>
    <div id="container-sale-off" class="position-relative d-flex mt-3">
        @include('user.home.container-sale-off')
    </div>
    <div id="container-sale-off" class="position-relative d-flex mt-3">
        @include('user.home.container-product-categories')
    </div>
    <div id="container-sale-off" class="position-relative d-flex mt-3">
        @include('user.home.container-product-categories-right-image')
    </div>
@endsection


