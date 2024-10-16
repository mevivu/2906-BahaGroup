<script>
	$(document).ready(function () {
		function updateCountdown() {
			const startTime = new Date();
			const endTime = new Date('{{ $product->on_flash_sale->end_time ?? 0 }}');
			const diffInMs = endTime - startTime;
			const diffInHours = Math.floor(diffInMs / 3600000);
			const diffInMinutes = Math.floor((diffInMs % 3600000) / 60000);
			const diffInSeconds = Math.floor((diffInMs % 60000) / 1000);
			const diffInMilliseconds = diffInMs % 1000;
			const formattedTime =
				`${diffInHours.toString().padStart(2, '0')} : ${diffInMinutes.toString().padStart(2, '0')} : ${diffInSeconds.toString().padStart(2, '0')}`;
			console.log(formattedTime);
			document.getElementById('countdown-flashsale-product').textContent = formattedTime;
		}
		const endTime = '{{ $product->on_flash_sale->end_time ?? 0 }}';
		if (endTime != 0) {
			updateCountdown();
			const countdownInterval = setInterval(updateCountdown, 1000);
		}

		$('.color-btn, .capacity-btn').click(function () {
			var attributeName = $(this).data('attribute-name');
			var attributeSlug = $(this).data('attribute-slug');
			var attributeVariationSlug = $(this).data('attribute-variation-slug');
			let hiddenAttributeValues = [];
			const elements = document.querySelectorAll("#hiddenAttribute");
			const productSlug = $('#slug').val();

			$('#attribute_variation_name' + attributeSlug).text(attributeName);

			$('input[name="attribute_variation_slugs[' + attributeSlug + ']"]').val(attributeVariationSlug);

			elements.forEach(element => {
				hiddenAttributeValues.push(element.value);
			});
			const hasEmpty = hiddenAttributeValues.some(value => value === '');
			if (!hasEmpty) {
				$.ajax({
					type: "GET",
					url: '{{ route('user.product.findVariation', ['slug' => 'productSlug']) }}'.replace('productSlug', productSlug),
					data: {
						attribute_variation_slugs: hiddenAttributeValues,
						product_id: $('input[name="hidden_product_id"]').val()
					},
					success: function (response) {
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
					error: function (response) {
						Swal.fire({
							icon: 'warning',
							title: 'Lưu ý',
							text: `${response.responseJSON.message}`,
							showConfirmButton: true
						});
					}
				})
			}
		});
		$('#btnAddToCart').click(function (e) {
			var productId = $('input[name="hidden_product_id"]').val();
			var productVariationId = $('input[name="hidden_product_variation_id"]').val();
			var qty = $('#filter-input-detail').val();
			console.log(productId, productVariationId, qty);
			$.ajax({
				type: "POST",
				url: '{{ route('user.cart.store') }}',
				data: {
					product_id: productId,
					product_variation_id: productVariationId,
					qty: qty,
					_token: '{{ csrf_token() }}'
				},
				success: function (response) {
					$('#cart-count-mobile').text(response.data.count);
					$('#cart-count').text(response.data.count);
					Swal.fire({
						icon: 'success',
						title: 'Thành công',
						text: 'Thêm sản phẩm vào giỏ hàng thành công!',
						showConfirmButton: true
					});
				},
				error: function (response) {
					Swal.fire({
						icon: 'warning',
						title: 'Lưu ý',
						text: `${response.responseJSON.message}`,
						showConfirmButton: true
					});
				}
			});
		});
		$('#btnBuyNow').click(function (e) {
			var productId = $('input[name="hidden_product_id"]').val();
			var productVariationId = $('input[name="hidden_product_variation_id"]').val();
			var qty = $('#filter-input-detail').val();
			$.ajax({
				type: "POST",
				url: '{{ route('user.cart.buyNow') }}',
				data: {
					product_id: productId,
					product_variation_id: productVariationId,
					qty: qty,
					_token: '{{ csrf_token() }}'
				},
				success: function (response) {
					// window.location.href = '{{ route('user.cart.checkout') }}';
					if (response.status) {
						// Redirect to the checkout page with the cart ID or order ID
						window.location.href =
							'{{ route('user.cart.checkout') }}?cart_id=' + response.data.id;
					} else {
						Swal.fire({
							icon: 'warning',
							title: 'Lưu ý',
							text: 'Không thể xử lý đơn hàng của bạn!',
							showConfirmButton: true
						});
					}
				},
				error: function (response) {
					Swal.fire({
						icon: 'warning',
						title: 'Lưu ý',
						text: `${response.responseJSON.message}`,
						showConfirmButton: true
					});
				}
			});
		})
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

	function updatePrice() {
		var minPrice = document.getElementById('min-price').value;
		var maxPrice = document.getElementById('max-price').value;
		document.getElementById('min-price-value').textContent = minPrice + '₫';
		document.getElementById('max-price-value').textContent = maxPrice + '₫';
	}

	const sort = document.getElementById('sort');
	sort.addEventListener('change', function () {
		const currentUrl = window.location.href;
		const urlWithoutSort = currentUrl.replace(/(\?|&)sort=[^&]+/g, '');
		if (this.value === 'default') {
			window.location = `${urlWithoutSort}`;
		} else if (this.value === 'price-asc') {
			if (urlWithoutSort == '{{ route('user.product.indexUser') }}') {
				window.location = `${urlWithoutSort}?sort=asc`;
			} else {
				window.location = `${urlWithoutSort}&sort=asc`;
			}
		} else if (this.value === 'price-desc') {
			if (urlWithoutSort == '{{ route('user.product.indexUser') }}') {
				window.location = `${urlWithoutSort}?sort=desc`;
			} else {
				window.location = `${urlWithoutSort}&sort=desc`;
			}
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

	function showDetailProductModal(modal, product_id) {
		if (product_id) {
			$.ajax({
				type: "GET",
				url: '{{ route('user.product.render') }}' + `/${product_id}`,
				success: function (response) {
					$("#resultQuickViewRequest").html(response);
					openModal(modal);
				},
				error: function (response) {
					Swal.fire({
						icon: 'warning',
						title: 'Lưu ý',
						text: `${response.responseJSON.message}`,
						showConfirmButton: true
					});
				}
			});
		}
	}
</script>