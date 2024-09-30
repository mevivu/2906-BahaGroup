@extends('user.layouts.master')
@section('title', __('Tin tức'))

@section('content')
<div class="container bg-white shadow rounded-2">
    <div class="row">
        @include ('user.posts.category-bar')
        <div class="col-md-9">
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ $post->thumbnail }}" class="card-img-top" alt="{{ $post->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->description }}</p>
                                <a href="{{ route('user.post.detail', ['id' => $post->id]) }}" class="btn btn-primary">{{ __('Xem chi tiết') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection