<x-form id="formCreateVariation" class="d-none" action="#" />
<x-input type="hidden" name="route_render_info_shipping" :value="route('admin.order.render_info_shipping')" />
<x-input type="hidden" name="route_search_render_product_and_variation" :value="route('admin.search.render_product_and_variation')" />
<x-input type="hidden" name="route_calculate_total_before_save_order" :value="route('admin.order.calculate_total_before_save_order')" />
<x-input type="hidden" name="route_delete_item_order_detail" :value="route('admin.order_detail.delete')" />

<x-input type="hidden" name="route_add_product" :value="route('admin.order.add_product')" />
<script>
				let provinceId;
				let districtId;
				$(document).on('click', '#confirm-order', function(e) {
								e.preventDefault();
								var url = $(this).attr('href');

								Swal.fire({
												title: "Bạn có chắc chắn muốn duyệt đơn này?",
												icon: "info",
												showCancelButton: true,
												confirmButtonColor: "#1c5639",
												cancelButtonColor: "#d33",
												confirmButtonText: "Chắc chắn!",
												cancelButtonText: "Quay lại!"
								}).then((result) => {
												if (result.isConfirmed) {
																window.location.href = url;
												}
								});
				});

				$(document).on('click', '#cancel-order', function(e) {
								e.preventDefault();
								var url = $(this).attr('href');

								Swal.fire({
												title: "Bạn có chắc chắn muốn từ chối đơn này?",
												icon: "info",
												showCancelButton: true,
												confirmButtonColor: "#1c5639",
												cancelButtonColor: "#d33",
												confirmButtonText: "Chắc chắn!",
												cancelButtonText: "Quay lại!"
								}).then((result) => {
												if (result.isConfirmed) {
																window.location.href = url;
												}
								});
				});


				function searchProduct(keyword, elmRender) {
								$.ajax({
												type: "GET",
												url: $('input[name="route_search_render_product_and_variation"]').val(),
												data: {
																key: keyword
												},
												success: function(response) {
																$(elmRender).html(response);
												},
												error: function(response) {
																handleAjaxError(response);
												}
								})
				}

				function addProduct(payload) {
								var url = $('input[name="route_add_product"]').val(),
												user_id = $('select[name="order[user_id]"]').val();
								if (!user_id) {
												Swal.fire({
																icon: 'warning',
																title: 'Cảnh báo',
																text: 'Vui lòng chọn khách hàng trước khi thêm sản phẩm!',
												});
												closeModal('#modalAddProduct');
												return;
								}
								closeModal('#modalAddProduct');
								$.ajax({
												type: "GET",
												url: url,
												data: payload,
												success: function(response) {
																$('#tableProduct tbody').prepend(response.data);
																$('#tableProduct tbody tr.no-product').hide();
																reloadTotalOrder();
												},
												error: function(response) {
																handleAjaxError(response);
												}
								})
				}

				function closeModal(modal) {
								$(modal).find('.btn-close').trigger('click');
				}

				function checkAddProduct(productId, productVariationId = null) {
								var elm = '#tableProduct tbody tr.item-product' + '.product-' + productId;
								if (productVariationId) {
												elm += '.product-variation-' + productVariationId;
								}
								if ($(elm).length > 0) {
												return true;
								}
								return false;
				}

				function reloadTotalOrder() {
								var url = $('input[name="route_calculate_total_before_save_order"]').val();
								$.ajax({
												type: "GET",
												url: url,
												data: $('#formOrder').serialize(),
												success: function(response) {
																$("#tableTotalOrder").replaceWith(response.data);
												},
												error: function(response) {
																handleAjaxError(response);
												}
								})
				}

				function deleteItemOrderDetail(id, elm) {
								var url = $('input[name="route_delete_item_order_detail"]').val();
								$.ajax({
												type: "DELETE",
												url: url + '/' + id,
												data: {
																_token: token
												},
												success: function(response) {
																removeElmItemOrderDetail(elm);
												},
												error: function(response) {
																handleAjaxError(response);
												}
								})
				}

				function removeElmItemOrderDetail(elm) {
								$(elm).parents('.item-product').remove();
								if ($('#tableProduct tbody tr.item-product').length == 0) {
												$('#tableProduct tbody tr.no-product').show();
								}
				}
				$(document).on('click', '.remove-item-product', function(e) {
								var id = $(this).data('id'),
												that = this;
								Swal.fire({
												title: "Bạn có chắc chắn muốn thực hiện?",
												icon: "info",
												showCancelButton: true,
												confirmButtonColor: "#1c5639",
												cancelButtonColor: "#d33",
												confirmButtonText: "Chắc chắn!",
												cancelButtonText: "Quay lại!"
								}).then((result) => {
												if (result.isConfirmed) {
																if (id) {
																				deleteItemOrderDetail(id, that);
																} else {
																				removeElmItemOrderDetail(that)
																}
																reloadTotalOrder();
												}
								});
				})
				$(document).ready(function(e) {
								select2LoadData($('#user_id').data('url'), '#user_id');
								select2LoadData($('#province_id').data('url'), '#province_id');
								select2LoadData($('#discount_id').data('url'), '#discount_id');
								searchProduct('', '#showSearchResultProduct');

								let provinceId;
								let districtId;

								provinceId = $('#province_id').val();
								districtId = $('#district_id').val();

								let urlDistrict = "{{ route('admin.search.select.district') }}";
								let urlWard = "{{ route('admin.search.select.ward') }}";
								select2LoadData(urlDistrict + '?province_id=' + provinceId, '#district_id');
								select2LoadData(urlWard + '?district_id=' + districtId, '#ward_id');

								const userId = document.getElementById('orderUserId').value;
								var url = $('input[name="route_render_info_shipping"]').val();
								if (userId) {
												$.ajax({
																type: "GET",
																url: url,
																data: {
																				user_id: userId
																},
																success: function(response) {
																				$("#infoShipping").html(response);
																},
																error: function(response) {
																				handleAjaxError(response);
																}
												})
								}
								$("#inputSearchProduct").keyup($.debounce(500, function(e) {
												searchProduct($(this).val(), '#showSearchResultProduct');
								}));
				});
				$(document).on('click', '.add-product', function(e) {
								var that = $(this),
												productId = that.data('product-id');
								if (checkAddProduct(productId)) {
												msgWarning('Sản phẩm này đã được thêm');
												return;
								}
								addProduct({
												product_id: productId
								});
				})
				$(document).on('click', '.add-product-variation', function(e) {
								var that = $(this),
												productId = that.data('product-id'),
												productVariationId = that.data('product-variation-id');
								if (checkAddProduct(productId, productVariationId)) {
												msgWarning('Sản phẩm này đã được thêm');
												return;
								}
								addProduct({
												product_id: productId,
												product_variation_id: productVariationId,
								});
				})
				$(document).on('change', 'select[name="order[user_id]"]', function(e) {
								var url = $('input[name="route_render_info_shipping"]').val(),
												userId = $(this).val();
								if (userId) {
												$.ajax({
																type: "GET",
																url: url,
																data: {
																				user_id: userId
																},
																success: function(response) {
																				$("#infoShipping").html(response);
																},
																error: function(response) {
																				handleAjaxError(response);
																}
												})
								}
				});

				$(document).on('change', 'select[name="order[discount_id]"]', function(e) {
								reloadTotalOrder();
				});


				$(document).on('change', 'select[name="order[province_id]"]', function(e) {
								provinceId = $(this).val();
								let url = "{{ route('admin.search.select.district') }}";
								select2LoadData(url + '?province_id=' + provinceId, '#district_id');
								select2LoadData('', '#ward_id');
								$('#district_id').val(null).trigger('change');
								$('#ward_id').val(null).trigger('change');
				});

				$(document).on('change', 'select[name="order[district_id]"]', function(e) {
								districtId = $(this).val();
								let url = "{{ route('admin.search.select.ward') }}";
								select2LoadData(url + '?district_id=' + districtId, '#ward_id');
								$('#ward_id').val(null).trigger('change');
				});



				$(document).on('change', 'input[name="order_detail[product_qty][]"]', $.debounce(300, function(e) {
								var unitPrice = $(this).parents('.item-product').find('td.unit-price').text();
								unitPrice = unitPrice.replace(/[$,]/g, '');
								unitPrice = parseFloat(unitPrice);
								unitPrice = unitPrice * $(this).val();
								$(this).parents('.item-product').find('td.total-price').text(formatPrice(unitPrice));
								reloadTotalOrder();
				}))
</script>
