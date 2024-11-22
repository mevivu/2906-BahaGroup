<script>
				let requestDone = true;

				function addChip(slug, name, type) {
								let chipID = type + '-' + slug;
								$('#filter-chips-container').append(`
<div class="col col-sm col-md col-lg my-1" id="${chipID}">
       <button button class="btn btn-sm bg-default text-white rounded-pill text-truncate chip" type="button" >
            <span>${name}</span> <i class="ti ti-x remove-chip" data-type="${type}" data-slug="${slug}"></i>
                </button>
    </div>
`);
				}

				function removeChip(slug, type) {
								let chipID = type + '-' + slug;
								$('#' + chipID).remove();
				}

				function arraysEqual(arr1, arr2) {
								if (arr1.length !== arr2.length) return false;
								return arr1.every((value, index) => value === arr2[index]);
				}

				function handleAddToCartAnimation(productImageUrl) {
								Swal.fire({
												html: `
            <p>Thêm sản phẩm vào giỏ hàng thành công!</p>
            <div id="cartAnimation" class="custom-cart-success">
                <div class="product-image-animation"
                    style="background-image: url('${productImageUrl}')">
                </div>
                <div class="cart-image cart-animation"
                    style="background-image: url('{{ asset('user/assets/images/cart.png') }}')">
                </div>
            </div>
        `,
												icon: 'success',
												title: 'Thành công',
												showConfirmButton: true,
												confirmButtonColor: "#1c5639",
												didOpen: () => {
																setTimeout(() => {
																								const cartAnimation = document.getElementById('cartAnimation');
																								if (cartAnimation) {
																												cartAnimation.classList.add('hide');
																								}
																				},
																				2000
																);
												}
								});
				}

				function addToCart(id, productImageUrl) {
								if (requestDone) {
												requestDone = false;
												$.ajax({
																type: "POST",
																url: '{{ route('user.cart.store') }}',
																data: {
																				product_id: id,
																				qty: 1,
																				_token: '{{ csrf_token() }}'
																},
																success: function(response) {
																				$('#cart-count-mobile').text(response.data.count);
																				$('#cart-count').text(response.data.count);
																				handleAddToCartAnimation(productImageUrl);
																},
																error: function(response) {
																				Swal.fire({
																								icon: 'error',
																								title: 'Lưu ý',
																								text: `${response.responseJSON.message}`,
																								showConfirmButton: true,
																								confirmButtonColor: "#1c5639",
																				});
																},
																complete: function() {
																				loadCartItems();
																				requestDone = true;
																}
												});
								}
				}

				function debounce(func, wait) {
								let timeout;
								return function executedFunction(...args) {
												const later = () => {
																clearTimeout(timeout);
																func(...args);
												};
												clearTimeout(timeout);
												timeout = setTimeout(later, wait);
								};
				}

				$(document).ready(function() {
								const searchInput = $('#search-input');
								const searchButton = $('#search-button');
								const menu = $('#menu-1');

								$('body').append(
												'<div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.8); z-index:9999;"><div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div></div>'
								);

								function showLoading() {
												$('#loading-overlay').fadeIn(300);
												searchButton.prop('disabled', true).addClass('disabled');
								}

								function hideLoading() {
												$('#loading-overlay').fadeOut(300);
												searchButton.prop('disabled', false).removeClass('disabled');
								}

								const debouncedSearch = debounce(function() {
												const key = searchInput.val();
												if (key.length >= 3) {
																showLoading();
																$.ajax({
																				type: "GET",
																				url: "{{ route('user.product.search') }}",
																				data: {
																								key
																				},
																				success: function(response) {
																								menu.html('');
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
																												$('#menu-1').append(`
                         <li>
                             <a class="dropdown-item p-2 text-center" href="{{ route('user.product.indexUser') }}">
                                 <strong>Xem tất cả sản phẩm tại đây</strong>
                             </a>
                         </li>
                     `);
																												hideLoading();
																												return;
																								}

																								$('#menu-1').html('');
																								$('#menu-1').append(``);
																								$.each(response.data, function(index, value) {
																												let minPromotionPrice = null;
																												let maxPromotionPrice = null;

																												if (value.product_variations && value.product_variations
																																.length >
																																0) {
																																let prices = value.product_variations
																																				.map(variation => variation.promotion_price)
																																				.filter(price => price !== null);

																																if (prices.length > 0) {
																																				minPromotionPrice = Math.min(...prices);
																																				maxPromotionPrice = Math.max(...prices);
																																}
																												}
																												let url = "{{ route('user.product.detail') }}" +
																																'/' +
																																value.slug;
																												let urlAvatar = '{{ asset('') }}' + value.avatar
																												$('#menu-1').append(`
                <li>
                    <a class="dropdown-item p-0" href="${url}">
                        <div class="card border-0">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="${urlAvatar}"
                                        class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 text-truncate text-start">
                                                <span class="card-text">
                                                    ${value.name}
                                                </span>
                                                <p class="card-text">
                                                    SKU: ${value.sku}
                                                </p>
                                            </div>
                                            <div class="col-6 text-truncate text-end">
                                                ${value.price != null && value.promotion_price != null
                                                    ? `<span class="card-text text-red">
                                                    <del class="text-muted text-black">${formatPrice(value.price)}</del>
                                                    ${formatPrice(value.promotion_price)}
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
																								menu.append(`
                         <li>
                             <a class="dropdown-item p-2 text-center" href="{{ route('user.product.indexUser') }}">
                                 <strong>Xem tất cả sản phẩm tại đây</strong>
                             </a>
                         </li>
                     `);
																								hideLoading();
																				},
																				error: function(response) {
																								menu.html('');
																								menu.append(`
                     <li>
                         <p class="dropdown-item">
                             Đã có lỗi xảy ra...
                         </p>
                     </li>
                     <li>
                             <a class="dropdown-item p-2 text-center" href="{{ route('user.product.indexUser') }}">
                                 <strong>Xem tất cả sản phẩm tại đây</strong>
                             </a>
                         </li>
                 `);
																								hideLoading();
																				}
																});
												} else {
																menu.html('');
																menu.append(`
             <li>
                 <p class="dropdown-item">
                     Phải nhập ít nhất 3 ký tự
                 </p>
             </li>
             <li>
                             <a class="dropdown-item p-2 text-center" href="{{ route('user.product.indexUser') }}">
                                 <strong>Xem tất cả sản phẩm tại đây</strong>
                             </a>
                         </li>
         `);
												}
								}, 500);

								searchInput.on('input', debouncedSearch);

								searchButton.on('click', function(e) {
												e.preventDefault();
												debouncedSearch();
								});
				});
</script>
