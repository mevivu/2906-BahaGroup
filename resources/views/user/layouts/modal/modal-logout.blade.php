<div class="modal modal-blur fade zoom-in" id="modalLogout" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-sm modal-dialog-centered animate__animated animate__fadeInDown" role="document">
								<div class="modal-content">
												<div class="modal-body">
																<div>{{ __('Bấm đăng xuất, bạn sẽ đăng xuất khỏi hệ thống.') }}</div>
												</div>
												<div class="modal-footer">
																<button type="button" class="btn btn-success btn-icon animate__animated animate__fadeIn me-auto"
																				data-bs-dismiss="modal"><i class="ti ti-ban me-1"></i>Quay lại</button>
																<form class="animate__animated animate__fadeIn" :action="route('user.logout')" method="POST">
																				@csrf
																				<button type="submit" class="btn btn-danger btn-icon">{{ __('Đăng xuất') }} <i
																												class="ti ti-arrow-right"></i></button>
																</form>
												</div>
								</div>
				</div>
</div>
