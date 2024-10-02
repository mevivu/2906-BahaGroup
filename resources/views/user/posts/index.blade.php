@extends('user.layouts.master')
@section('title', __('Tin tức'))



@section('content')
<div class="container bg-white shadow rounded-2">
    <div class="row">
        @include('user.posts.category-bar')
        @include('user.posts.posts')
    </div>
</div>
@endsection