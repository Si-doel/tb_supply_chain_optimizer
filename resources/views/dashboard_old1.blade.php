@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Dashboard</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{ route('dashboard') }}">
                <i class="icon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">Analytics</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<!-- Dashboard Stats -->
<div class="row">
    <div class="col-md-3">
        <div class="card card-stats card-primary">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-ltblue bubble-shadow-small">
                            <i class="fas fa-cubes"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Products</p>
                            <h4 class="card-title">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-success">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-ltgreen bubble-shadow-small">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Stock Value</p>
                            <h4 class="card-title">Rp 0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-danger">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-ltred bubble-shadow-small">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Reorder Alerts</p>
                            <h4 class="card-title">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-warning">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-ltyellow bubble-shadow-small">
                            <i class="fas fa-percent"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Inventory Health</p>
                            <h4 class="card-title">-%</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 1 -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Stock Overview by Category</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="stockOverviewChart" height="200"></canvas>
                </div>
                <p class="text-center text-muted small mt-3">Ready for data binding</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Sales Velocity (Last 7 Days)</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="velocityTrendChart" height="200"></canvas>
                </div>
                <p class="text-center text-muted small mt-3">Based on daily stock movements</p>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Supplier Performance Rating</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="supplierPerformanceChart" height="200"></canvas>
                </div>
                <p class="text-center text-muted small mt-3">Based on delivery speed & quality</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Inventory Health Distribution</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="healthDistributionChart" height="200"></canvas>
                </div>
                <p class="text-center text-muted small mt-3">Optimal vs Low vs Critical levels</p>
            </div>
        </div>
    </div>
</div>

<!-- Reorder Alerts Table -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">🚨 Reorder Alerts (Stock will run out in 3 days)</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Current Stock</th>
                                <th>Daily Usage</th>
                                <th>Days Left</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No reorder alerts at this moment. Waiting for database...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Stock Movements -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Recent Stock Movements (Today)</div>
            </div>
            <div class="card-body">
                <p class="text-center text-muted py-4">No stock movements recorded yet.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ===============================================
    // 1. Stock Overview by Category (Bar Chart)
    // ===============================================
    const stockOverviewCtx = document.getElementById('stockOverviewChart').getContext('2d');
    const stockOverviewChart = new Chart(stockOverviewCtx, {
        type: 'bar',
        data: {
            labels: ['Electronics', 'Furniture', 'Supplies', 'Tools', 'Parts'],
            datasets: [{
                label: 'Stock Quantity',
                data: [0, 0, 0, 0, 0],
                backgroundColor: [
                    'rgba(66, 134, 244, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(251, 146, 60, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(236, 72, 153, 0.8)'
                ],
                borderColor: [
                    'rgb(66, 134, 244)',
                    'rgb(34, 197, 94)',
                    'rgb(251, 146, 60)',
                    'rgb(168, 85, 247)',
                    'rgb(236, 72, 153)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // ===============================================
    // 2. Sales Velocity Trend (Line Chart)
    // ===============================================
    const velocityTrendCtx = document.getElementById('velocityTrendChart').getContext('2d');
    const velocityTrendChart = new Chart(velocityTrendCtx, {
        type: 'line',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
            datasets: [{
                label: 'Units Sold',
                data: [0, 0, 0, 0, 0, 0, 0],
                borderColor: 'rgb(239, 68, 68)',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgb(239, 68, 68)',
                pointBorderColor: '#fff',
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // ===============================================
    // 3. Supplier Performance Rating (Radar Chart)
    // ===============================================
    const supplierPerformanceCtx = document.getElementById('supplierPerformanceChart').getContext('2d');
    const supplierPerformanceChart = new Chart(supplierPerformanceCtx, {
        type: 'radar',
        data: {
            labels: ['Supplier A', 'Supplier B', 'Supplier C', 'Supplier D'],
            datasets: [{
                label: 'Performance Score (0-100)',
                data: [0, 0, 0, 0],
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.2)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });

    // ===============================================
    // 4. Inventory Health Distribution (Doughnut Chart)
    // ===============================================
    const healthDistributionCtx = document.getElementById('healthDistributionChart').getContext('2d');
    const healthDistributionChart = new Chart(healthDistributionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Optimal', 'Low Stock', 'Critical'],
            datasets: [{
                data: [0, 0, 0],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(251, 146, 60, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: [
                    'rgb(34, 197, 94)',
                    'rgb(251, 146, 60)',
                    'rgb(239, 68, 68)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endpush
