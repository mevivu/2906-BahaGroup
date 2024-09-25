@php
    $categoryRepository = app()->make(App\Admin\Repositories\Category\CategoryRepository::class);
    $categories = $categoryRepository->getFlatTree();
    $parentCategories = $categoryRepository->getParentCategory();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('user.layouts.head')
</head>

<body>
    <div id="root">
        <div id="header" class="container-fluid p-0">
            @include('user.layouts.header')
        </div>
        <div style="position: relative;" id="content" class="container-fluid d-flex justify-content-center align-items-center">
            @include('user.layouts.modal.modal-categories')
        </div>
        @yield('content')
        @include('user.layouts.modal.modal-logout')
        @include('user.layouts.footer')
    </div>
@include('user.layouts.scripts')
<x-alert/>
</body>

</html>
