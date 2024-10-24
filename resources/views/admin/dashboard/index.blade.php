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
												{{-- Thống kê tổng quan --}}
												<div class="row row-deck row-cards mb-4">
																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-primary text-primary bg-opacity-10">
																																				<i class="ti ti-receipt fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ $totalOrders }}</h3>
																																				<p class="text-muted mb-0">Tổng đơn hàng</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-primary" style="width: 100%" role="progressbar"></div>
																												</div>
																								</div>
																				</div>
																</div>

																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-warning text-warning bg-opacity-10">
																																				<i class="ti ti-receipt-off fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ $pendingOrders }}</h3>
																																				<p class="text-muted mb-0">Đơn chưa xác nhận</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-warning"
																																				style="width: {{ ($pendingOrders / $totalOrders) * 100 }}%" role="progressbar"></div>
																												</div>
																								</div>
																				</div>
																</div>

																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-success text-success bg-opacity-10">
																																				<i class="ti ti-receipt-2 fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ $completedOrders }}</h3>
																																				<p class="text-muted mb-0">Đơn hoàn thành</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-success"
																																				style="width: {{ ($completedOrders / $totalOrders) * 100 }}%" role="progressbar"></div>
																												</div>
																								</div>
																				</div>
																</div>

																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-info text-info bg-opacity-10">
																																				<i class="ti ti-coin fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ format_price($totalRevenue) }}</h3>
																																				<p class="text-muted mb-0">Tổng doanh thu</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-info" style="width: 100%" role="progressbar"></div>
																												</div>
																								</div>
																				</div>
																</div>
												</div>

												<div class="row row-deck row-cards mb-4">
																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-info text-info bg-opacity-10">
																																				<i class="ti ti-user-plus fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ $newCustomers }}</h3>
																																				<p class="text-muted mb-0">Khách hàng mới</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-purple"
																																				style="width: {{ ($newCustomers / ($totalCustomers ?: 1)) * 100 }}%" role="progressbar">
																																</div>
																												</div>
																								</div>
																				</div>
																</div>

																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-pink text-pink bg-opacity-10">
																																				<i class="ti ti-brand-producthunt fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ $totalProductsSold }}</h3>
																																				<p class="text-muted mb-0">Sản phẩm đã bán</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-pink" style="width: 100%" role="progressbar"></div>
																												</div>
																								</div>
																				</div>
																</div>

																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-danger text-danger bg-opacity-10">
																																				<i class="ti ti-receipt-tax fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ number_format($cancelRate, 1) }}%</h3>
																																				<p class="text-muted mb-0">Tỷ lệ đơn hủy</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-danger" style="width: {{ $cancelRate }}%" role="progressbar">
																																</div>
																												</div>
																								</div>
																				</div>
																</div>

																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-teal text-teal bg-opacity-10">
																																				<i class="ti ti-cash fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ format_price($averageOrderValue) }}</h3>
																																				<p class="text-muted mb-0">Giá trị TB/đơn</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-teal" style="width: 100%" role="progressbar"></div>
																												</div>
																								</div>
																				</div>
																</div>
												</div>

												{{-- Biểu đồ --}}
												<div class="row">
																<div class="col-lg-8">
																				<div class="card">
																								<div class="card-header">
																												<h3 class="card-title">Biểu đồ doanh thu theo tháng</h3>
																								</div>
																								<div class="card-body">
																												<canvas id="revenueChart" style="height: 300px;"></canvas>
																								</div>
																				</div>
																</div>
																<div class="col-lg-4">
																				<div class="card">
																								<div class="card-header">
																												<h3 class="card-title">Tỷ lệ đơn hàng</h3>
																								</div>
																								<div class="card-body">
																												<canvas id="orderPieChart" style="height: 300px;"></canvas>
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
				document.addEventListener('DOMContentLoaded', function() {
								// Biểu đồ doanh thu
								const revenueCtx = document.getElementById('revenueChart').getContext('2d');
								new Chart(revenueCtx, {
												type: 'line',
												data: {
																labels: {!! json_encode($months) !!},
																datasets: [{
																				label: 'Doanh thu',
																				data: {!! json_encode($monthlyRevenue) !!},
																				borderColor: 'rgb(75, 192, 192)',
																				tension: 0.3,
																				fill: true,
																				backgroundColor: 'rgba(75, 192, 192, 0.2)'
																}]
												},
												options: {
																responsive: true,
																animations: {
																				tension: {
																								duration: 1000,
																								easing: 'linear',
																								from: 0.5,
																								to: 0.3,
																								loop: true
																				}
																}
												}
								});

								// Biểu đồ tròn đơn hàng
								const pieCtx = document.getElementById('orderPieChart').getContext('2d');
								new Chart(pieCtx, {
												type: 'doughnut',
												data: {
																labels: ['Hoàn thành', 'Chưa xác nhận'],
																datasets: [{
																				data: [
																								{{ $completedOrders }},
																								{{ $pendingOrders }},
																				],
																				backgroundColor: [
																								'rgba(75, 192, 92, 0.8)',
																								'rgba(255, 193, 7, 0.8)',
																				]
																}]
												},
												options: {
																responsive: true,
																plugins: {
																				legend: {
																								position: 'bottom'
																				}
																},
																animation: {
																				animateScale: true,
																				animateRotate: true
																}
												}
								});
				});
</script>
