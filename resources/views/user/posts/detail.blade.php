@extends('user.layouts.master')
@section('title', $post->title)

<head>
    <meta name="description" content="{{ $post->excerpt }}" />
</head>

@section('content')
<div id="post-detail" class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="post">
                <h5 class="post-title">{{ $post->title }}</h5>
                <div class="divider"></div>
                <p class="post-date">Đăng vào {{ \Carbon\Carbon::parse($post->posted_at)->format('d/m/Y H:i') }}</p>
                <img src="{{ asset($post->image) }}" class="post-image img-fluid" alt="{{ $post->title }}">
                <div class="post-text">{!! $post->content !!}</div>
            </div>
            <div class="related-post-wrapper">
                <h5 class="related-title">Bài viết liên quan</h5>
                <div class="row">
                    @foreach($relatedPosts as $relatedPost)
                        <div class="col-md-4">
                            <div class="related-post">
                                <a href="{{ route('user.post.detail', ['id' => $relatedPost->id]) }}">
                                    <img src="{{ asset($relatedPost->image) }}" class="related-post-image img-fluid"
                                        alt="{{ $relatedPost->title }}">
                                    <p class="related-post-title">{{ $relatedPost->title }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('user.posts.category-bar')
    </div>
    @endsection