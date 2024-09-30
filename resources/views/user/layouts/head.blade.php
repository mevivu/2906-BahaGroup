<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="X-TOKEN" content="{{ csrf_token() }}">
<meta name="url-home" content="{{ url('/') }}">
<meta name="currency" content="{{ config('custom.currency') }}">
<meta name="position_currency" content="{{ config('custom.format.position_currency') }}">
<title>@yield('title') - Baha Office</title>
<!-- Title and Meta Description -->
<meta name="description" content="@yield('meta_description', 'Dịch vụ thiết kế Website tphcm, lập trình Web App, giá tốt tại tphcm, cam kết chất lượng. Uy tín, chất lượng, hỗ trợ tận tình, chuẩn SEO')">
<meta name="keywords" content="@yield('meta_keywords', 'Baha, văn phòng, sản phẩm, dịch vụ')">
<!-- Thẻ Open Graph -->
<meta property="og:locale" content="vi_VN">
<meta property="og:type" content="website">
<meta property="og:title"
    content="@yield('title') - Mevivu Technology - Dịch vụ thiết kế Website tphcm chuyên nghiệp">
<meta property="og:description" content="@yield('meta_description', 'Dịch vụ thiết kế Website tphcm, lập trình Web App, giá tốt tại tphcm, cam kết chất lượng. Uy tín, chất lượng, hỗ trợ tận tình, chuẩn SEO')">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="Mevivu Technology - Dịch vụ thiết kế Website tphcm chuyên nghiệp">
<meta property="og:image" content="{{ asset('public/user/assets/images/logo.png') }}">
<meta property="og:image:secure_url" content="{{ asset('public/user/assets/images/logo.png') }}">
<meta property="og:image:alt" content="Mevivu Technology - Dịch vụ thiết kế Website tphcm chuyên nghiệp">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
{{-- Thẻ Twitter --}}
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@mevivutech">
<meta name="twitter:title" content="Mevivu Technology - Dịch vụ thiết kế Website tphcm chuyên nghiệp">
<meta name="twitter:creator" content="@mevivutech">
<meta name="twitter:description"
    content="Dịch vụ thiết kế Website tphcm, lập trình Web App, giá tốt tại tphcm, cam kết chất lượng. Uy tín, chất lượng, hỗ trợ tận tình, chuẩn SEO">
<!-- Thẻ Robots -->
<meta name="robots" content="index, follow">
<!-- Thẻ Favicon -->
<link rel="icon" type="image/png" href="{{ asset('public/user/assets/images/icon.png') }}" />
<!-- CSS files -->
<link href="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"type="text/css">
<link rel="stylesheet" href="{{ asset('public/user/assets/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/index.css') }}">
<link rel="stylesheet"
    href="{{ asset('public/user/assets/tabler/plugins/tabler-icon/webfont/tabler-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/content.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/category.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/container-sale-off.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/footer.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/product-category.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/container-categories-right-image.css') }}">
<link rel="stylesheet" href="{{ asset('public/libs/fontawesome6/css/all.min.css') }}" />
<link rel="stylesheet" href="{{ asset('public/user/assets/fotorama-4.6.4/fotorama.css') }}">

<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('/public/libs/datatables/plugins/bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('/public/libs/datatables/plugins/buttons/css/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('/public/libs/datatables/plugins/responsive/css/responsive.bootstrap5.min.css') }}">

<link href="{{ asset('public/user/assets/css/index.css') }}" rel="stylesheet">
@if (Route::currentRouteName() != 'user.order.indexUser')
    <style>
        @media (max-width: 768px) {
            .table {
                width: 100%;
                table-layout: fixed;
            }

            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 10px;
            }

            .table tbody td {
                display: block;
                text-align: right;
                border-bottom: 1px solid #ddd;
                position: relative;
                padding-left: 50%;
            }

            .table tbody td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }

            .table tfoot {
                display: block;
            }

            .table tfoot td {
                display: block;
                text-align: right;
            }

            .table tfoot tr {
                display: flex;
                justify-content: flex-end;
            }
        }
    </style>
@endif
@if (Route::currentRouteName() != 'user.index')
    <style>
        .absolute-category {
            z-index: 3;
        }
    </style>
@endif
@stack('libs-css')
@stack('custom-css')
