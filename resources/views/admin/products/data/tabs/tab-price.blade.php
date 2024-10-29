<div id="price" class="tab-pane active show p-3" role="tabpanel" aria-labelledby="tabPrice">
				<div class="row mb-3">
								<label class="col-5 col-form-label"
												for="">{{ __('Giá bán thường') . ' (' . config('custom.currency') . ')' }} <span
																class="text-danger">*</span></label>
								<div class="col">
												<x-input-price id="product[price]" name="product[price]" :value="$product->price ?? old('product.price')" :placeholder="__('Giá bán thường')" />
								</div>
				</div>
				<div class="row mb-3">
								<label class="col-5 col-form-label"
												for="">{{ __('Giá khuyến mãi') . ' (' . config('custom.currency') . ')' }} <span
																class="text-danger">*</span></label>
								<div class="col">
												<x-input-price id="product[promotion_price]" name="product[promotion_price]" :value="$product->promotion_price ?? old('product.promotion_price')"
																:placeholder="__('Giá khuyến mãi')" />
								</div>
				</div>
				<div class="row mb-3">
								<label class="col-5 col-form-label"
												for="">{{ __('Giá Flash Sale') . ' (' . config('custom.currency') . ')' }} <span
																class="text-danger">*</span></label>
								<div class="col">
												<x-input-price id="product[flashsale_price]" name="product[flashsale_price]" :value="$product->flashsale_price ?? old('product.flashsale_price')"
																:placeholder="__('Giá khuyến mãi')" />
								</div>
				</div>
</div>
