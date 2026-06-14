<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Supply Chain Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Dashboard Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Products</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">-</div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Stock Value</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">-</div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Reorder Alerts</div>
                    <div class="text-3xl font-bold text-red-600 mt-2">-</div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Avg. Inventory Health</div>
                    <div class="text-3xl font-bold text-green-600 mt-2">-</div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Stock Overview by Category -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Stock Overview by Category
                    </h3>
                    <div class="h-80">
                        <canvas id="stockOverviewChart"></canvas>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                        Ready for data binding
                    </p>
                </div>

                <!-- Sales Velocity Trend -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Sales Velocity (Last 7 Days)
                    </h3>
                    <div class="h-80">
                        <canvas id="velocityTrendChart"></canvas>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                        Based on daily stock movements
                    </p>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Supplier Performance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Supplier Performance Rating
                    </h3>
                    <div class="h-80">
                        <canvas id="supplierPerformanceChart"></canvas>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                        Based on delivery speed & quality
                    </p>
                </div>

                <!-- Stock Health Distribution -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Inventory Health Distribution
                    </h3>
                    <div class="h-80">
                        <canvas id="healthDistributionChart"></canvas>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                        Optimal vs Low vs Critical levels
                    </p>
                </div>
            </div>

            <!-- Reorder Alerts Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    🚨 Reorder Alerts (Stock will run out in 3 days)
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Product Code</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Product Name</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Current Stock</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Daily Usage</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Days Left</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-300">Recommended Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td colspan="6" class="py-8 px-4 text-center text-gray-500 dark:text-gray-400">
                                    No data yet. Waiting for database...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Stock Movements -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Recent Stock Movements (Today)
                </h3>
                <div class="space-y-2 text-sm">
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">No stock movements recorded yet.</p>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // ===============================================
        // 1. Stock Overview by Category (Bar Chart)
        // ===============================================
        // TODO: Replace with actual data from controller
        const stockOverviewCtx = document.getElementById('stockOverviewChart').getContext('2d');
        const stockOverviewChart = new Chart(stockOverviewCtx, {
            type: 'bar',
            data: {
                labels: ['Electronics', 'Furniture', 'Supplies', 'Tools', 'Parts'],
                datasets: [{
                    label: 'Stock Quantity',
                    data: [0, 0, 0, 0, 0],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(236, 72, 153, 0.8)'
                    ],
                    borderColor: [
                        'rgb(59, 130, 246)',
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
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantity (units)'
                        }
                    }
                }
            }
        });

        // ===============================================
        // 2. Sales Velocity Trend (Line Chart)
        // ===============================================
        // TODO: Replace with actual daily sales data
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
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Units'
                        }
                    }
                }
            }
        });

        // ===============================================
        // 3. Supplier Performance Rating (Radar Chart)
        // ===============================================
        // TODO: Replace with actual supplier data
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
                maintainAspectRatio: false,
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
        // TODO: Replace with actual health status data
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
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
    @endpush

</x-app-layout>
