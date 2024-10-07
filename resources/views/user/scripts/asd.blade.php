<script>
				$('#search-input').keyup(function() {
								let key = $(this).val();
								if (key.length >= 3) {
												$.ajax({
																type: "GET",
																url: "{{ route('user.product.search') }}",
																data: {
																				key
																},
																success: function(response) {
																				if (response.data.length == 0) {
																								$('#menu-1').html('');
																								$('#menu-1').append(`
                   <li>
                       <a class="dropdown-item p-0" href="#">
                           <div class="card border-0">
                               <div class="row g-0">
                                   <div class="col-md-12">
                                       <div class="card-body">
                                           <div class="row">
                                               <div class="col-12 text-truncate text-center">
                                                   Không tìm thấy sản phẩm
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </a>
                   </li>
               `);
																								return;
																				}

																				$('#menu-1').html('');
																				$('#menu-1').append(``);
																				$.each(response.data, function(index, value) {
																								let minPromotionPrice = null;
																								let maxPromotionPrice = null;

																								if (value.product_variations && value.product_variations.length >
																												0) {
																												let prices = value.product_variations
																																.map(variation => variation.promotion_price)
																																.filter(price => price !== null);

																												if (prices.length > 0) {
																																minPromotionPrice = Math.min(...prices);
																																maxPromotionPrice = Math.max(...prices);
																												}
																								}

																								$('#menu-1').append(`
                   <li>
                       <a class="dropdown-item p-0" href="/2906-BahaGroup/products/detail/${value.id}">
                           <div class="card border-0">
                               <div class="row g-0">
                                   <div class="col-md-2">
                                       <img src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg"
                                           class="img-fluid rounded-start" alt="...">
                                   </div>
                                   <div class="col-md-10">
                                       <div class="card-body">
                                           <div class="row">
                                               <div class="col-6 text-truncate text-start">
                                                   <span class="card-text">
                                                       ${value.name ? value.name : ''}
                                                   </span>
                                                   <p class="card-text">
                                                       SKU: ${value.sku ? value.sku : ''}
                                                   </p>
                                               </div>
                                               <div class="col-6 text-truncate text-end">
                                                   ${value.price != null && value.promotion_price != null
                                                   ? `<span class="card-text">
                                                       <del class="text-muted">${number_format(value.price)}₫</del>
                                                       ${value.promotion_price ? number_format(value.promotion_price).toString() + '₫' : ''}
                                                       </span>`
                                                   : ''}
                                                   ${minPromotionPrice !== null && maxPromotionPrice !== null
                                                       ? `<span class="card-text text-red">${number_format(minPromotionPrice)}₫ - ${number_format(maxPromotionPrice)}₫</span>`
                                                       : ''}
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </a>
                   </li>
               `);
																				});
																},
																error: function(response) {
																				$('#menu-1').html('');
																				$('#menu-1').append(`
               <li>
                   <p class="dropdown-item">
                       Đã có lỗi xảy ra...
                   </p>
               </li>
           `);
																				handleAjaxError(response);
																}
												});
								} else {
												$('#menu-1').html('');
												$('#menu-1').append(`
       <li>
           <p class="dropdown-item">
               Phải nhập ít nhất 3 ký tự
           </p>
       </li>
   `);
								}
				});
</script>
