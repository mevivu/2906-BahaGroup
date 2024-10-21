@extends('user.layouts.master')
@section('title', __($title))

@push('meta')
	<meta name="title" content="{{ $title }}">
	<meta name="description" content="{{ $meta_desc }}" />
@endpush

@section('content')
@include('user.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
<div id="post-container" class="container">
	<div class="row">
		@foreach ($posts as $post)
			<div class="col-lg-4 col-12">
				<x-link class="post-wrapper" style="--post-image: url('{{ asset($post->image) }}')"
					href="{{ route('user.post.fallback', ['slug' => $post->slug]) }}">
					<h1 class="post-title">{{ $post->title }}</h1>
					<p class="post-excerpt">{{ $post->excerpt }}</p>
					<x-button type="button" class="btn-light post-button">Xem thêm</x-button>
				</x-link>
			</div>
		@endforeach
		<div class="pagination">
			{{ $posts->links() }}
		</div>
	</div>
</div>
@endsection