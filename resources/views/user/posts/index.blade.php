@extends('user.layouts.master')
@section('title', __('Tin tức'))

@section('content')
<div id="post" class="container">
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-6 mb-4">
                <div class="col-inner">
                    <a href="{{ route('user.post.detail', ['id' => $post->id]) }}">
                        <div class="post">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid post-image">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <a href="{{ route('user.post.detail', ['id' => $post->id]) }}" class="post-detail-btn">
                                Xem thêm →
                            </a>
                        </div>
                        <div class="badge">
                            <div class="badge-inner">
                                <span
                                    class="post-date-day">{{ \Carbon\Carbon::parse($post->posted_at)->format('d') }}</span><br>
                                <span
                                    class="post-date-month is-xsmall">Th{{ \Carbon\Carbon::parse($post->posted_at)->format('n') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection