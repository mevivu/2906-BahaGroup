@extends('user.layouts.master')
@section('title', __($title))

@push('meta')
	<meta name="title" content="{{ $title }}">
	<meta name="description" content="{{ $meta_desc }}" />
@endpush

@section('content')
@include('user.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
<div id="post" class="container">
	<div class="row">
		@foreach ($posts as $post)
			<div class="col-6">
				<a href="{{ route('user.post.fallback', ['slug' => $post->slug]) }}">
					<div class="post">
						<img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="img-fluid post-image">
						<h2 class="post-title">{{ $post->title }}</h2>
						<a href="{{ route('user.post.fallback', ['slug' => $post->slug]) }}" class="post-detail-btn">
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
		@endforeach
		<div class="pagination">
			<div class="pagination w-100 d-flex justify-content-center bottom-0 mb-0 mt-3">
				<button class="pagination-btn prev" @if ($posts->onFirstPage()) disabled @endif
					onclick="window.location='{{ $posts->previousPageUrl() }}'">
					<i class="fa fa-chevron-left" aria-hidden="true"></i>
				</button>

				@for ($i = 1; $i <= $posts->lastPage(); $i++)
					<button class="pagination-btn @if ($i == $posts->currentPage()) active @endif"
						onclick="window.location='{{ $posts->url($i) }}'">
						{{ $i }}
					</button>
				@endfor

				<button class="pagination-btn next" @if (!$posts->hasMorePages()) disabled @endif
					onclick="window.location='{{ $posts->nextPageUrl() }}'">
					<i class="fa fa-chevron-right" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</div>
</div>
@endsection