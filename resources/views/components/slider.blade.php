<div class="row container-fluid container p-0">
				<div id="slide-show" class="container-fluid col-10 p-0">
								<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
												<div class="carousel-inner wrap-slide">
																<div class="carousel-item active">
																				<div class="d-flex justify-content-center align-items-center position-relative">
																								<div class="row">
																												<div class="content col-5">
																																<h2>{{ $settingsSlider->where('setting_key', 'slider_text_1')->first()->plain_value }}
																																</h2>
																																<h3>{{ $settingsSlider->where('setting_key', 'sub_text_11')->first()->plain_value }}
																																</h3>
																																<p>{{ $settingsSlider->where('setting_key', 'sub_text_12')->first()->plain_value }}
																																</p>
																																<p><button onclick="location.href='{{ route('user.product.indexUser') }}'"
																																								type="button" class="btn">Mua ngay</button></p>
																												</div>
																												<div
																																class="image-box d-flex justify-content-center align-items-center position-relative col-7">
																																<img class="img-fluid"
																																				src="{{ asset($settingsSlider->where('setting_key', 'slider_image_1')->first()->plain_value) }}"
																																				class="d-block" alt="First Slide">
																												</div>

																								</div>

																				</div>
																</div>
																<div class="carousel-item">
																				<div class="d-flex justify-content-center align-items-center position-relative">
																								<div class="row">
																												<div class="content col-5">
																																<h2>{{ $settingsSlider->where('setting_key', 'slider_text_2')->first()->plain_value }}
																																</h2>
																																<h3>{{ $settingsSlider->where('setting_key', 'sub_text_21')->first()->plain_value }}
																																</h3>
																																<p>{{ $settingsSlider->where('setting_key', 'sub_text_22')->first()->plain_value }}
																																<p><button onclick="location.href='{{ route('user.product.indexUser') }}'"
																																								type="button" class="btn">Mua ngay</button></p>
																												</div>
																												<div
																																class="image-box d-flex justify-content-center align-items-center position-relative col-7">
																																<img class="img-fluid"
																																				src="{{ asset($settingsSlider->where('setting_key', 'slider_image_2')->first()->plain_value) }}"
																																				class="d-block col-7" alt="First Slide">
																												</div>
																								</div>

																				</div>
																</div>
																<div class="carousel-item">
																				<div class="d-flex justify-content-center align-items-center position-relative">
																								<div class="row">
																												<div class="content col-5">
																																<h2>{{ $settingsSlider->where('setting_key', 'slider_text_3')->first()->plain_value }}
																																</h2>
																																<h3>{{ $settingsSlider->where('setting_key', 'sub_text_31')->first()->plain_value }}
																																</h3>
																																<p>{{ $settingsSlider->where('setting_key', 'sub_text_32')->first()->plain_value }}
																																<p><button onclick="location.href='{{ route('user.product.indexUser') }}'"
																																								type="button" class="btn">Mua ngay</button></p>
																												</div>
																												<div
																																class="image-box d-flex justify-content-center align-items-center position-relative col-7">
																																<img class="img-fluid"
																																				src="{{ asset($settingsSlider->where('setting_key', 'slider_image_3')->first()->plain_value) }}"
																																				class="d-block col-7" alt="First Slide">
																												</div>
																								</div>

																				</div>
																</div>
												</div>
												<button class="carousel-control-prev slider-button-left" type="button"
																data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
																<i class="fa fa-chevron-left" aria-hidden="true"></i>
												</button>
												<button class="carousel-control-next slider-button-right" type="button"
																data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
																<i class="fa fa-chevron-right" aria-hidden="true"></i>
												</button>
								</div>
								<div class="box-image">
												<img class="img-fluid"
																src="{{ asset($settingsSlider->where('setting_key', 'slider_image_4')->first()->plain_value) }}"
																alt="">
												<img class="img-fluid"
																src="{{ asset($settingsSlider->where('setting_key', 'slider_image_5')->first()->plain_value) }}"
																alt="">
								</div>
				</div>
</div>
