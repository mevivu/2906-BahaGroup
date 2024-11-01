@extends('admin.layouts.master')
<style>
				.stats-card {
								transition: all 0.3s ease;
				}

				.stats-card:hover {
								transform: translateY(-5px);
								box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
				}

				.stats-icon {
								width: 48px;
								height: 48px;
								border-radius: 50%;
								display: flex;
								align-items: center;
								justify-content: center;
				}
</style>

@section('content')
				<div class="page-header d-print-none">
								<div class="container-xl">
												<div class="row g-2 align-items-center">
																<div class="col">
																				<h2 class="page-title">
																								{{ __('Dashboard') }}
																				</h2>
																</div>
												</div>
								</div>
				</div>

				<div class="page-body">
								<div class="container-xl">
								</div>
				</div>
@endsection
