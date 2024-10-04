@extends('user.layouts.master')
@section('title', __('Danh mục sản phẩm'))

@section('content')
    <div class="container bg-white shadow rounded-2">
        <div class="row pt-3 pb-3">
            <a style="cursor: pointer" class="filter-icon d-none text-default mt-3">
                <i class="fa fa-filter me-2"></i> Lọc
            </a>
            <div class="col-md-2 category-filter" id="filter-container">
                <form action="" method="get">
                    <h6 class="text-uppercase">
                        <strong>Danh mục</strong>
                    </h6>
                    @foreach ($categories as $category)
                        <div class="d-flex align-items-center mb-1 fs-12">
                            <input name="category_ids[]" value="{{ $category->id }}" type="checkbox"
                                id="category{{ $category->id }}" class="me-2">
                            <label for="category{{ $category->id }}" class="mb-0"><i
                                    class="{{ $category->icon }} me-2"></i>{{ $category->name }}</label>
                        </div>
                    @endforeach

                    <h6 class="text-uppercase mt-3">
                        <strong>Màu sắc</strong>
                    </h6>
                    <div class="row me-3">
                        @foreach ($colors->variations as $co)
                            @if (isset($co->meta_value['color']))
                                <input type="button" name="color_ids[]"
                                    class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 color-btn-filter"
                                    style="background-color: {{ htmlspecialchars($co->meta_value['color']) }}">
                            @endif
                        @endforeach
                    </div>

                    <h6 class="text-uppercase mt-3">
                        <strong>Kích thước</strong>
                    </h6>
                    <div class="row me-3">
                        @foreach ($sizes->variations as $size)
                            <input type="button" name="size_ids[]"
                                class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 capacity-btn-filter"
                                value="{{ $size->name }}">
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <div class="price-filter">
                            <h6 class="text-uppercase mt-3">
                                <strong>Giá sản phẩm</strong>
                            </h6>
                            <div class="d-flex align-items-center mb-2">
                                <input type="range" id="min-price" name="min_price" class="form-range me-2"
                                    min="{{ $products['min_product_price'] }}" max="{{ $products['max_product_price'] }}"
                                    value="1000" oninput="updatePrice()">
                                <input type="range" id="max-price" name="max_price" class="form-range"
                                    min="{{ $products['min_product_price'] }}" max="{{ $products['max_product_price'] }}"
                                    value="9000" oninput="updatePrice()">
                            </div>
                            <div class="d-flex justify-content-between">
                                <span id="min-price-value">1000₫</span>
                                <i class="fa fa-arrow-circle-right"></i>
                                <span id="max-price-value">9000₫</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default w-100 mt-3 rounded-1">
                            <strong>Lọc</strong>
                        </button>
                    </div>
                </form>
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
                    @foreach ($productItems as $product)
                        <div class="col-6 col-md-3 mb-4">
                            <x-cardproduct :product="$product" />
                            <x-quickview />
                        </div>
                    @endforeach
                </div>
                <div class="pagination position-absolute w-100 bottom-0 mb-0 mt-3">
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
