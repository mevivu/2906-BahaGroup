@extends('user.layouts.master')

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
                                    <input id="filter-input" class="form-control text-center" value="0" min="0">
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
    <div class="row container">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </div>
    </div>
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
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
                            <a class="lead" href="#"><i class="fa text-black fa-facebook-square"></i></a>
                            <a class="lead ms-2 me-2" href="#"><i class="fa text-black fa-envelope-open-o"></i></a>
                            <a class="lead me-2" href="#"><i class="fa text-black fa-google"></i></a>
                            <a class="lead" href="#"><i class="fa text-black fa-linkedin-square"></i></a>
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
                                <input id="filter-input" class="form-control text-center" value="0" min="0">
                                <button class="btn btn-default" type="button" onclick="increment()">+</button>
                            </div>
                        </div>
                        <div class="col-md-4"><button class="btn btn-default-primary w-100 mt-2"><strong>Thêm vào giỏ hàng</strong></button></div>
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
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row bg-white">
                <div class="col-12 mt-4 ms-3">
                    <h4>Mô tả sản phẩm</h4>
                    <p class="me-4">Apple iPhone 6s smartphone was launched in September 2015. The phone comes with a 4.70-inch touchscreen display with a resolution of 750×1334 pixels at a pixel density of 326 pixels per inch (ppi) and an aspect ratio of 16:9. Apple iPhone 6s is powered by a 1.84GHz dual-core A9 processor. It comes with 2GB of RAM. The Apple iPhone 6s runs iOS 9 and is powered by a 1,715mAh non-removable battery. As far as the cameras are concerned, the Apple iPhone 6s on the rear packs a 12-megapixel camera with an f/2.2 aperture and a pixel size of 1.22-micron. The rear camera setup has phase detection autofocus. It sports a 5-megapixel camera on the front for v selfies, with an f/2.2 aperture.
                    </p>
                    <p class="me-4">
                        Connectivity options on the Apple iPhone 6s include Wi-Fi 802.11 a/b/g/n/ac, GPS, Bluetooth v4.20, NFC, Lightning, 3G, and 4G (with support for Band 40 used by some LTE networks in India). Sensors on the phone include accelerometer, ambient light sensor, barometer, compass/ magnetometer, gyroscope, proximity sensor, and fingerprint sensor.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <img class="product-img-front" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" alt="">
                        </div>
                        <div class="col-md-6">
                            <img class="product-img-back" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" alt="">
                        </div>
                    </div>
                    <p class="mt-3 me-4"><strong>Camera: Rear image quality: </strong>Still image quality using the rear facing (main) camera. It is based on objective and subjective judgments of test images, which includes evaluating resolution, dynamic range, color accuracy, and visual noise.</p>
                    <p class="mt-3 me-4"><strong>Camera: Rear image quality: </strong>Still image quality using the rear facing (main) camera. It is based on objective and subjective judgments of test images, which includes evaluating resolution, dynamic range, color accuracy, and visual noise.</p>
                    <p class="mt-3 me-4"><strong>Camera: Rear image quality: </strong>Still image quality using the rear facing (main) camera. It is based on objective and subjective judgments of test images, which includes evaluating resolution, dynamic range, color accuracy, and visual noise.</p>
                    <p class="mt-3 me-4">The Apple iPhone 6s is part of the Cell phone & service test program at Consumer Reports. In our lab tests, Cell phone & service models like the iPhone 6s are rated on multiple criteria, such as those listed below. The Apple iPhone 6s measures 138.30 x 67.10 x 7.10mm (height x width x thickness) and weighs 143.00 grams. It was launched in Silver, Gold, Space Grey, and Rose Gold colours. It bears a metal body.</p>
                    <h4>Những đánh giá của khách hàng</h4>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="d-flex mb-3">
                                <img src="https://secure.gravatar.com/avatar/75d23af433e0cea4c0e45a56dba18b30?s=60&d=mm&r=g" alt="Customer Image" class="customer-image me-3">
                                <div>
                                    <p><strong>Nguyễn Văn A</strong> - 15/08/2024</p>
                                    <div class="rating">
                                        <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    </div>
                                    <p>Sản phẩm rất tốt, tôi rất hài lòng!</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="https://secure.gravatar.com/avatar/75d23af433e0cea4c0e45a56dba18b30?s=60&d=mm&r=g" alt="Customer Image" class="customer-image me-3">
                                <div>
                                    <p><strong>Trần Thị B</strong> - 14/08/2024</p>
                                    <div class="rating">
                                        <span class="star" style="color: #ffa200;">★</span>
                                        <span class="star" style="color: #ffa200;">★</span>
                                        <span class="star" style="color: #ffa200;">★</span>
                                        <span class="star" style="color: #ffa200;">★</span>
                                        <span class="star" style="color: #ccc;">★</span>
                                    </div>
                                    <p>Giao hàng nhanh, chất lượng ổn.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row bg-white">
                <div class="col-12 header-box d-flex align-items-center">
                    <h4 class="mt-3 ms-3">Sản phẩm liên quan</h4>
                </div>
                <div class="col-12">
                    <div id="productCarousel-7" class="carousel slide">
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
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center">
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
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center">
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
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center">
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
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center">
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
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" style="cursor: pointer;" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" class="card-img-top mt-3" alt="Product 3">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" style="cursor: pointer;" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" class="card-img-top mt-3" alt="Product 3">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" style="cursor: pointer;" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" class="card-img-top mt-3" alt="Product 3">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';" style="cursor: pointer;" src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg" class="card-img-top mt-3" alt="Product 3">
                                                    <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">Cell phone Silver</a></h6>
                                                    <div class="rating">
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span class="star" style="color: #ffa200;">★</span>
                                                        <span>100</span>
                                                    </div>
                                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                                    <div class="text-center">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev left-btn-slider-related" type="button" data-bs-target="#productCarousel-7"
                            data-bs-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next right-btn-slider-related" type="button" data-bs-target="#productCarousel-7"
                            data-bs-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




