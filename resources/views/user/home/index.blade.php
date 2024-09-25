@extends('user.layouts.master')
@section('title', __('Trang chủ'))

@section('content')
    <x-quickview />
    <div id="content" class="container-fluid d-flex justify-content-center align-items-center">
        @include('user.home.slider')
    </div>
    <div id="container-category" class="position-relative d-flex mt-3">
        @include('user.home.container-categories')
    </div>
    <div id="container-sale-off" class="position-relative d-flex mt-3">
        @include('user.home.container-sale-off')
    </div>
    <div id="container-sale-off" class="position-relative d-flex mt-3">
        @include('user.home.container-product-categories')
    </div>
    <div id="container-sale-off" class="position-relative d-flex mt-3">
        @include('user.home.container-product-categories-right-image')
    </div>
@endsection


