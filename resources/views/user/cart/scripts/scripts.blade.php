<script>
				function updateProgress(total, object) {
								let percentage = (total / object) * 100;
								percentage = percentage >= 100 ? 100 : Math.round(percentage);

								const progressBar = document.getElementById('progressBar');
								const progressText = document.getElementById('progressText');

								progressBar.style.width = `${percentage}%`;

								progressText.textContent = `${percentage}%`;
								progressText.style.color = percentage >= 50 ? '#ffffff' : '#000000';
				}

				function updateText(response) {
								$('#cart-count-mobile').text(response.data.count);
								$('#cart-count').text(response.data.count);
								$('#total-spend').text((response.data.total - response.data.discount_value).toLocaleString('vi-VN').replace(
																'.', ',') +
												'đ');
								$('#totalOrder').text(response.data.total.toLocaleString('vi-VN').replace('.', ',') + 'đ');
								$('#discountValue').text(response.data.discount_value.toLocaleString('vi-VN').replace('.', ',') + 'đ');
								$('#totalAfterDiscount').text((response.data.total - response.data.discount_value).toLocaleString('vi-VN').replace(
																'.', ',') +
												'đ');
								updateProgress(response.data.total, {{ $object }})
				}


				function updateProductTotal(id) {
								const quantityInput = document.getElementById('quantity-input' + id);
								const quantity = parseInt(quantityInput.value);
								const priceElement = quantityInput.closest('tr').querySelector('[data-label="Giá"]');
								const totalElement = quantityInput.closest('tr').querySelector('[data-label="Tổng"]');

								if (priceElement && totalElement) {
												const price = parseFloat(priceElement.textContent.replace(/[^0-9.-]+/g,
																""));
												const newTotal = price * quantity;
												const formattedPrice = newTotal.toLocaleString('vi-VN').replace('.', ',') + 'đ'
												totalElement.textContent = formattedPrice;
								}
				}

				function applyDiscountCode() {
								var discount_code = $(`#discount_code`).val();
								$.ajax({
												type: "POST",
												url: '{{ route('user.cart.applyCode') }}',
												data: {
																code: discount_code,
																_token: '{{ csrf_token() }}'
												},
												success: function(response) {
																updateText(response);
												},
												error: function(response) {
																Swal.fire({
																				icon: 'warning',
																				title: 'Lưu ý',
																				text: `${response.responseJSON.message}`,
																				showConfirmButton: true
																});
																$('#discountValue').text('0đ');
												}
								});
				}


				function incrementCart(button) {
								var id = $(button).data('id');
								var input = $(`#quantity-input` + id);
								var hiddenValue = $(`input[name="hidden_product_qty${id}"]`);
								var code = $(`#discount_code`).val();

								if (input.val() == hiddenValue.val()) {
												Swal.fire({
																icon: 'warning',
																title: 'Lưu ý',
																text: 'Số lượng vượt quá hàng trong kho!',
																showConfirmButton: true
												});
												input.val(parseInt(hiddenValue.val()));
								} else {
												input.val(parseInt(input.val()) + 1);
												$.ajax({
																type: "POST",
																url: '{{ route('user.cart.increament') }}',
																data: {
																				id: id,
																				code: code,
																				_token: '{{ csrf_token() }}'
																},
																success: function(response) {
																				updateText(response);
																},
																error: function(response) {
																				Swal.fire({
																								icon: 'warning',
																								title: 'Lưu ý',
																								text: `${response.responseJSON.message}`,
																								showConfirmButton: true
																				});
																				$('#discountValue').text('0đ');
																}
												});
												updateProductTotal(id);
								}
				}

				function decrementCart(button) {
								var id = $(button).data('id');
								var input = $(`#quantity-input` + id);
								var currentValue = parseInt(input.val());
								var code = $(`#discount_code`).val();
								if (currentValue == 1) {
												const row = button.closest('tr');
												if (row) {
																row.remove();
												}
								}
								input.val(currentValue - 1);
								$.ajax({
												type: "POST",
												url: '{{ route('user.cart.decreament') }}',
												data: {
																id: id,
																code: code,
																_token: '{{ csrf_token() }}'
												},
												success: function(response) {
																updateText(response);
												},
												error: function(response) {
																Swal.fire({
																				icon: 'warning',
																				title: 'Lưu ý',
																				text: `${response.responseJSON.message}`,
																				showConfirmButton: true
																});
																updateText(response.responseJSON);
												}
								});
								updateProductTotal(id);
				}

				function removeCart(button) {
								var id = $(button).data('id');
								const row = button.closest('tr');
								if (row) {
												Swal.fire({
																title: "Bạn có chắc chắn muốn thực hiện?",
																icon: "info",
																showCancelButton: true,
																confirmButtonColor: "#7FC84E",
																cancelButtonColor: "#FA4F26",
																confirmButtonText: "Chắc chắn!",
																cancelButtonText: "Quay lại!"
												}).then((result) => {
																if (result.isConfirmed) {
																				row.remove();
																				$.ajax({
																								type: "DELETE",
																								url: '{{ route('user.cart.remove') }}' + `/${id}`,
																								data: {
																												_token: '{{ csrf_token() }}'
																								},
																								success: function(response) {
																												updateText(response);
																												$('#discount_code').val('');
																								},
																								error: function(response) {
																												Swal.fire({
																																icon: 'warning',
																																title: 'Lưu ý',
																																text: `${response.responseJSON.message}`,
																																showConfirmButton: true
																												});
																												updateText(response.responseJSON);
																								}
																				});
																				updateProductTotal(id);
																}
												});
								}
				}


				function handleCheckOut() {
								var discount_value = $(`#discountValue`).text();
								var code = $(`#discount_code`).val();
								if (code && discount_value != '0đ') {
												window.location.href = '{{ route('user.cart.checkout') }}' + '?code=' + code;
								} else {
												window.location.href = '{{ route('user.cart.checkout') }}';
								}
				}

				function isEnoughQuantityCart(input) {
								var id = $(input).data('id');
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
								var hiddenQuantity = parseInt($(`input[name="hidden_product_qty${id}"]`).val());
								if (input.value > hiddenQuantity) {
												Swal.fire({
																icon: 'warning',
																title: 'Lưu ý',
																text: `Số lượng vượt quá hàng trong kho, còn lại ${hiddenQuantity} sản phẩm!`,
																showConfirmButton: true
												});
												input.value = 1;
								}
								var qty = parseInt($(input).val());
								var discount_code = $(`#discount_code`).val();
								$.ajax({
												type: "PUT",
												url: '{{ route('user.cart.update') }}',
												data: {
																id: id,
																qty: qty,
																code: discount_code,
																_token: '{{ csrf_token() }}',
												},
												success: function(response) {
																updateText(response);
												},
												error: function(response) {
																Swal.fire({
																				icon: 'warning',
																				title: 'Lưu ý',
																				text: `${response.responseJSON.message}`,
																				showConfirmButton: true
																});
																$('#discountValue').text('0đ');
												}
								});
								updateProductTotal(id);
				}
</script>
