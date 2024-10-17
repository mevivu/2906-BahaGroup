@extends('user.layouts.master')
@section('title', __($title))

<style>
    .size-filter {
        display: block;
        position: relative;
        margin-bottom: 12px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }

    .size-filter input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        border-radius: 20%;
        border: 2px solid black;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .size-filter #checkAll,
    input:checked~.checkmark:after {
        display: block;
    }

    .size-filter .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid #eee;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>

<head>
    <meta name="description" content="{{ $meta_desc }}">
</head>

@section('content')
    @include('user.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    <div class="rounded-2 container bg-white shadow">
        <div class="row pb-3 pt-3">
            <a style="cursor: pointer" class="filter-icon d-none text-default mt-3">
                <i class="fa fa-filter me-2"></i> Lọc
            </a>
            <div class="col-md-2 category-filter" id="filter-container">
                <x-form action="" method="get" class="filter-form" id="filter-form">
                    <h6 class="text-uppercase">
                        <strong>Bạn đã chọn</strong>
                    </h6>

                    <div class="row fs-12 mb-1" id="filter-chips-container"></div>

                    <h6 class="text-uppercase">
                        <strong>Danh mục</strong>
                    </h6>

                    @foreach ($categories as $category)
                        <div class="d-flex align-items-center fs-12 mb-1">
                            <input name="category_slugs[]" value="{{ $category->slug }}" type="checkbox"
                                id="category{{ $category->slug }}" class="category-checkbox me-2" autocomplete="off"
                                @if (in_array($category->slug, request('category_slugs', []))) checked @endif>
                            <label for="category{{ $category->slug }}" class="mb-0">
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
                                        <input id="checkAll" type="checkbox" name="color_slugs[]"
                                            value="{{ $co->slug }}" autocomplete="off"
                                            @if (in_array($co->slug, request('color_slugs', []))) checked @endif>
                                        <span class="checkmark"
                                            style="background-color: {{ htmlspecialchars($co->meta_value['color']) }}"
                                            title="{{ $co->name }}"></span>
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
                            <input type="checkbox" class="btn-check" id="btn-check-{{ $size->slug }}" name="size_slugs[]"
                                value="{{ $size->slug }}" autocomplete="off"
                                @if (in_array($size->slug, request('size_slugs', []))) checked @endif>
                            <label
                                class="col-2 custom-col btn btn-sm square-btn capacity-btn-filter btn-check-label btn-outline-secondary text-dark mb-2 w-16"
                                for="btn-check-{{ $size->slug }}">{{ $size->name }}</label>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <div class="price-filter">
                            <h6 class="text-uppercase mt-3">
                                <strong>Giá sản phẩm</strong>
                            </h6>
                            <div class="d-flex align-items-center fs-12 mb-1"><input type="checkbox" id="filter-by-price"
                                    class="me-2" autocomplete="off" @if (request('min_product_price') && request('max_product_price')) checked @endif>
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
                                <span id="min-price-value">{{ format_price($minMax['min_product_price']) }}</span>
                                <i class="fa fa-arrow-circle-right"></i>
                                <span id="max-price-value">{{ format_price($minMax['max_product_price']) }}</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default w-100 rounded-1 mt-3">
                            <strong>Lọc</strong>
                        </button>
                    </div>
                </x-form>
            </div>
            <!-- Main content -->
            <div class="col-md-10 position-relative">
                <div class="row align-items-center nt">
                    <div class="col-md-6">
                        <h5>Phụ kiện điện tử</h5>
                        <p class="fs-12">
                            Hiển thị tất cả
                            <span class="text-success">{{ $products->count() }} kết quả</span>
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <label for="sort" class="form-label fs-12">Sắp xếp theo:</label>
                        <select id="sort" class="form-select d-inline-block fs-12 w-auto">
                            <option {{ $sort === null ? 'selected' : '' }} value="default">Thứ tự mặc định</option>
                            <option {{ $sort === 'asc' ? 'selected' : '' }} value="price-asc">Giá: Thấp đến Cao</option>
                            <option {{ $sort === 'desc' ? 'selected' : '' }} value="price-desc">Giá: Cao đến Thấp</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    @foreach ($products as $item)
                        <div class="col-6 col-md-3 mb-4 shadow-lg">
                            <x-cardproduct :item="$item" />
                        </div>
                    @endforeach
                </div>

                <div class="pagination w-100 d-flex justify-content-center bottom-0 mb-0 mt-3">
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
@endsection

@push('custom-js')
    @include('user.products.scripts.scripts')
@endpush
