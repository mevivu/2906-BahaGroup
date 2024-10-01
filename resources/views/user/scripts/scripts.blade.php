<script src="{{ asset('public/user/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/user/assets/js/jquery.js') }}"></script>
<script src="{{ asset('public/user/assets/fotorama-4.6.4/fotorama.js') }}"></script>
<script src="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>

<!-- datatables -->
<script src="{{ asset('/public/libs/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/bs5/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/responsive/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/responsive/js/responsive.bootstrap5.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('libs-js')
<script type="module" src="{{ asset('public/admin/assets/js/i18n.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/setup.js') }}"></script>
<script src="{{ asset('public/user/assets/js/home.js') }}"></script>
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&language=vi&callback=initMaps"
    async defer></script>
<script>
    function initMaps() {
        try {
            if (typeof initMap === 'function') {
                initMap();
            }
            if (typeof initEndMap === 'function') {
                initEndMap();
            }

        } catch (error) {
            handleAjaxError();
            window.location.reload();
        }
    }
</script>
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
                                                            <span class="card-text ${value.promotion_price ? 'text-decoration-line-through text-secondary' : 'text-dark'}">
                                                                ${value.price ? number_format(value.price).toString() + '₫' : 'Liên hệ'}
                                                            </span>
                                                            ${value.promotion_price ? `<span class="card-text text-red">${number_format(value.promotion_price).toString()}₫</span>` : ''}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        `)
                    })
                },
                error: function(response) {
                    $('#menu-1').html('');
                    $('#menu-1').append(`
                        <li>
                            <a href="#" class="dropdown-item">
                                Đã có lỗi xảy ra...
                            </a>
                        </li>
                    `);
                    handleAjaxError(response);
                }
            })
        } else {
            $('#menu-1').html('');
            $('#menu-1').append(`
                <li>
                    <a href="#" class="dropdown-item">
                        Phải nhập ít nhất 3 ký tự
                    </a>
                </li>
            `);
        }
    })
</script>
@stack('custom-js')
