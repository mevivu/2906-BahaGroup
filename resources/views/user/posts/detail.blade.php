@extends('user.layouts.master')
@section('title', $post->title)

<head>
    <meta name="description" content="{{ $post->excerpt }}" />
</head>

@section('content')
<div class="container bg-white shadow rounded-2">
    <div class="row">
        @include('user.posts.category-bar')
        <div class="col-md-9">
            <div class="card mb-4">
                <img src="{{ $post->thumbnail }}" class="card-img-top" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <div class="card-text">{!! $post->content !!}</div>
                    <a href="{{ route('user.post.index') }}" class="btn btn-primary">{{ __('Quay lại') }}</a>
                </div>
                <div class="card-footer text-muted">
                    {{ __('Đăng vào') }} {{ \Carbon\Carbon::parse($post->posted_at)->format('d/m/Y H:i') }}
                    <span class="float-end">
                        {{ __('Danh mục') }}:
                        @foreach ($post->categories as $category)
                            @if ($category->status == '1')
                                <a href="{{ route('user.post.category', ['id' => $category->id]) }}" class="badge bg-primary">{{ $category->name }}</a>
                            @endif
                        @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection