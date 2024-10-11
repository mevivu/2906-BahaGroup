<div class="col-md-2 col-12 mb-2">
				<ul class="list-group">
								<li
												class="list-group-item {{ Route::is('user.order.indexUser') || Route::is('user.order.detail') ? 'bg-default text-white' : '' }}">
												<i class="fa fa-shopping-cart me-2 ms-2"></i><x-link
																class="{{ Route::is('user.order.indexUser') || Route::is('user.order.detail') ? 'text-white' : 'text-6' }}"
																:href="route('user.order.indexUser')">ĐƠN
																HÀNG</x-link>
								</li>
								<li class="list-group-item {{ Route::is('user.profile.indexUser') ? 'bg-default text-white' : '' }}"><i
																class="fa fa-user me-2 ms-2"></i><x-link
																class="{{ Route::is('user.profile.indexUser') ? 'text-white' : 'text-6' }}" :href="route('user.profile.indexUser')">TÀI
																KHOẢN</x-link></li>
								<li class="list-group-item {{ Route::is('user.password.indexUser') ? 'bg-default text-white' : '' }}"><i
																class="fa fa-sign-out me-2 ms-2"></i><x-link
																class="{{ Route::is('user.password.indexUser') ? 'text-white' : 'text-6' }}" :href="route('user.password.indexUser')">MẬT
																KHẨU</x-link></li>
								<li style="cursor: pointer;" class="list-group-item"><i class="fa fa-sign-out me-2 ms-2"></i><x-link
																class="text-6" data-bs-toggle="modal" data-bs-target="#modalLogout">ĐĂNG XUẤT</x-link></li>
				</ul>
</div>
