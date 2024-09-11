<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<meta name="X-TOKEN" content="{{ csrf_token() }}">
<meta name="url-home" content="{{ url('/') }}">
<meta name="currency" content="{{ config('custom.currency') }}">
<meta name="position_currency" content="{{ config('custom.format.position_currency') }}">
<title>Baha Office</title>
<link rel="icon" type="image/png" href="{{ asset('public/user/assets/images/icon.png') }}" />
<!-- CSS files -->
<link href="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"type="text/css">
<link rel="stylesheet" href="{{ asset('public/user/assets/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" >
<link rel="stylesheet" href="{{ asset('public/user/assets/css/index.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/tabler/plugins/tabler-icon/webfont/tabler-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/content.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/category.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/container-sale-off.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/footer.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/product-category.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/css/container-categories-right-image.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/user/assets/fotorama-4.6.4/fotorama.css') }}">

<link href="{{ asset('public/user/assets/css/index.css') }}" rel="stylesheet">
@stack('libs-css')
@stack('custom-css')
