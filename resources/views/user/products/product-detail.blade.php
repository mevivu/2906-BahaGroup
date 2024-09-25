@extends('user.layouts.master')
@section('title', __('Chi tiết sản phẩm'))

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
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-5 mb-5">
                    <div class="position-relative text-center">
                        <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
                            @foreach ($product->gallery as $item)
                                <img src="{{ asset($item) }}" alt="Product image">
                            @endforeach
                        </div>
                        @if(!isset($product->productVariations[0]))
                            <span class="badge badge-danger position-absolute top-0 end-0 m-3">{{ round(100 - $product->promotion_price / $product->price * 100) }}%</span>
                        @else
                            <span class="badge badge-danger position-absolute top-0 end-0 m-3">{{ round(100 - $product->productVariations[0]->promotion_price / $product->productVariations[0]->price * 100) }}%</span>
                        @endif
                        @if ($product->is_featured == App\Enums\DefaultActiveStatus::Active)
                            <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-7 mt-5 mb-5">
                    <div style="border-bottom: 1px solid #f5f5f5" class="row align-items-center">
                        <div class="col-md-8">
                            <h3>{{ $product->name }}</h3>
                            <div class="rating">
                                @for ($i = 1; $i <= $product->avg_rating ; $i++)
                                    <span class="star">★</span>
                                @endfor
                                @for ($i = 5; $i > $product->avg_rating ; $i--)
                                    <span style="color: gray" class="star">★</span>
                                @endfor
                                <span>{{ $product->reviews->count() }} khách hàng đánh giá</span>
                                <span class="ms-2"><strong> Đã bán:</strong> {{ $product->total_sold }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end justify-content-between align-items-center">
                            <a class="lead" href="https://www.facebook.com/people/BaHa-Group/61559205100698/"><i class="fa-brands fa-facebook text-black"></i></a>
                            <a class="lead ms-2 me-2" href="https://www.tiktok.com/@baha_group_official"><i class="fa-brands fa-tiktok text-black"></i></a>
                            <a class="lead" href="https://www.linkedin.com/company/baha-group-joint-stock-company/?viewAsMember=true"><i class="fa-brands fa-linkedin text-black"></i></a>
                        </div>
                    </div>
                    @if($product->on_flash_sale)
                    @php
                        $flash_sale = $product->on_flash_sale->details->where('product_id','=', $product->id)->first();
                    @endphp
                        <div class="row align-items-center ms-1 mt-3 mb-3">
                            <div class="col-md-8 bg-default text-white text-center h-100">End in
                                <strong id="countdown-flashsale-product"></strong>
                            </div>
                            <div style="background-color: #f5f5f5;" class="col-md-4 text-center">Sold : {{ $flash_sale->sold ?? 0 .'/'.$flash_sale->qty }}</div>
                        </div>
                    @endif


                    @if(!isset($product->productVariations[0]))
                        <p class="lead"><del>{{ format_price($product->price) }}</del> <strong class="text-red">{{ format_price($product->promotion_price) }}</strong></p>
                    @else
                        <p id="productDetailPrice" class="lead"><del id="productVariationPrice">{{ format_price($product->productVariations[0]->price) }}</del> <strong id="productVariationPromotionPrice" class="text-red">{{ format_price($product->productVariations[0]->promotion_price) }}</strong></p>
                    @endif

                    <x-input type="hidden" name="hidden_product_id" :value="$product->id" />


                    @if(isset($product->productVariations[0]))
                    <x-input type="hidden" name="hidden_quantity" />
                    <x-input type="hidden" name="hidden_product_variation_id" />
                        @foreach ($product->productAttributes as $item)
                            <div class="row">
                                <div class="col-md-12">
                                    <span>{{ $item->attribute->name }}: <strong id="attribute_variation_name{{ $item->attribute->id }}">Black</strong></span><br>
                                    <x-input id="hiddenAttribute" type="hidden" name="attribute_variation_ids[{{ $item->attribute->id }}]" />
                                    <div class="row me-3 mt-2">
                                        @foreach ($item->attribute->variations as $attributeVariation)
                                            @if($item->attribute->type == App\Enums\Attribute\AttributeType::Color)
                                                <a data-attribute-name="{{ $attributeVariation->name }}" data-attribute-id="{{ $item->attribute->id }}" data-attribute-variation-id="{{ $attributeVariation->id }}" class="col-2 mb-2 {{ $attributeVariation->meta_value }} custom-col btn btn-sm square-btn w-16 h-16 color-btn"></a>
                                            @else
                                                <a data-attribute-name="{{ $attributeVariation->name }}" data-attribute-id="{{ $item->attribute->id }}" data-attribute-variation-id="{{ $attributeVariation->id }}" class="col-2 mb-2 custom-col btn btn-sm square-btn w-5 capacity-btn">
                                                    <p class="ms-2 me-2 mt-3">{{ $attributeVariation->name }}</p>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <span>Trạng thái: <span id="instock" class="text-green">{{ $product->productVariations[0]->qty == 0 ? 'Hết' : 'còn '.$product->productVariations[0]->qty }} Hàng</span></span>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="input-group mt-2">
                                    <button disabled id="btnDecrement" class="btn btn-default" type="button" onclick="decrementDetail()">-</button>
                                    <input readonly onblur="isEnoughQuantity(this)" id="filter-input-detail" class="form-control text-center" value="1" min="1">
                                    <button disabled id="btnIncrement" class="btn btn-default" type="button" onclick="incrementDetail()">+</button>
                                </div>
                            </div>
                            <div class="col-md-4"><button id="btnAddToCart" disabled class="btn btn-default-primary w-100 mt-2"><strong>Thêm vào giỏ hàng</strong></button></div>
                            <div class="col-md-3"><button id="btnBuyNow" disabled class="btn btn-default w-100 mt-2"><strong>Mua ngay</strong></button></div>
                        </div>
                    @else
                        <x-input type="hidden" name="hidden_quantity" :value="$product->qty" />
                        <span>Trạng thái: <span class="text-green">{{ $product->qty == 0 ? 'Hết' : 'còn '.$product->qty }} Hàng</span></span>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="input-group mt-2">
                                    <button class="btn btn-default" type="button" onclick="decrementDetail()">-</button>
                                    <input onblur="isEnoughQuantity(this)" id="filter-input-detail" class="form-control text-center" value="1" min="1">
                                    <button class="btn btn-default" type="button" onclick="incrementDetail()">+</button>
                                </div>
                            </div>
                            <div class="col-md-4"><button id="btnAddToCart" class="btn btn-default-primary w-100 mt-2"><strong>Thêm vào giỏ hàng</strong></button></div>
                            <div class="col-md-3"><button id="btnBuyNow" class="btn btn-default w-100 mt-2"><strong>Mua ngay</strong></button></div>
                        </div>
                    @endif


                    <div style="border-top: 1px solid #f5f5f5" class="row mt-5">
                        <p class="mt-2">SKU: {{ $product->sku }}</p>
                        <p>Danh mục:
                            @foreach ($product->categories as $item)
                                <x-link class="text-default" :href="route('user.product.indexUser', ['category_id' => $item->id])">{{ $item->name }}</x-link>
                                @if (!$loop->last) , @endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row bg-white me-3">
                <div class="col-12 mt-4 ms-3">
                    <h4>Mô tả sản phẩm</h4>
                    <div>
                        {!! $product->desc !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row bg-white">
                <div class="col-12 d-flex align-items-center">
                    <h4 class="mt-3 ms-3 mb-3">Những đánh giá của khách hàng</h4>
                </div>
                <div class="col-12">
                    @foreach ($product->reviews as $review)
                        <div class="d-flex mb-3">
                            <img src="{{ $review->user->avatar ? asset($review->user->avatar) : asset(config('custom.images.default-rating')) }}" alt="Customer Image" class="customer-image me-3">
                                <div class="rating">
                                    <strong>{{ $review->user->fullname }}</strong> - {{ format_date_user($review->created_at) }}
                                    <br>
                                    @for ($i = 1; $i <= $review->rating ; $i++)
                                        <span class="star">★</span>
                                    @endfor
                                    @for ($i = 5; $i > $review->rating ; $i--)
                                    <span style="color: gray" class="star">★</span>
                                @endfor
                                    <p>{!! $review->content !!}</p>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row bg-white">
                <div class="col-12 header-box d-flex align-items-center">
                    <h4 class="mt-3 ms-1">Sản phẩm liên quan</h4>
                </div>
                <div class="col-12">
                    <div id="productCarousel-related" class="carousel slide">
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <div class="container">
                                    <div class="row">
                                        @foreach($relatedProducts->take(4) as $relatedProduct)
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => $relatedProduct->id]) }}';" class="card-img-top img-default" src="{{ asset($relatedProduct->avatar) }}" style="cursor: pointer;" alt="{{ $relatedProduct->name }}">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => $relatedProduct->id]) }}';" class="card-img-top img-hover" src="{{ asset($relatedProduct->gallery[0]) }}" alt="{{ $relatedProduct->name }}" style="display: none;cursor: pointer;">
                                                    @if(!isset($relatedProduct->productVariations[0]))
                                                        <span class="badge badge-danger position-absolute top-0 end-0 m-3">{{ round(100 - $relatedProduct->promotion_price / $relatedProduct->price * 100) }}%</span>
                                                    @else
                                                        <span class="badge badge-danger position-absolute top-0 end-0 m-3">{{ round(100 -$relatedProduct->productVariations[0]->promotion_price / $relatedProduct->productVariations[0]->price * 100) }}%</span>
                                                    @endif
                                                    @if($relatedProduct->is_featured)
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => $relatedProduct->id]) }}">{{ $relatedProduct->name }}</a></h6>
                                                    <div class="rating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <span class="star" style="color: {{ $i <= $relatedProduct->avg_rating ? '#ffa200' : '#ccc' }};">★</span>
                                                        @endfor
                                                        <span>{{ $relatedProduct->reviews->count() }}</span>
                                                    </div>
                                                    @if(!isset($relatedProduct->productVariations[0]))
                                                        <p><del>{{ format_price($relatedProduct->price) }}</del> <strong class="text-red">{{ format_price($relatedProduct->promotion_price) }}</strong></p>
                                                    @else
                                                        <p><del>{{ format_price($relatedProduct->productVariations[0]->price) }}</del> <strong id="productVariationPromotionPrice" class="text-red">{{ format_price($relatedProduct->productVariations[0]->promotion_price) }}</strong></p>
                                                    @endif
                                                    <div class="text-center">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="{{ $relatedProduct->id }}" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <div class="container">
                                    <div class="row">
                                        @foreach($relatedProducts->skip(4)->take(4) as $relatedProduct)
                                        <div class="col-6 col-md-3 mb-4">
                                            <div class="card border-0 hover-shadow">
                                                <div class="position-relative">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => $relatedProduct->id]) }}';" class="card-img-top img-default" src="{{ asset($relatedProduct->avatar) }}" style="cursor: pointer;" alt="{{ $relatedProduct->name }}">
                                                    <img onclick="location.href='{{ route('user.product.detail', ['id' => $relatedProduct->id]) }}';" class="card-img-top img-hover" src="{{ asset($relatedProduct->gallery[0]) }}" alt="{{ $relatedProduct->name }}" style="display: none;cursor: pointer;">
                                                    @if(!isset($relatedProduct->productVariations[0]))
                                                        <span class="badge badge-danger position-absolute top-0 end-0 m-3">{{ round(100 - $relatedProduct->promotion_price / $relatedProduct->price * 100) }}%</span>
                                                    @else
                                                        <span class="badge badge-danger position-absolute top-0 end-0 m-3">{{ round(100 - $relatedProduct->productVariations[0]->promotion_price / $relatedProduct->productVariations[0]->price * 100) }}%</span>
                                                    @endif
                                                    @if($relatedProduct->is_featured)
                                                    <span class="badge badge-featured position-absolute top-0 start-0 m-3">Nổi bật</span>
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a class="text-black" href="{{ route('user.product.detail', ['id' => $relatedProduct->id]) }}">{{ $relatedProduct->name }}</a></h6>
                                                    <div class="rating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                        <span class="star" style="color: {{ $i <= $relatedProduct->avg_rating ? '#ffa200' : '#ccc' }};">★</span>
                                                        @endfor
                                                        <span>{{ $relatedProduct->reviews->count() }}</span>
                                                    </div>
                                                    @if(!isset($relatedProduct->productVariations[0]))
                                                        <p><del>{{ format_price($relatedProduct->price) }}</del> <strong class="text-red">{{ format_price($relatedProduct->promotion_price) }}</strong></p>
                                                    @else
                                                        <p><del>{{ format_price($relatedProduct->productVariations[0]->price) }}</del> <strong id="productVariationPromotionPrice" class="text-red">{{ format_price($relatedProduct->productVariations[0]->promotion_price) }}</strong></p>
                                                    @endif
                                                    <div class="text-center">
                                                        <a style="cursor: pointer;" class="add-to-cart"><i class="fa fa-shopping-cart w-50" aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="{{ $relatedProduct->id }}" onclick="openModal(this)" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev left-btn-slider-related" type="button" data-bs-target="#productCarousel-related"
                            data-bs-slide="prev">
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="carousel-control-next right-btn-slider-related" type="button" data-bs-target="#productCarousel-related"
                            data-bs-slide="next">
                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')

@include('user.products.scripts.scripts')

@endpush




