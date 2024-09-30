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
    $('#searchInput').keyup(function() {
        let keyword = $(this).val();
        console.log(keyword);

        if (keyword.length > 3) {
            $.ajax({
                url: '{{ route('user.product.search') }}',
                type: 'GET',
                data: {
                    q: keyword
                },
                success: function(data) {
                    $('#searchResults').html(''); // Xóa danh sách kết quả cũ
                    $('#searchInput').append(
                        '<li><a class="dropdown-item" href="#">' + data.length +
                        ' results for with "' + keyword + '"</a></li>'
                    );
                    $.each(data, function(index, product) {
                        $('#searchResults').append(`<li>
                            <a class="dropdown-item" href="/2906-BahaGroup/products/detail/` + product.id + `">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-2 my-auto">
                                            <img src="https://ttbh60s.com/wp-content/uploads/2020/03/Samsung-A50s.jpg" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p class="card-text">` + product.name + `</p>
                                                        <p class="card-text">SKU: ` + product.sku + `</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex justify-content-end">
                                                            <p class="text-decoration-line-through text-secondary">
                                                            ` + product.price + `
                                                            </p>
                                                            <p>` + product.promotion_price + `</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>`);
                    });
                }
            });
        } else {
            console.log('nhập lớn hơn 3 ký tự! hiện tại: ' + keyword.length);
        }
    });
</script>
@stack('custom-js')
