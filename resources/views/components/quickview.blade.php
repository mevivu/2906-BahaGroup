<div id="resultQuickViewRequest">
 @if (isset($productModal))
     <div id="quickViewProductModal" class="modal">
         <div class="modal-dialog modal-dialog-product-preview">
             <div class="modal-content">
                 <div class="modal-header">
                     <a href="#" data-dismiss="modal" class="class pull-right"><span
                             class="glyphicon glyphicon-remove"></span></a>
                     <h5 class="modal-title" id="modal-title">{{ $productModal->name }}</h5>
                     <span class="close">
                         <i class="ti ti-x"></i>
                     </span>
                 </div>
                 <div class="modal-body row">
                     <div class="col-md-5 mb-5 mt-5">
                         <div class="position-relative text-center">
                             <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
                                 @foreach ($productModal->gallery as $item)
                                     <img src="{{ asset($item) }}" alt="Product image">
                                 @endforeach
                             </div>
                             @if (!isset($productModal->productVariations[0]))
                                 <span
                                     class="badge badge-danger position-absolute end-0 top-0 m-3">{{ round(100 - ($productModal->promotion_price / $productModal->price) * 100) }}%</span>
                             @else
                                 <span
                                     class="badge badge-danger position-absolute end-0 top-0 m-3">{{ round(100 - ($productModal->productVariations[0]->promotion_price / $productModal->productVariations[0]->price) * 100) }}%</span>
                             @endif
                             @if ($productModal->is_featured == App\Enums\DefaultActiveStatus::Active)
                                 <span class="badge badge-featured position-absolute start-0 top-0 m-3">Nổi
                                     bật</span>
                             @endif
                         </div>
                     </div>

                     <div class="col-md-7 mb-5 mt-5">
                         <div style="border-bottom: 1px solid #f5f5f5" class="row align-items-center">
                             <div class="col-md-8">
                                 <h3>{{ $productModal->name }}</h3>
                                 <div class="rating">
                                     @for ($i = 1; $i <= $productModal->avg_rating; $i++)
                                         <span class="star">★</span>
                                     @endfor
                                     @for ($i = 5; $i > $productModal->avg_rating; $i--)
                                         <span style="color: gray" class="star">★</span>
                                     @endfor
                                     <span>{{ $productModal->reviews->count() }} khách hàng đánh giá</span>
                                     <span class="ms-2"><strong> Đã bán:</strong>
                                         {{ $productModal->total_sold }}</span>
                                 </div>
                             </div>
                             <div class="col-md-4 justify-content-between align-items-center text-end">
                                 <a class="lead"
                                     href="https://www.facebook.com/people/BaHa-Group/61559205100698/"><i
                                         class="fa-brands fa-facebook text-black"></i></a>
                                 <a class="lead me-2 ms-2" href="https://www.tiktok.com/@baha_group_official"><i
                                         class="fa-brands fa-tiktok text-black"></i></a>
                                 <a class="lead"
                                     href="https://www.linkedin.com/company/baha-group-joint-stock-company/?viewAsMember=true"><i
                                         class="fa-brands fa-linkedin text-black"></i></a>
                             </div>
                         </div>
                         @if ($productModal->on_flash_sale)
                             @php
                                 $flash_sale = $productModal->on_flash_sale->details
                                     ->where('product_id', '=', $productModal->id)
                                     ->first();
                             @endphp
                             <div class="row align-items-center mb-3 ms-1 mt-3">
                                 <div class="col-md-8 bg-default h-100 text-center text-white">Kết thúc sau
                                     <strong id="countdown-flashsale-product-modal"></strong>
                                 </div>
                                 <div style="background-color: #f5f5f5;" class="col-md-4 text-center">Đã bán :
                                     {{ $flash_sale->sold ?? 0 }}/{{ $flash_sale->qty }}</div>
                             </div>
                         @endif

                         @if (!isset($productModal->productVariations[0]))
                             <p class="lead">
                                 <del>{{ format_price($productModal->price) }}</del>
                                 <strong
                                     class="text-red">{{ format_price($productModal->promotion_price) }}</strong><br>
                                 @if (isset($productModal->on_flash_sale))
                                     <span class="flashsale-price">FLASH SALE
                                         - {{ format_price($productModal->flashsale_price) }}</span>
                                 @endif
                             </p>
                         @else
                             <p id="productDetailPrice" class="lead">
                                 <del
                                     id="productVariationPrice">{{ format_price($productModal->productVariations[0]->price) }}</del>
                                 <strong id="productVariationPromotionPrice"
                                     class="text-red">{{ format_price($productModal->productVariations[0]->promotion_price) }}</strong><br>
                                 @if (isset($productModal->on_flash_sale))
                                     <span class="flashsale-price">FLASH SALE -
                                         {{ format_price($productModal->productVariations[0]->flashsale_price) }}</span>
                                 @endif
                             </p>
                         @endif

                         <x-input type="hidden" name="hidden_product_id_modal" :value="$productModal->id" />

                         @if (isset($productModal->productVariations[0]))
                             <x-input type="hidden" name="hidden_quantity_modal" />
                             <x-input type="hidden" name="hidden_product_variation_modal_id" />
                             @foreach ($productModal->productAttributes as $item)
                                 <div class="row">
                                     <div class="col-md-12">
                                         <span>{{ $item->attribute->name }}: <strong
                                                 id="attribute_variation_name_modal{{ $item->attribute->id }}">Black</strong></span><br>
                                         <x-input id="hiddenAttributeModal" type="hidden"
                                             name="attribute_variation_modal_ids[{{ $item->attribute->id }}]" />
                                         <div class="row me-3 mt-2">
                                             @foreach ($item->attribute->variations as $attributeVariation)
                                                 @if ($item->attribute->type == App\Enums\Attribute\AttributeType::Color)
                                                     <a style="background-color: {{ $attributeVariation->meta_value['color'] }}"
                                                         data-attribute-name="{{ $attributeVariation->name }}"
                                                         data-attribute-id="{{ $item->attribute->id }}"
                                                         data-attribute-variation-id="{{ $attributeVariation->id }}"
                                                         class="col-2 custom-col btn btn-sm square-btn color-btn-modal mb-2 h-16 w-16"></a>
                                                 @else
                                                     <a data-attribute-name="{{ $attributeVariation->name }}"
                                                         data-attribute-id="{{ $item->attribute->id }}"
                                                         data-attribute-variation-id="{{ $attributeVariation->id }}"
                                                         class="col-2 custom-col btn btn-sm square-btn capacity-btn-modal mb-2 w-5">
                                                         <p class="me-2 ms-2 mt-3">{{ $attributeVariation->name }}
                                                         </p>
                                                     </a>
                                                 @endif
                                             @endforeach
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                             <span>Trạng thái: <span id="instockModal"
                                     class="text-green">{{ $productModal->productVariations[0]->qty == 0 ? 'Hết' : 'còn ' . $productModal->productVariations[0]->qty }}
                                     Hàng</span></span>
                             <div class="row mt-3">
                                 <div class="col-md-3">
                                     <div class="input-group mt-2">
                                         <button disabled id="btnDecrementModal" class="btn btn-default"
                                             type="button" onclick="decrementDetail()">-</button>
                                         <input readonly onblur="isEnoughQuantity(this)"
                                             id="filter-input-detail-modal" class="form-control text-center"
                                             value="1" min="1">
                                         <button disabled id="btnIncrementModal" class="btn btn-default"
                                             type="button" onclick="incrementDetail()">+</button>
                                     </div>
                                 </div>
                                 <div class="col-md-4"><button id="btnAddToCartModal" disabled
                                         class="btn btn-default-primary w-100 mt-2"><strong>Thêm vào giỏ
                                             hàng</strong></button>
                                 </div>
                                 <div class="col-md-3"><button id="btnBuyNowModal" onclick="buyNowModal()"
                                         disabled class="btn btn-default w-100 mt-2"><strong>Mua
                                             ngay</strong></button></div>
                             </div>
                         @else
                             <x-input type="hidden" name="hidden_quantity_modal" :value="$productModal->qty" />
                             <span>Trạng thái: <span
                                     class="text-green">{{ $productModal->qty == 0 ? 'Hết' : 'còn ' . $productModal->qty }}
                                     Hàng</span></span>
                             <div class="row mt-3">
                                 <div class="col-md-3">
                                     <div class="input-group mt-2">
                                         <button class="btn btn-default" type="button"
                                             onclick="decrementDetail()">-</button>
                                         <input onblur="isEnoughQuantity(this)" id="filter-input-detail-modal"
                                             class="form-control text-center" value="1" min="1">
                                         <button class="btn btn-default" type="button"
                                             onclick="incrementDetail()">+</button>
                                     </div>
                                 </div>
                                 <div class="col-md-4"><button id="btnAddToCartModal"
                                         class="btn btn-default-primary w-100 mt-2"><strong>Thêm vào giỏ
                                             hàng</strong></button>
                                 </div>
                                 <div class="col-md-3"><button id="btnBuyNowModal" onclick="buyNowModal()"
                                         class="btn btn-default w-100 mt-2"><strong>Mua
                                             ngay</strong></button></div>
                             </div>
                         @endif

                         <div style="border-top: 1px solid #f5f5f5" class="row mt-5">
                             <p class="mt-2">SKU: {{ $productModal->sku }}</p>
                             <p>Danh mục:
                                 @foreach ($productModal->categories as $item)
                                     <x-link class="text-default" :href="route('user.product.indexUser', ['category_id' => $item->id])">{{ $item->name }}</x-link>
                                     @if (!$loop->last)
                                         ,
                                     @endif
                                 @endforeach
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @else
     <div id="quickViewProductModal" class="modal">
         <div class="modal-dialog modal-dialog-product-preview">
             <div class="modal-content">
                 <div class="modal-header">
                     <a href="#" data-dismiss="modal" class="class pull-right"><span
                             class="glyphicon glyphicon-remove"></span></a>
                     <h5 class="modal-title" id="modal-title">Cell phone Silver</h5>
                     <span class="close">
                         <i class="ti ti-x"></i>
                     </span>
                 </div>
                 <div class="modal-body row">
                     <div class="col-md-5 align-self-center">
                         <div class="position-relative text-center">
                             <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
                                 <img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg"
                                     alt="Product 1">
                                 <img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg"
                                     alt="Product 2">
                                 <img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg"
                                     alt="Product 3">
                                 <img src="https://img.global.news.samsung.com/vn/wp-content/uploads/2019/03/Galaxy-A50-Mat-truoc-3.jpg"
                                     alt="Product 4">
                             </div>
                             <span class="badge badge-danger position-absolute end-0 top-0 m-3"
                                 id="badge-promotion-percent">50%</span>
                             <span class="badge badge-featured position-absolute start-0 top-0 m-3">Nổi bật</span>
                         </div>
                     </div>

                     <!-- Main content -->
                     <div class="col-md-7">
                         <div class="row align-items-center">
                             <div class="col-md-8">
                                 <h5>Phụ kiện điện tử</h5>
                                 <div class="rating fs-12">
                                     <span style="color: gray" class="star">★</span>
                                     <span style="color: gray" class="star">★</span>
                                     <span style="color: gray" class="star">★</span>
                                     <span style="color: gray" class="star">★</span>
                                     <span style="color: gray" class="star">★</span>
                                     <span>0 khách hàng đánh giá</span>
                                     <span class="text-uppercase ms-2">Đã bán: 0</span>
                                 </div>
                             </div>
                             <div class="col-md-4 justify-content-between align-items-center text-end">
                                 <a class="lead"
                                     href="https://www.facebook.com/people/BaHa-Group/61559205100698/"><i
                                         class="fa-brands fa-facebook text-black"></i></a>
                                 <a class="lead me-2 ms-2" href="https://www.tiktok.com/@baha_group_official"><i
                                         class="fa-brands fa-tiktok text-black"></i></a>
                                 <a class="lead"
                                     href="https://www.linkedin.com/company/baha-group-joint-stock-company/?viewAsMember=true"><i
                                         class="fa-brands fa-linkedin text-black"></i></a>
                             </div>
                         </div>

                         <div class="progress mb-1 mt-1">
                             <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                 role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                 <span style="color: #fff"
                                     id="countdown-flashsale-product-modal">216:19:42:02</span>
                             </div>
                         </div>

                         <p class="lead mb-1">
                             <del id="price_modal">3,990,000₫</del>
                             <strong id="promotion_price_modal" class="text-red fw-bold">2,990,000₫</strong>
                         </p>

                         <p class="fs-12 mb-1">Multi port <br> Fast file transfer <br>Portable in design</p>

                         <p class="fs-12 fw-bold mb-0">Màu sắc</p>
                         <div class="row mt-1">
                             <a
                                 class="col-2 bg-red custom-col btn btn-sm square-btn color-btn-modal mb-2 h-16 w-16"></a>
                             <a
                                 class="col-2 bg-yellow custom-col btn btn-sm square-btn color-btn-modal mb-2 h-16 w-16"></a>
                             <a
                                 class="col-2 bg-green custom-col btn btn-sm square-btn color-btn-modal mb-2 h-16 w-16"></a>
                             <a
                                 class="col-2 bg-pink custom-col btn btn-sm square-btn color-btn-modal mb-2 h-16 w-16"></a>
                             <a
                                 class="col-2 custom-col btn btn-sm square-btn color-btn-modal out-of-stock mb-2 h-16 w-16 bg-black"></a>
                             <a
                                 class="col-2 bg-cyan custom-col btn btn-sm square-btn color-btn-modal out-of-stock mb-2 h-16 w-16"></a>
                         </div>

                         <p class="fs-12 fw-bold mb-0">Dung lượng:</p>
                         <div class="row mt-1">
                             <a
                                 class="col-2 custom-col btn btn-sm square-btn capacity-btn-modal out-of-stock mb-2 w-5">
                                 <p class="me-2 ms-2 mt-3">128GB</p>
                             </a>
                             <a class="col-2 custom-col btn btn-sm square-btn capacity-btn-modal mb-2 w-5">
                                 <p class="me-2 ms-2 mt-3">64GB</p>
                             </a>
                             <a class="col-2 custom-col btn btn-sm square-btn capacity-btn-modal mb-2 w-5">
                                 <p class="me-2 ms-2 mt-3">32GB</p>
                             </a>
                         </div>

                         <p class="fs-12 mb-1">
                             <span class="fw-bold">Tạng thái: </span>
                             <span id="quantity_product_modal" class="text-green">còn 96 Hàng</span>
                         </p>

                         <div class="row">
                             <div class="col-md-3">
                                 <div class="input-group mt-2">
                                     <button class="btn btn-default" type="button"
                                         onclick="decrement()">-</button>
                                     <input id="filter-input" class="form-control text-center" value="1"
                                         min="1">
                                     <button class="btn btn-default" type="button"
                                         onclick="increment()">+</button>
                                 </div>
                             </div>
                             <div class="col-md-4"><button class="btn btn-default-primary w-100 mt-2"><strong>Thêm
                                         vào
                                         giỏ</strong></button></div>
                             <div class="col-md-3"><button id="btnBuyNowModal"
                                     class="btn btn-default w-100 mt-2"><strong>Mua
                                         ngay</strong></button></div>
                         </div>
                         <div style="border-top: 1px solid #f5f5f5" class="row mt-3">
                             <p class="fs-12 fs-bold mb-0">SKU: 1558691521024</p>
                             <p class="fs-12 mb-0">Danh mục:
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
 @endif
