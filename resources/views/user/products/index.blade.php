@extends('user.layouts.master')
@section('title', __('Danh mục sản phẩm'))

@section('content')
    <div class="container d-flex justify-content-center align-items-center bg-white">
        <div class="container">
            <div class="row">
                <a style="cursor: pointer" class="filter-icon d-none text-default mt-3">
                    <i class="fa fa-filter me-2"></i>Lọc</a>
                <div class="col-md-2 category-filter" id="filter-container">
                    <div class="mt-4">
                        <h6><strong>Categories</strong></h6>
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-decoration-none text-black">Babies & Toys</a>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-decoration-none text-black">Fashion & Clothing</a>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-decoration-none text-black">Fashion & Clothing</a>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h6><strong>Thương hiệu</strong></h6>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" id="brand1" class="me-2">
                            <label for="brand1" class="mb-0">Brand 1</label>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" id="brand2" class="me-2">
                            <label for="brand2" class="mb-0">Brand 2</label>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <input type="checkbox" id="brand3" class="me-2">
                            <label for="brand3" class="mb-0">Brand 3</label>
                        </div>
                    </div>

                    <h6 class="mt-4"><strong>Màu sắc</strong></h6>
                    <div class="row me-3">
                        <a class="col-2 mb-2 bg-red custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                        <a class="col-2 mb-2 bg-yellow custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                        <a class="col-2 mb-2 bg-green custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                        <a class="col-2 mb-2 bg-pink custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                        <a class="col-2 mb-2 bg-black custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                        <a class="col-2 mb-2 bg-cyan custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                    </div>
                    <h6 class="mt-4"><strong>Kích thước</strong></h6>
                    <div class="row me-3">
                        <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 capacity-btn-filter">41</a>
                        <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 capacity-btn-filter">41</a>
                        <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 capacity-btn-filter">41</a>
                        <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 capacity-btn-filter">41</a>
                        <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 capacity-btn-filter">41</a>
                        <a class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 capacity-btn-filter">41</a>
                    </div>
                    <div class="mt-2">
                        <div class="price-filter">
                            <h6><strong>Giá sản phẩm</strong></h6>
                            <div class="d-flex align-items-center mb-2">
                                <input type="range" id="min-price" class="form-range me-2" min="0" max="1000000" value="1000" oninput="updatePrice()">
                                <input type="range" id="max-price" class="form-range" min="0" max="1000000" value="9000" oninput="updatePrice()">
                            </div>
                            <div class="d-flex justify-content-between">
                                <span id="min-price-value">1000₫</span>
                                <i class="fa fa-arrow-circle-right"></i>
                                <span id="max-price-value">9000₫</span>
                            </div>
                        </div>
                        <button class="btn btn-default w-50 mt-2 mb-2"><strong>Lọc</strong></button>
                    </div>
                </div>
                <!-- Main content -->
                <div class="col-md-10 mt-3">
                    <div class="row align-items-center nt">
                        <div class="col-md-6">
                            <h5>Phụ kiện điện tử</h5>
                            <p>Hiển thị tất cả 15 kết quả</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <label for="sort" class="form-label">Sắp xếp theo:</label>
                            <select id="sort" class="form-select d-inline-block w-auto">
                                <option value="popularity">Thứ tự mặc định</option>
                                <option value="price-asc">Giá: Thấp đến Cao</option>
                                <option value="price-desc">Giá: Cao đến Thấp</option>
                            </select>
                        </div>
                    </div>
                    <div class="row no-gutters">
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
                                        <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                        <span>100</span>
                                    </div>
                                    <p><del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong></p>
                                    <div class="text-center">
                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
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
                        </div>
                    </div>
                    <div class="pagination">
                        <button class="pagination-btn prev" disabled><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                        <button class="pagination-btn">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn active">3</button>
                        <button class="pagination-btn">4</button>
                        <button class="pagination-btn">5</button>
                        <button class="pagination-btn next"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updatePrice() {
            var minPrice = document.getElementById('min-price').value;
            var maxPrice = document.getElementById('max-price').value;
            document.getElementById('min-price-value').textContent = minPrice + '₫';
            document.getElementById('max-price-value').textContent = maxPrice + '₫';
        }
        const filterIcon = document.querySelector('.filter-icon');
        const filterContainer = document.getElementById('filter-container');

        filterIcon.addEventListener('click', () => {
            filterContainer.classList.toggle('d-block');
        });
    </script>
@endsection



