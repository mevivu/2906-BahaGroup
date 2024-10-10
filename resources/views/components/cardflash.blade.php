@props(['item'])
</style>
<div class="card hover-shadow border-0 shadow-sm">
				<div class="position-relative">
								<img onclick="location.href='{{ route('user.product.detail', ['id' => $item->product->id]) }}';"
												class="card-img-top img-default" src="{{ asset($item->product->avatar) }}" style="cursor: pointer;"
												alt="Product 3">
								<img onclick="location.href='{{ route('user.product.detail', ['id' => $item->product->id]) }}';"
												class="card-img-top img-hover" src="{{ asset($item->product->gallery[0]) }}" alt="Product 3"
												style="display: none;cursor: pointer;">
								@if ($item->product->type == \App\Enums\Product\ProductType::Simple)
												<span
																class="badge badge-danger position-absolute end-0 top-0 m-3 text-white">{{ $item->product->price != 0 ? ceil(100 - ($item->product->promotion_price * 100) / $item->product->price) . '%' : '' }}</span>
								@else
												<span
																class="badge badge-danger position-absolute end-0 top-0 m-3 text-white">{{ $item->product->productVariations[0]->price != 0 ? ceil(100 - ($item->product->productVariations[0]->promotion_price * 100) / $item->product->productVariations[0]->price) . '%' : '' }}</span>
								@endif
								<span class="badge badge-featured position-absolute start-0 top-0 m-3">Nổi bật</span>
				</div>
				<div class="card-body">
								<h6 class="card-title">
												<x-link class="text-black" :href="route('user.product.detail', ['id' => $item->product->id])">
																{{ $item->product->name }}
												</x-link>
								</h6>
								<div class="rating fs-12">
												@for ($i = 1; $i <= 5; $i++)
																<span class="star"
																				style="color: {{ $i <= $item->product->avg_rating ? '#ffa200' : '#ccc' }};">★</span>
												@endfor
												<span>{{ $item->product->reviews->count() }}</span>
								</div>
								@if ($item->product->type == \App\Enums\Product\ProductType::Simple)
												<p><del>{{ format_price($item->product->price) }}</del> <strong
																				class="text-red">{{ format_price($item->product->promotion_price) }}</strong></p>
								@else
												<p><strong class="text-red">{{ format_price($item->product->productVariations()->min('promotion_price')) }}
																				- {{ format_price($item->product->productVariations()->max('promotion_price')) }}</strong>
												</p>
								@endif
								<div class="progress-container">
												<div style="width: {{ (($item->qty - $item->sold) / $item->qty) * 100 }}%" class="progress-bar"
																id="progressBar"></div>
												<div class="progress-content">
																<div class="progress-icon">
																				<i class="fa fa-bolt"></i>
																</div>
																<span id="progressText">Sold: {{ $item->sold }}/{{ $item->qty }}</span>
												</div>
								</div>
								<div class="product-hover text-center">
												<a style="cursor: pointer;" class="add-to-cart-flash"><i class="fa fa-shopping-cart w-50"
																				aria-hidden="true"></i><i class="fa fa-arrows-alt w-50" data-product-id="1"
																				onclick="showDetailProductModal(this, {{ $item->product->id }})" aria-hidden="true"></i></a>
								</div>
				</div>
</div>
