
@extends('user.layouts.master')

@section('content')
    <div style="position: relative;" id="content" class="container-fluid d-flex justify-content-center align-items-center">
        @include('user.home.slider')
    </div>
    <div id="container-category" class="container d-flex justify-content-center align-items-center">
        @include('user.home.container-categories')
    </div>
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        @include('user.home.container-sale-off')
    </div>
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        @include('user.home.container-product-categories')
    </div>
    <div id="container-sale-off" class="container d-flex justify-content-center align-items-center">
        @include('user.home.container-product-categories-right-image')
    </div>
@endsection


