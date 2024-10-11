@extends('user.layouts.master')
@section('title', __($title))

<head>
				<meta name="description" content="{{ $meta_desc }}">
</head>

@section('content')
				@include('user.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
				<div id="container-sale-off" class="d-flex justify-content-center align-items-center container">
								<div class="container gap-64">
												<div class="row">
																<div class="col-12 text-center"><img class="img-fluid"
																								src="{{ asset('user/assets/images/bg-flash-sale.jpg') }}" alt="">
																</div>
																<div class="col-12 header-box d-flex align-items-center">
																				<h4>Khuyến mãi giới hạn</h4>
																				<div class="timer">
																								<p class="mt-1"><span id="countdown-flashsale-product">216:19:42:02</span></p>
																				</div>
																</div>
																<div class="col-12">
																				<div class="row">
																								@foreach ($flashSale->details as $item)
																												<div class="col-6 col-md-3 mb-4">
																																<x-cardflash :item="$item" />
																												</div>
																								@endforeach
																				</div>

																				<div class="pagination">
																								<div class="pagination position-absolute w-100 d-flex justify-content-center bottom-0 mb-0 mt-3">
																												<button class="pagination-btn prev" @if ($products->onFirstPage()) disabled @endif
																																onclick="window.location='{{ $products->previousPageUrl() }}'">
																																<i class="fa fa-chevron-left" aria-hidden="true"></i>
																												</button>

																												@for ($i = 1; $i <= $products->lastPage(); $i++)
																																<button class="pagination-btn @if ($i == $products->currentPage()) active @endif"
																																				onclick="window.location='{{ $products->url($i) }}'">
																																				{{ $i }}
																																</button>
																												@endfor

																												<button class="pagination-btn next" @if (!$products->hasMorePages()) disabled @endif
																																onclick="window.location='{{ $products->nextPageUrl() }}'">
																																<i class="fa fa-chevron-right" aria-hidden="true"></i>
																												</button>
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
@endsection
@push('custom-js')
				@include('user.products.scripts.flash-sale-scripts')
@endpush
