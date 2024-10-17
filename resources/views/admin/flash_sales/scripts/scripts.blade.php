<script>
    function addProduct(payload){
        closeModal('#modalAddProduct');
        $.ajax({
            type: "GET",
            url: '{{ route('admin.flashsale.add_product') }}',
            data: payload,
            success: function(response){
                $('#tableProduct').prepend(response.data);
            },
            error: function(response){
                if(response.status == 400){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Cảnh báo',
                        text: 'Lỗi thêm vào danh sách flash sale',
                    });
                }
                else{
                    handleAjaxError(response);
                }
            }
        })
    }
    function closeModal(modal){
        $(modal).find('.btn-close').trigger('click');
    }
    function checkAddProduct(productId){
        var elm = '#tableProduct .item-product' + '.product-' + productId;
        if($(elm).length > 0){
            return true;
        }
        return false;
    }

    function deleteItemFlashSaleDetail(id, elm){
        $.ajax({
            type: "DELETE",
            url: '{{ route('admin.flashsale.deleteDetail') }}' + '/' + id,
            data: { _token: token },
            success: function(response){
                removeElmItemFlashSaleDetail(elm);
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Xóa thành công!',
                    showConfirmButton: true
                });
            },
            error: function(response){
                handleAjaxError(response);
            }
        });
    }

    function removeElmItemFlashSaleDetail(elm){
        $(elm).parents('.item-product').remove();
    }

    $(document).on('click', '.remove-item-product', function(e){
        var id = $(this).data('id'), that = this;
        Swal.fire({
            icon: 'warning',
            title: 'Cảnh báo',
            text: 'Bạn có chắc chắn muốn xoá?',
            showCancelButton: true,
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                if(id){
                    deleteItemFlashSaleDetail(id, that);
                }else{
                    removeElmItemFlashSaleDetail(that)
                }
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            }
        });
    })
    $(document).ready(function(e){
        searchProduct('', '#showSearchResultProduct');
        $("#inputSearchProduct").keyup(debounce(500, function(e) {
            const key = document.querySelector('input[name="search_product"]');
            searchProduct(key.value, '#showSearchResultProduct');
        }));
    });

    function debounce(delay, callback) {
            let timer
            return function() {
                clearTimeout(timer)
                timer = setTimeout(() => {
                callback();
                }, delay)
            }
    }

    function searchProduct(keyword, elmRender){
        $.ajax({
            type: "GET",
            url: '{{ route('admin.search.render_product') }}',
            data: { key: keyword },
            success: function(response){
                $(elmRender).html(response);
            },
            error: function(response){
                handleAjaxError(response);
            }
        })
    }


    $(document).on('click', '.add-product', function (e) {
        var that = $(this),
        productId = that.data('product-id');
        if(checkAddProduct(productId)){
            Swal.fire({
                icon: 'warning',
                title: 'Cảnh báo',
                text: 'Sản phẩm này đã có trong danh sách',
            });
            return;
        }
        addProduct({
            product_id: productId,
        });
    })
</script>