</div>

@if (!Route::is('user.product.detail'))
 <script src="{{ asset('public/user/assets/js/jquery.js') }}"></script>
 <script src="{{ asset('public/user/assets/fotorama-4.6.4/fotorama.js') }}"></script>
 <script src="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
@endif

<script>
 $(document).ready(function() {
     function updateCountdownModal() {
         const startTime = new Date();
         const endTime = new Date('{{ $productModal->on_flash_sale->end_time ?? 0 }}');

         const diffInMs = endTime - startTime;
         const diffInHours = Math.floor(diffInMs / 3600000);
         const diffInMinutes = Math.floor((diffInMs % 3600000) / 60000);
         const diffInSeconds = Math.floor((diffInMs % 60000) / 1000);
         const diffInMilliseconds = diffInMs % 1000;
         const formattedTime =
             `${diffInHours.toString().padStart(2, '0')} : ${diffInMinutes.toString().padStart(2, '0')} : ${diffInSeconds.toString().padStart(2, '0')}`;
         document.getElementById('countdown-flashsale-product-modal').textContent = formattedTime;
     }
     const endTime = '{{ $productModal->on_flash_sale->end_time ?? 0 }}';
     if (endTime != 0) {
         updateCountdownModal();
         const countdownInterval = setInterval(updateCountdownModal, 1000);
     }

     $('.color-btn-modal, .capacity-btn-modal').click(function() {
         var attributeName = $(this).data('attribute-name');
         var attributeId = $(this).data('attribute-id');
         var attributeVariationId = $(this).data('attribute-variation-id');
         let hiddenAttributeModalValues = [];
         const elements = document.querySelectorAll("#hiddenAttributeModal");

         $('#attribute_variation_name_modal' + attributeId).text(attributeName);

         $('input[name="attribute_variation_modal_ids[' + attributeId + ']"]').val(
             attributeVariationId);

         elements.forEach(element => {
             hiddenAttributeModalValues.push(element.value);
         });
         const hasEmpty = hiddenAttributeModalValues.some(value => value === '');
         if (!hasEmpty) {
             $.ajax({
                 type: "GET",
                 url: '{{ route('user.product.findVariationByAttributeVariationIds') }}',
                 data: {
                     attribute_variation_ids: hiddenAttributeModalValues,
                     product_id: $('input[name="hidden_product_id_modal"]').val()
                 },
                 success: function(response) {
                     $('#productVariationPriceModal').text(response.data.price);
                     $('#productVariationPromotionPriceModal').text(response.data
                         .promotion_price);
                     if (response.data.qty == 0) {
                         $('#instockModal').text(`Hết hàng`);
                     } else {
                         $('#instockModal').text(`còn ${response.data.qty} hàng`);
                         $('input[name="hidden_quantity_modal"]').val(response.data.qty);
                         $('input[name="hidden_product_variation_modal_id"]').val(response
                             .data
                             .id);
                         $('#filter-input-detail-modal').removeAttr('readonly');
                         $('#btnAddToCartModal').removeAttr('disabled');
                         $('#btnBuyNowModal').removeAttr('disabled');
                         $('#btnIncrementModal').removeAttr('disabled');
                         $('#btnDecrementModal').removeAttr('disabled');
                     }
                 },
                 error: function(response) {
                     handleAjaxError(response);
                 }
             })
         }
     });
     $('#btnAddToCartModal').click(function(e) {
         var productId = $('input[name="hidden_product_id_modal"]').val();
         var productVariationId = $('input[name="hidden_product_variation_modal_id"]').val();
         var qty = $('#filter-input-detail-modal').val();

         $.ajax({
             type: "POST",
             url: '{{ route('user.cart.store') }}',
             data: {
                 product_id: productId,
                 product_variation_id: productVariationId,
                 qty: qty,
                 _token: '{{ csrf_token() }}'
             },
             success: function(response) {
                 $('#cart-count-mobile').text(response.data.count);
                 $('#cart-count').text(response.data.count);
                 Swal.fire({
                     icon: 'success',
                     title: 'Thành công',
                     text: 'Thêm sản phẩm vào giỏ hàng thành công!',
                     showConfirmButton: true
                 });
             },
             error: function(response) {
                 Swal.fire({
                     icon: 'warning',
                     title: 'Thất bại',
                     text: 'Thêm sản phẩm vào giỏ hàng thất bại!',
                     showConfirmButton: true
                 });
                 handleAjaxError(response);
             }
         });
     });
 });

 function incrementDetail() {
     var input = document.getElementById('filter-input-detail-modal');
     var hiddenQuantity = parseInt($('input[name="hidden_quantity_modal"]').val());
     if (parseInt(input.value) + 1 > hiddenQuantity) {
         Swal.fire({
             icon: 'warning',
             title: 'Lưu ý',
             text: 'Số lượng vượt quá hàng trong kho!',
             showConfirmButton: true
         });
         input.value = hiddenQuantity;
     } else {
         input.value = parseInt(input.value) + 1;
     }
 }

 function isEnoughQuantity(input) {
     if (!/^\d+$/.test(input.value)) {
         Swal.fire({
             icon: 'warning',
             title: 'Lưu ý',
             text: 'Vui lòng chỉ nhập số!',
             showConfirmButton: true
         });
         input.value = 1;
     }
     if (input.value <= 0) {
         Swal.fire({
             icon: 'warning',
             title: 'Lưu ý',
             text: 'Số lượng phải lớn hơn 0!',
             showConfirmButton: true
         });
         input.value = 1;
     }
     var hiddenQuantity = parseInt($('input[name="hidden_quantity_modal"]').val());
     if (input.value > hiddenQuantity) {
         Swal.fire({
             icon: 'warning',
             title: 'Lưu ý',
             text: `Số lượng vượt quá hàng trong kho, còn lại ${hiddenQuantity} sản phẩm!`,
             showConfirmButton: true
         });
         input.value = 1;
     }
 }

 function decrementDetail() {
     var input = document.getElementById('filter-input-detail-modal');
     if (input.value > 1) {
         input.value = parseInt(input.value) - 1;
     }
 }
</script>
