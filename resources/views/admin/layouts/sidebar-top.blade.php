<style>
				.notification {
								padding: 0.75rem 1.5rem;
								/* Padding for notification items */
								position: relative;
								/* Positioning for overlapping effect */
								border-bottom: 1px solid #e9ecef;
								/* Optional: Line separator */
				}

				.dropdown-title {
								font-size: 0.9rem;
								/* Title font size */
								font-weight: 600;
								/* Title font weight */
								margin-bottom: 0.25rem;
								/* Space between title and message */
				}

				.dropdown-message {
								font-size: 0.8rem;
								/* Message font size */
								color: #fff;
								/* Message color */
								margin-bottom: 0;
								/* No margin at the bottom */
				}

				/* Overlapping effect for notification items */
				.notification:not(:last-child) {
								margin-bottom: -1.5rem;
								/* Adjust negative margin to overlap notifications */
				}

				/* Optional hover effect */
				.notification:hover {
								/* Light hover background */
								cursor: pointer;
								/* Pointer on hover */
				}

				.btn-doc {
								background: linear-gradient(135deg, #ffffff, #ff4d4d);
								color: #333;
								border: none;
								padding: 10px 20px;
								border-radius: 5px;
								display: flex;
								align-items: center;
								font-weight: 500;
								transition: background-color 0.3s ease;
				}

				.btn-doc:hover {
								background: linear-gradient(135deg, #ffcccc, #ff0000);
								color: #fff;
				}

				.icon-book {
								margin-right: 8px;
								font-size: 1.2em;
				}

				.ti-book {
								font-size: 1.5em;
				}

				.icon-bell {
								font-size: 1.5em;
								color: #333;
								right: -3em;
								transition: color 0.3s ease;
				}

				.icon-bell:hover {
								color: #ff4d4d;
				}

				.icon-bell .badge {
								font-size: 0.7em;
								right: 2em !important;
								animation: pulse 1s infinite;
				}

				@keyframes pulse {
								0% {
												transform: scale(1);
								}

								50% {
												transform: scale(1.2);
								}

								100% {
												transform: scale(1);
								}
				}
</style>

<!-- Navbar -->
<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
				<div class="container-xl">
								<div class="d-flex align-items-center">
												@if (auth('admin')->user()->can('readAPIDoc'))
																<a href="{{ asset(config('idoc.path')) }}" target="_blank" class="btn btn-doc">
																				<span class="icon-book">
																								<i class="ti ti-book"></i>
																				</span>
																				{{ __('Documentation API') }}
																</a>
												@endif
												<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
																aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
																<span class="navbar-toggler-icon"></span>
												</button>
								</div>

								<div id="notification-icon" class="navbar-nav order-md-last flex-row">
												<div class="nav-item dropdown">
																<a href="#" class="nav-link dropdown-toggle me-2" data-bs-toggle="dropdown" aria-expanded="false">
																				<span class="icon-bell position-relative">
																								<i class="ti ti-bell me-5"></i>
																								<span id="notification-badge"
																												class="badge bg-danger rounded-pill position-absolute translate-middle top-0"></span>
																				</span>
																</a>
																<div id="notification-dropdown" class="dropdown-menu dropdown-menu-end">
																</div>
												</div>
												@include('admin.layouts.partials.account')
								</div>

								<div class="navbar-collapse collapse" id="navbar-menu">
								</div>
				</div>
</header>

@push('custom-js')
				<script>
								$(document).ready(function() {
												// Hàm để lấy thông báo
												function fetchNotifications() {
																$.ajax({
																				url: "{{ route('admin.notification.getAllNotificationAdmin') }}",
																				method: "GET",
																				success: function(response) {
																								console.log(response);
																								if (response.status === 200) {
																												const notifications = response.data;
																												const notificationCount = notifications.length;

																												// Cập nhật số lượng trên badge
																												const badgeText = notificationCount > 9 ? '9+' : notificationCount;
																												$('#notification-badge').text(badgeText);

																												// Xóa nội dung cũ của dropdown
																												$('#notification-dropdown').empty();

																												// Thêm từng thông báo vào dropdown
																												notifications.forEach(notification => {
																																$('#notification-dropdown').append(`
                         <div class="dropdown-item" id="notification-${notification.id}">
                             <div class="notification">
                                 <h6 class="dropdown-title">${notification.title}</h6>
                                 <p class="dropdown-message">${notification.message}</p>
                             </div>
                         </div>
                     `);
																												});
																								}
																				},
																				error: function() {
																								console.error("Có lỗi xảy ra khi lấy danh sách thông báo.");
																				}
																});
												}

												// Gọi fetchNotifications khi trang load
												fetchNotifications();

												// Khi nhấp vào biểu tượng thông báo
												$('#notification-icon').on('click', function() {
																$.ajax({
																				url: "{{ route('admin.notification.readAllNotification') }}",
																				method: "GET",
																				success: function(response) {
																								if (response.status === 200) {
																												$('#notification-badge').text('0');
																								}
																				},
																				error: function() {
																								console.error("Có lỗi xảy ra khi đánh dấu thông báo đã đọc.");
																				}
																});
												});
								});
				</script>
@endpush
