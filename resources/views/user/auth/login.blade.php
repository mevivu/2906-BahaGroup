@extends('user.layouts.master')
@section('title', __('Đăng nhập'))

@section('content')
				<div class="container mt-5">
								<div style="border: none; border-radius: 0" class="form-container">
												<ul class="nav nav-tabs" id="myTab" role="tablist">
																<li class="nav-item" role="presentation">
																				<button class="nav-link active bold-text fs-6" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
																								type="button" role="tab" aria-controls="login" aria-selected="true">Đăng nhập</button>
																</li>
																<li class="nav-item" role="presentation">
																				<button class="nav-link bold-text fs-6" id="register-tab" data-bs-toggle="tab"
																								data-bs-target="#register" type="button" role="tab" aria-controls="register"
																								aria-selected="false">Đăng ký</button>
																</li>
												</ul>
												<div class="tab-content" id="myTabContent">
																<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
																				<x-form :action="route('user.auth.loginUser')" class="mt-3" type="post" :validate="true">
																								<div class="mb-3">
																												<x-input-email name="email" :required="true" />
																								</div>
																								<div class="mb-3">
																												<x-input-password name="password" :required="true" />
																								</div>
																								<div class="mb-3 text-center">
																												<button style="width: 100%;" type="submit" class="btn btn-default">Đăng nhập</button>
																								</div>
																								<div class="text-center">
																												<a href="{{ route('user.auth.forgotPassword') }}" style="width: 100%;" type="Quên mật khẩu"
																																class="btn btn-outline-success">Quên mật khẩu</a>
																								</div>
																				</x-form>
																</div>
																<div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
																				<form class="mt-3" action="{{ route('user.auth.register') }}" method="post">
																								@csrf
																								<div class="mb-3">
																												<input type="text" class="form-control" name="fullname" id="registerfullname"
																																placeholder="Nguyễn Văn A">
																								</div>
																								<div class="mb-3">
																												<input type="email" class="form-control" name="email" id="registeremail"
																																placeholder="Email">
																								</div>
																								<div class="mb-3">
																												<input type="password" class="form-control" name="password" id="registerPassword"
																																placeholder="Mật khẩu">
																								</div>
																								<div class="mb-3">
																												<input type="password" class="form-control" name="confirmed" id="confirmPassword"
																																placeholder="Xác nhận mật khẩu">
																								</div>
																								<button style="width: 100%;" type="submit" class="btn btn-default">Đăng ký</button>
																				</form>
																</div>
												</div>

								</div>
				</div>
@endsection
