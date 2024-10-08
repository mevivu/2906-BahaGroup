@extends('user.layouts.master')
@section('title', __('Danh mục sản phẩm'))

@section('content')
    <div class="container bg-white shadow rounded-2">
        <div class="row pt-3 pb-3">
            <a style="cursor: pointer" class="filter-icon d-none text-default mt-3">
                <i class="fa fa-filter me-2"></i> Lọc
            </a>
            <div class="col-md-2 category-filter" id="filter-container">
                <form action="" method="get" class="filter-form" id="filter-form">
                    <h6 class="text-uppercase">
                        <strong>Danh mục</strong>
                    </h6>

                    @foreach ($categories as $category)
                        <div class="d-flex align-items-center mb-1 fs-12">
                            <input name="category_ids[]" value="{{ $category->id }}" type="checkbox"
                                id="category{{ $category->id }}" class="me-2" autocomplete="off"
                                @if (in_array($category->id, request('category_ids', []))) checked @endif>
                            <label for="category{{ $category->id }}" class="mb-0">
                                <i class="{{ $category->icon }} me-2"></i>{{ $category->name }}
                            </label>
                        </div>
                    @endforeach


                    <h6 class="text-uppercase mt-3">
                        <strong>Màu sắc</strong>
                    </h6>
                    <div class="row me-3">
                        @foreach ($colors->variations as $co)
                            @if (isset($co->meta_value['color']))
                                <div class="col-2 mb-2">
                                    <label class="size-filter">
                                        <span style="display: none">tow</span>
                                        <input id="checkAll" type="checkbox" name="color_ids[]" value="{{ $co->id }}"
                                            autocomplete="off" @if (in_array($co->id, request('color_ids', []))) checked @endif>
                                        <span class="checkmark"
                                            style="background-color: {{ htmlspecialchars($co->meta_value['color']) }}"></span>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <h6 class="text-uppercase mt-3">
                        <strong>Kích thước</strong>
                    </h6>
                    <div class="row me-3">
                        @foreach ($sizes->variations as $size)
                            <input type="checkbox" class="btn-check" id="btn-check-{{ $size->id }}" name="size_ids[]"
                                value="{{ $size->id }}" autocomplete="off"
                                @if (in_array($size->id, request('size_ids', []))) checked @endif>
                            <label
                                class="col-2 mb-2 custom-col btn btn-sm square-btn w-16 capacity-btn-filter btn-check-label btn-outline-secondary text-dark"
                                for="btn-check-{{ $size->id }}">{{ $size->name }}</label>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <div class="price-filter">
                            <h6 class="text-uppercase mt-3">
                                <strong>Giá sản phẩm</strong>
                            </h6>
                            <div class="d-flex align-items-center mb-1 fs-12">
                                <input type="checkbox" id="filter-by-price" class="me-2" autocomplete="off"
                                    @if (request('min_product_price') && request('max_product_price')) checked @endif>
                                <label for="filter-by-price" class="mb-0">Lọc theo giá</label>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <input type="range" id="min-price" name="min_product_price" class="form-range me-2"
                                    min="{{ $minMax['min_product_price'] }}" max="{{ $minMax['max_product_price'] }}"
                                    value="{{ $minMax['min_product_price'] }}" oninput="updatePrice()"
                                    @if (!request('min_product_price')) disabled @endif>
                                <input type="range" id="max-price" name="max_product_price" class="form-range"
                                    min="{{ $minMax['min_product_price'] }}" max="{{ $minMax['max_product_price'] }}"
                                    value="{{ $minMax['max_product_price'] }}" oninput="updatePrice()"
                                    @if (!request('max_product_price')) disabled @endif>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span id="min-price-value">{{ $minMax['min_product_price'] }}₫</span>
                                <i class="fa fa-arrow-circle-right"></i>
                                <span id="max-price-value">{{ $minMax['max_product_price'] }}₫</span>
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
                    @foreach ($products as $item)
                        <div class="col-6 col-md-3 mb-4">
                            <x-product-items :product="$item" />
                            <x-quickview />
                        </div>
                    @endforeach
                </div>

                <div class="pagination position-absolute w-100 bottom-0 mb-0 mt-3 d-flex justify-content-center">
                    <button class="pagination-btn prev" @if ($products->onFirstPage()) disabled @endif
                        onclick="window.location='{{ $products->previousPageUrl() }}'">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <button class="pagination-btn @if ($i == $products->currentPage()) active @endif"
                            onclick="window.location='{{ $products->url($i) }}'">
                            {{ $i }}
                        </button>
                    @endfor

                    <button class="pagination-btn next" @if (!$products->hasMorePages()) disabled @endif
                        onclick="window.location='{{ $products->nextPageUrl() }}'">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </button>
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

        const sort = document.getElementById('sort');
        sort.addEventListener('change', function() {
            if (this.value === 'popularity') {
                window.location = '{{ route('user.product.indexUser') }}';
            } else if (this.value === 'price-asc') {
                window.location = '{{ route('user.product.indexUser') }}?sort=asc';
            } else if (this.value === 'price-desc') {
                window.location = '{{ route('user.product.indexUser') }}?sort=desc';
            }
        });

        const filterByPriceCheckbox = document.getElementById('filter-by-price');
        const minPriceInput = document.getElementById('min-price');
        const maxPriceInput = document.getElementById('max-price');

        filterByPriceCheckbox.addEventListener('change', () => {
            if (filterByPriceCheckbox.checked) {
                // Kích hoạt input range
                minPriceInput.disabled = false;
                maxPriceInput.disabled = false;
            } else {
                // Vô hiệu hóa input range
                minPriceInput.disabled = true;
                maxPriceInput.disabled = true;
            }
        });
    </script>
@endsection
