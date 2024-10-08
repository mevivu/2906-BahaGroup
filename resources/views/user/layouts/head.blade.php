<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="X-TOKEN" content="{{ csrf_token() }}">
<meta name="url-home" content="{{ url('/') }}">
<meta name="currency" content="{{ config('custom.currency') }}">
<meta name="position_currency" content="{{ config('custom.format.position_currency') }}">
<title>@yield('title') - Baha Office</title>
<link rel="icon" type="image/png" href="{{ asset('public/user/assets/images/icon.png') }}" />
<!-- CSS files -->
<link href="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"type="text/css">
<link rel="stylesheet" href="{{ asset('public/user/assets/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/index.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/tabler/plugins/tabler-icon/webfont/tabler-icons.min.css') }}">
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
<style>
    .dropdown-toggle::after {
        display: inline-block;
        margin-left: .255em;
        vertical-align: .255em;
        content: none !important;
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
    }

    .dropdown-menu.show {
        display: block;
        width: 636px;
        cursor: pointer;
        max-height: 520.8px;
        overflow-y: scroll
    }
</style>
<style>
    .size-filter {
        display: block;
        position: relative;
        margin-bottom: 12px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;

    }

    .size-filter input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        border-radius: 20%;
        border: 2px solid black;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .size-filter #checkAll,
    input:checked~.checkmark:after {
        display: block;
    }

    .size-filter .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid #eee;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
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
