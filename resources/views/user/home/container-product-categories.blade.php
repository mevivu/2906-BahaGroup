<div id="product-category" class="rounded-3 container shadow">
				<div class="row">
								<div class="col-12 header-box d-flex align-items-center nav-tabs-wrapper rounded-top bg-white shadow-sm">
												<h5 class="mb-0">{{ $settingsGeneral->where('setting_key', 'title_home_slider_1')->first()->plain_value }}
												</h5>
												<nav>
																<div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
																				@foreach ($homeSliderCategory1 as $category1)
																								<button class="nav-link tab-btn {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
																												data-bs-target="#nav-home-category1-{{ $category1->id }}" type="button" role="tab"
																												aria-controls="nav-sport" aria-selected="false">{{ $category1->name }}</button>
																				@endforeach
																				<button id="allBtn" class="nav-link"
																								onclick="location.href='{{ route('user.product.indexUser') }}';" type="button" role="tab"
																								aria-selected="true">Tất cả</button>
																</div>
												</nav>
								</div>
								<div class="col-12 col-md-2 p-0">
												<a href="#" class="banner-img">
																<img class="img-fluid" loading="lazy" decoding="async"
																				src="{{ asset($settingsGeneral->where('setting_key', 'image_home_slider_1')->first()->plain_value) }}"
																				class="d-none d-xl-inline-block" alt="" width="220">
												</a>
								</div>
								<div class="col-12 col-md-10">
												<div class="tab-content" id="nav-tabContent">
																@foreach ($homeSliderCategory1 as $category1)
																				<div id="nav-home-category1-{{ $category1->id }}"
																								class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" role="tabpanel"
																								aria-labelledby="nav-home-tab">
																								<div id="productCarousel-1-{{ $category1->id }}" class="product-carousel-home carousel slide">
																												<div class="carousel-inner">
																																@php
																																				$chunks = array_chunk($category1->products->all(), 4);
																																@endphp
																																@foreach ($chunks as $index => $chunk)
																																				<div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
																																								<div class="container">
																																												<div class="row">
																																																@foreach ($chunk as $product)
																																																				<div class="col-md-3 mb-4">
																																																								<x-cardproduct :item="$product" />
																																																				</div>
																																																@endforeach
																																												</div>
																																								</div>
																																				</div>
																																@endforeach
																												</div>
																												@if (count($chunks) > 1)
																																<button class="carousel-control-prev left-btn-slider" type="button"
																																				data-bs-target="#productCarousel-1-{{ $category1->id }}" data-bs-slide="prev">
																																				<i class="fa fa-chevron-left" aria-hidden="true"></i>
																																</button>
																																<button class="carousel-control-next right-btn-slider" type="button"
																																				data-bs-target="#productCarousel-1-{{ $category1->id }}" data-bs-slide="next">
																																				<i class="fa fa-chevron-right" aria-hidden="true"></i>
																																</button>
																												@endif
																								</div>
																				</div>
																@endforeach
												</div>
								</div>
				</div>
</div>
