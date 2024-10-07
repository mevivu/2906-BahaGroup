@extends('user.layouts.master')
@section('title', __($title))

<head>
				<meta name="description" content="{{ $meta_desc }}">
</head>

@section('content')
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
																				<div class="row no-gutters">
																								@foreach ($flashSale->details as $item)
																												<div class="col-6 col-md-3">
																																<x-cardflash :item="$item" />
																												</div>
																								@endforeach
																				</div>

																				{{-- <div id="pagination" class="pagination">
																								@if ($paginator->totalPages > 1)
																												<button class="pagination-btn prev" disabled><i class="fa fa-chevron-left"
																																				aria-hidden="true"></i></button>
																								@endif
																								@php
																												$start = $paginator->currentPage - 2 > 0 ? $paginator->currentPage - 2 : 1;
																												$end =
																												    $paginator->currentPage + 2 <= $paginator->totalPages
																												        ? $paginator->currentPage + 2
																												        : $paginator->totalPages;
																								@endphp
																								@for ($i = $start; $i <= $end; $i++)
																												<button class="pagination-btn {{ $i == $paginator->currentPage ? 'active' : '' }}"
																																data-page="{{ $i }}">{{ $i }}</button>
																								@endfor
																								@if ($paginator->totalPages > 1)
																												<button class="pagination-btn next"><i class="fa fa-chevron-right"
																																				aria-hidden="true"></i></button>
																								@endif
																				</div> --}}
																</div>
												</div>
								</div>
				</div>
@endsection
@push('custom-js')
				@include('user.products.scripts.flash-sale-scripts')
@endpush
