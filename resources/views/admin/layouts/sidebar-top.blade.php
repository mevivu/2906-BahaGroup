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

								<div class="navbar-nav order-md-last flex-row">
												<div class="nav-item dropdown">
																<a href="#" class="nav-link dropdown-toggle me-2" data-bs-toggle="dropdown" aria-expanded="false">
																				<span class="icon-bell position-relative">
																								<i class="ti ti-bell me-5"></i>
																								<span class="badge bg-danger rounded-pill position-absolute translate-middle top-0">9</span>
																				</span>
																</a>
																<div class="dropdown-menu dropdown-menu-end">
																				<div class="dropdown-item">
																								<div class="notification">
																												<h6 class="dropdown-title">New Message</h6>
																												<p class="dropdown-message">You have a new message from John Doe.</p>
																								</div>
																				</div>
																				<div class="dropdown-item">
																								<div class="notification">
																												<h6 class="dropdown-title">Account Update</h6>
																												<p class="dropdown-message">Your account has been updated successfully.</p>
																								</div>
																				</div>
																				<div class="dropdown-item">
																								<div class="notification">
																												<h6 class="dropdown-title">Order Confirmation</h6>
																												<p class="dropdown-message">Your order #12345 has been confirmed.</p>
																								</div>
																				</div>
																				<div class="dropdown-item">
																								<div class="notification">
																												<h6 class="dropdown-title">System Maintenance</h6>
																												<p class="dropdown-message">The system will undergo maintenance on 2023-05-15.</p>
																								</div>
																				</div>
																				<div class="dropdown-item">
																								<div class="notification">
																												<h6 class="dropdown-title">New Features</h6>
																												<p class="dropdown-message">Check out the new features added to the platform.</p>
																								</div>
																				</div>
																</div>
												</div>
												@include('admin.layouts.partials.account')
								</div>

								<div class="navbar-collapse collapse" id="navbar-menu">
								</div>
				</div>
</header>
