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
																																				<p class="text-muted mb-0">Khách hàng mới (tháng)</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-info" style="width: 100%" role="progressbar">
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

												<div class="row row-deck row-cards mb-4">
																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-success bg-gradient text-info bg-opacity-10">
																																				<i class="ti ti-user-up fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ $newCustomersThisYear }}</h3>
																																				<p class="text-muted mb-0">Khách hàng mới (năm)</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-success bg-gradient" style="width: 100%" role="progressbar">
																																</div>
																												</div>
																								</div>
																				</div>
																</div>
																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-danger text-pink bg-opacity-10">
																																				<i class="ti ti-user-star fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ number_format($returningCustomerRate, 1) }}%</h3>
																																				<p class="text-muted mb-0">Tỷ lệ khách hàng quay lại</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-danger" style="width: {{ $returningCustomerRate }}%"
																																				role="progressbar"></div>
																												</div>
																								</div>
																				</div>
																</div>

																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-info bg-gradient text-danger bg-opacity-10">
																																				<i class="ti ti-package fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ number_format($averageItemsPerOrder, 1) }}</h3>
																																				<p class="text-muted mb-0">Sản phẩm trung bình / đơn</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-info bg-gradient" style="width: 100%" role="progressbar">
																																</div>
																												</div>
																								</div>
																				</div>
																</div>
																<div class="col-sm-6 col-lg-3">
																				<div class="card stats-card">
																								<div class="card-body">
																												<div class="d-flex align-items-center mb-3">
																																<div class="stats-icon bg-warning bg-gradient text-info bg-opacity-10">
																																				<i class="ti ti-discount fs-1 text-white"></i>
																																</div>
																																<div class="ms-3">
																																				<h3 class="mb-0">{{ format_price($totalDiscountGiven) }}</h3>
																																				<p class="text-muted mb-0">Tổng giảm giá cho khách</p>
																																</div>
																												</div>
																												<div class="progress progress-sm">
																																<div class="progress-bar bg-warning bg-gradient" style="width: 100%" role="progressbar">
																																</div>
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
								// Biểu đồ đường (Line Chart) với animation nâng cao
								const revenueCtx = document.getElementById('revenueChart').getContext('2d');

								// Tạo gradient cho background
								const gradientFill = revenueCtx.createLinearGradient(0, 0, 0, 300);
								gradientFill.addColorStop(0, 'rgba(75, 192, 192, 0.6)');
								gradientFill.addColorStop(1, 'rgba(75, 192, 192, 0.0)');

								new Chart(revenueCtx, {
												type: 'line',
												data: {
																labels: {!! json_encode($months) !!},
																datasets: [{
																				label: 'Doanh thu',
																				data: {!! json_encode($monthlyRevenue) !!},
																				borderColor: 'rgb(75, 192, 192)',
																				borderWidth: 3,
																				tension: 0.4,
																				fill: true,
																				backgroundColor: gradientFill,
																				pointBackgroundColor: 'rgb(75, 192, 192)',
																				pointBorderColor: '#fff',
																				pointBorderWidth: 2,
																				pointRadius: 6,
																				pointHoverRadius: 8,
																				pointHoverBackgroundColor: '#fff',
																				pointHoverBorderColor: 'rgb(75, 192, 192)',
																				pointHoverBorderWidth: 3
																}]
												},
												options: {
																responsive: true,
																interaction: {
																				mode: 'index',
																				intersect: false,
																},
																animations: {
																				tension: {
																								duration: 1000,
																								easing: 'easeInOutCubic',
																								from: 0.6,
																								to: 0.1,
																								loop: true
																				},
																				y: {
																								duration: 2000,
																								easing: 'easeInOutQuart',
																								delay: function(ctx) {
																												return ctx.dataIndex * 100;
																								},
																								loop: false
																				}
																},
																plugins: {
																				legend: {
																								labels: {
																												font: {
																																size: 14,
																																weight: 'bold'
																												}
																								}
																				},
																				tooltip: {
																								backgroundColor: 'rgba(0, 0, 0, 0.8)',
																								padding: 12,
																								titleFont: {
																												size: 16,
																												weight: 'bold'
																								},
																								bodyFont: {
																												size: 14
																								},
																								displayColors: false,
																								callbacks: {
																												label: function(context) {
																																return 'Doanh thu: ' + context.parsed.y.toLocaleString() + ' đ';
																												}
																								}
																				}
																},
																scales: {
																				x: {
																								grid: {
																												display: false
																								}
																				},
																				y: {
																								beginAtZero: true,
																								grid: {
																												color: 'rgba(0, 0, 0, 0.05)'
																								}
																				}
																}
												}
								});

								// Biểu đồ tròn (Doughnut Chart) với animation nâng cao
								const pieCtx = document.getElementById('orderPieChart').getContext('2d');
								new Chart(pieCtx, {
												type: 'doughnut',
												data: {
																labels: ['Hoàn thành', 'Chưa xác nhận', 'Đơn hủy'],
																datasets: [{
																				data: [
																								{{ $completedOrders }},
																								{{ $pendingOrders }},
																								{{ $cancelledOrders }},
																				],
																				backgroundColor: [
																								'rgba(75, 192, 92, 0.8)',
																								'rgba(255, 193, 7, 0.8)',
																								'rgba(255, 99, 132, 0.8)'
																				],
																				borderColor: [
																								'rgba(75, 192, 92, 1)',
																								'rgba(255, 193, 7, 1)',
																								'rgba(255, 99, 132, 1)'
																				],
																				borderWidth: 2,
																				hoverOffset: 15
																}]
												},
												options: {
																responsive: true,
																cutout: '65%',
																plugins: {
																				legend: {
																								position: 'bottom',
																								labels: {
																												padding: 15,
																												font: {
																																size: 13
																												},
																												generateLabels: function(chart) {
																																const data = chart.data;
																																const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
																																return data.labels.map((label, i) => ({
																																				text: `${label} (${Math.round(data.datasets[0].data[i]/total*100)}%)`,
																																				fillStyle: data.datasets[0].backgroundColor[i],
																																				strokeStyle: data.datasets[0].borderColor[i],
																																				lineWidth: 2,
																																				hidden: isNaN(data.datasets[0].data[i]) || chart
																																								.getDatasetMeta(0).data[i].hidden,
																																				index: i
																																}));
																												}
																								}
																				},
																				tooltip: {
																								backgroundColor: 'rgba(0, 0, 0, 0.8)',
																								padding: 12,
																								titleFont: {
																												size: 14
																								},
																								bodyFont: {
																												size: 13
																								},
																								callbacks: {
																												label: function(context) {
																																const total = context.dataset.data.reduce((a, b) => a + b, 0);
																																const value = context.raw;
																																const percentage = Math.round(value / total * 100);
																																return `${context.label}: ${value} (${percentage}%)`;
																												}
																								}
																				}
																},
																animations: {
																				animateRotate: true,
																				animateScale: true,
																				animations: {
																								tension: {
																												duration: 1000,
																												easing: 'easeInOutCubic',
																								}
																				}
																},
																animation: {
																				duration: 2000,
																				easing: 'easeInOutQuart',
																				onProgress: function(animation) {
																								const chart = animation.chart;
																								const ctx = chart.ctx;
																								const width = chart.width;
																								const height = chart.height;

																								// Vẽ text ở giữa
																								ctx.restore();
																								const fontSize = (height / 114).toFixed(2);
																								ctx.font = fontSize + 'em sans-serif';
																								ctx.textBaseline = 'middle';

																								const total = {{ $completedOrders + $pendingOrders + $cancelledOrders }};
																								const text = `${total} đơn`;
																								const textX = Math.round((width - ctx.measureText(text).width) / 2);
																								const textY = height / 2;

																								ctx.fillStyle = '#666';
																								ctx.fillText(text, textX, textY - fontSize * 8);
																								ctx.save();
																				}
																}
												}
								});
				});
</script>
