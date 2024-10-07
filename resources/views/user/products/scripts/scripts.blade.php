<script>
				$(document).ready(function() {
								function updateCountdown() {
												const startTime = new Date();
												const endTime = new Date('{{ $products[0]->product->on_flash_sale->end_time ?? 0 }}');

												const diffInMs = endTime - startTime;
												const diffInHours = Math.floor(diffInMs / 3600000);
												const diffInMinutes = Math.floor((diffInMs % 3600000) / 60000);
												const diffInSeconds = Math.floor((diffInMs % 60000) / 1000);
												const diffInMilliseconds = diffInMs % 1000;
												const formattedTime =
																`${diffInHours.toString().padStart(2, '0')} : ${diffInMinutes.toString().padStart(2, '0')} : ${diffInSeconds.toString().padStart(2, '0')}`;
                console.log(formattedTime);
												document.getElementById('countdown-flashsale-product').textContent = formattedTime;
												document.getElementById('countdown-flashsale-product-modal').textContent = formattedTime;
								}
								const endTime = '{{ $products[0]->product->on_flash_sale->end_time ?? 0 }}';
								if (endTime != 0) {
												updateCountdown();
												const countdownInterval = setInterval(updateCountdown, 1000);
								}

								$('.color-btn, .capacity-btn').click(function() {
												var attributeName = $(this).data('attribute-name');
												var attributeId = $(this).data('attribute-id');
												var attributeVariationId = $(this).data('attribute-variation-id');
												let hiddenAttributeValues = [];
												const elements = document.querySelectorAll("#hiddenAttribute");

												$('#attribute_variation_name' + attributeId).text(attributeName);

												$('input[name="attribute_variation_ids[' + attributeId + ']"]').val(attributeVariationId);

												elements.forEach(element => {
																hiddenAttributeValues.push(element.value);
												});
												const hasEmpty = hiddenAttributeValues.some(value => value === '');
												if (!hasEmpty) {

																$.ajax({
																				type: "GET",
																				url: '{{ route("user.product.findVariationByAttributeVariationIds") }}',
																				data: {
																								attribute_variation_ids: hiddenAttributeValues,
																								product_id: $('input[name="hidden_product_id"]').val()
																				},
																				success: function(response) {
																								$('#productVariationPrice').text(response.data.price);
																								$('#productVariationPromotionPrice').text(response.data
																												.promotion_price);
																								if (response.data.qty == 0) {
																												$('#instock').text(`Hết hàng`);
																								} else {
																												$('#instock').text(`còn ${response.data.qty} hàng`);
																												$('input[name="hidden_quantity"]').val(response.data.qty);
																												$('input[name="hidden_product_variation_id"]').val(response.data
																																.id);

																												$('#filter-input-detail').removeAttr('readonly');
																												$('#btnAddToCart').removeAttr('disabled');
																												$('#btnBuyNow').removeAttr('disabled');
																												$('#btnIncrement').removeAttr('disabled');
																												$('#btnDecrement').removeAttr('disabled');
																								}
																				},
																				error: function(response) {
																								handleAjaxError(response);
																				}
																})
												}
								});
								$('#btnAddToCart').click(function(e) {
												var productId = $('input[name="hidden_product_id"]').val();
												var productVariationId = $('input[name="hidden_product_variation_id"]').val();
												var qty = $('#filter-input-detail').val();
												console.log(productId, productVariationId, qty);

												$.ajax({
																type: "POST",
																url: '{{ route("user.cart.store") }}',
																data: {
																				product_id: productId,
																				product_variation_id: productVariationId,
																				qty: qty,
																				_token: '{{ csrf_token() }}'
																},
																success: function(response) {
																				$('#cart-count-mobile').text(response.data.count);
																				$('#cart-count').text(response.data.count);
																},
																error: function(response) {
																				handleAjaxError(response);
																}
												});
								});
				});

				function incrementDetail() {
								var input = document.getElementById('filter-input-detail');
								var hiddenQuantity = parseInt($('input[name="hidden_quantity"]').val());
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
								var hiddenQuantity = parseInt($('input[name="hidden_quantity"]').val());
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
								var input = document.getElementById('filter-input-detail');
								if (input.value > 1) {
												input.value = parseInt(input.value) - 1;
								}
				}

				function showDetailProductModal(modal, product_id) {
					openModal(modal);
					console.log('product_id: ' + product_id);
					$.ajax({
						type: "GET",
						url: '{{ route("user.product.detailModal", ":id") }}'.replace(':id', product_id),
						data: {
						},
						success: function(res) {
							console.log(res);
							$('#quickViewProductModal1 #modal-title').text('Xem nhanh: ' + res.product.name);
							$('#quickViewProductModal1 #badge-promotion-percent').text(Math.round(100 - res.product.promotion_price / res.product.price * 100) + '%')
							$('#quickViewProductModal1 #product_name_modal').text(res.product.name);
							$('#quickViewProductModal1 #price_modal').text((res.product.price).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
							$('#quickViewProductModal1 #promotion_price_modal').text((res.product.promotion_price).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
							$('#quickViewProductModal1 #quantity_product_modal').text(res.product.qty == 0 ? 'Hết Hàng' : `Còn ${res.product.qty} Hàng`);
							if (res.avgReviewRate != 0) {
								$('#quickViewProductModal1 .rating').html('');
								for (i = 0; i < parseInt(res.avgReviewRate); i++) {
									$('#quickViewProductModal1 .rating').append(`<span class="star">★</span>`);
								}
								for (i = 5; i > parseInt(res.avgReviewRate); i--) {
									$('#quickViewProductModal1 .rating').append(`<span style="color: gray" class="star">★</span>`);
								}
								$('#quickViewProductModal1 .rating').append(`<span> ${res.sumCustomerReview} khách hàng đánh giá</span>
										<span class="ms-2 text-uppercase">Đã bán: 4</span>`)
							}
							else {
								$('#quickViewProductModal1 .rating').html('');
								$('#quickViewProductModal1 .rating').append(`
									<span style="color: gray" class="star">★</span>
                                    <span style="color: gray" class="star">★</span>
                                    <span style="color: gray" class="star">★</span>
                                    <span style="color: gray" class="star">★</span>
                                    <span style="color: gray" class="star">★</span>
                                    <span>0 khách hàng đánh giá</span>
                                    <span class="ms-2 text-uppercase">Đã bán: 0</span>
								`);
							}
						},
						error: function(res) {
							console.log(res.error);
						},
					});
				}

				let currentPage = {{ $paginator->currentPage }}
				let totalPages = {{ $paginator->totalPages }}
				const paginationBtns = document.querySelectorAll('.pagination-btn');

				paginationBtns.forEach( (btn) => {
					btn.addEventListener( 'click', function () {

						if (this.classList.contains('prev')) {
							if (currentPage > 1) {
								currentPage--;
							}
						} else if (this.classList.contains('next')) {
							currentPage++; 
						} else {
							currentPage = parseInt(this.dataset.page); 
						}
						updatePrevBtn();
						updateNextBtn();
						let url = '{{ route("user.product.saleLimited") }}?page=' + currentPage;
						window.location.href = url;
					})
				});

				function updatePrevBtn() {
					if (document.querySelector('.pagination-btn.prev')){
						if (currentPage == 1) {
							document.querySelector('.pagination-btn.prev').disabled = true;
						}
						else {
							document.querySelector('.pagination-btn.prev').disabled = false;
						}
					}
				}
				updatePrevBtn()
				function updateNextBtn() {
					if (document.querySelector('.pagination-btn.next')) {
						if (currentPage == totalPages) {
							document.querySelector('.pagination-btn.next').disabled = true;
						}
						else {
							document.querySelector('.pagination-btn.next').disabled = false;
						}
					}
				}
				updateNextBtn()
</script>
