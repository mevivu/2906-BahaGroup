@extends('user.layouts.master')
@section('title', __($title))

<head>
    <meta name="description" content="{{ $meta_desc }}">
</head>

@php
    $categoryRepository = app()->make(App\Admin\Repositories\Category\CategoryRepository::class);
    $categories = $categoryRepository->getFlatTree();
@endphp

@section('content')
<div class="container bg-white shadow rounded-2">
    <div class="row pt-3 pb-3">
        <a style="cursor: pointer" class="filter-icon d-none text-default mt-3">
            <i class="fa fa-filter me-2"></i> Lọc
        </a>
        <div class="col-md-2 category-filter" id="filter-container">
            <h6 class="text-uppercase">
                <strong>Danh mục</strong>
            </h6>
            @foreach ($categories as $category)
                <div class="d-flex align-items-center mb-1 fs-12">
                    <input name="category_ids[]" value="{{ $category->id }}" type="checkbox"
                        id="category{{ $category->id }}" class="me-2">
                    <label for="category{{ $category->id }}" class="mb-0">{{ $category->name }}</label>
                </div>
            @endforeach

            <h6 class="text-uppercase mt-3">
                <strong>Màu sắc</strong>
            </h6>
            <div class="row me-3">
                <a class="col-2 mb-2 bg-red custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                <a class="col-2 mb-2 bg-yellow custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                <a class="col-2 mb-2 bg-green custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                <a class="col-2 mb-2 bg-pink custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                <a class="col-2 mb-2 bg-black custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
                <a class="col-2 mb-2 bg-cyan custom-col btn btn-sm square-btn w-16 color-btn-filter"></a>
            </div>

            <h6 class="text-uppercase mt-3">
                <strong>Kích thước</strong>
            </h6>
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
                    <h6 class="text-uppercase mt-3">
                        <strong>Giá sản phẩm</strong>
                    </h6>
                    <div class="d-flex align-items-center mb-2">
                        <input type="range" id="min-price" class="form-range me-2" min="0" max="1000000" value="1000"
                            oninput="updatePrice()">
                        <input type="range" id="max-price" class="form-range" min="0" max="1000000" value="9000"
                            oninput="updatePrice()">
                    </div>
                    <div class="d-flex justify-content-between">
                        <span id="min-price-value">1000₫</span>
                        <i class="fa fa-arrow-circle-right"></i>
                        <span id="max-price-value">9000₫</span>
                    </div>
                </div>
                <button class="btn btn-default w-100 mt-3 rounded-1">
                    <strong>Lọc</strong>
                </button>
            </div>
        </div>
        <!-- Main content -->
        <div class="col-md-10 position-relative">
            <div class="row align-items-center nt">
                <div class="col-md-6">
                    <h5>Phụ kiện điện tử</h5>
                    <p class="fs-12">
                        Hiển thị tất cả
                        <span class="text-success">15 kết quả</span>
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <label for="sort" class="form-label fs-12">Sắp xếp theo:</label>
                    <select id="sort" class="form-select d-inline-block w-auto fs-12">
                        <option value="popularity">Thứ tự mặc định</option>
                        <option value="price-asc">Giá: Thấp đến Cao</option>
                        <option value="price-desc">Giá: Cao đến Thấp</option>
                    </select>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-6 col-md-3 mb-4">
                    <div class="card border-0 shadow hover-shadow">
                        <div class="position-relative">
                            <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';"
                                class="card-img-top img-default"
                                src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg"
                                style="cursor: pointer;" alt="Product 3">
                            <img onclick="location.href='{{ route('user.product.detail', ['id' => 1]) }}';"
                                class="card-img-top img-hover"
                                src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" alt="Product 3"
                                style="display: none;cursor: pointer;">
                            <span class="badge badge-danger position-absolute top-0 end-0 m-3">50%</span>
                            <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                <a class="text-black" href="{{ route('user.product.detail', ['id' => 1]) }}">
                                    Cell phone Silver
                                </a>
                            </h6>
                            <div class="rating">
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span>100</span>
                            </div>
                            <p class="mb-0">
                                <del>3,990,000₫</del> <strong class="text-red">2,990,000₫</strong>
                            </p>
                            <div class="text-center" style="height: 0px;">
                                <a style="cursor: pointer;" class="add-to-cart">
                                    <i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i
                                        class="fa fa-arrows-alt w-50" data-product-id="1" onclick="openModal(this)"
                                        aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <x-quickview />
                </div>
            </div>
            <div class="pagination position-absolute w-100 bottom-0 mb-0">
                <button class="pagination-btn prev" disabled><i class="fa fa-chevron-left"
                        aria-hidden="true"></i></button>
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