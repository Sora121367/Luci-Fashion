<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 p-6 space-y-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">
                <!-- Total Sales -->
                <div class="bg-blue-500 text-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">${{ number_format($totalSales ?? 0, 2) }} Total Sales</h3>
                </div>

                <!-- Total Users -->
                <div class="bg-yellow-500 text-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">{{ $totalUsers }} Total Users</h3>
                </div>

                <!-- New Users Today -->
                <div class="bg-teal-500 text-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">{{ $newUsersToday }} New Users Today</h3>
                </div>

                <!-- Products Sold -->
                <div class="bg-green-500 text-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">{{ $totalProductsSold }} Products Sold</h3>
                </div>
                <!-- Products Sold -->
                <div class="bg-red-500 text-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">{{ $totalPendingOrders }} Total Pending</h3>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="bg-white p-6 rounded-lg shadow border border-gray-300">
                <h2 class="text-xl font-semibold mb-4">Monthly Sales Overview</h2>
                <canvas id="salesChart"></canvas>
            </div>
        </main>
    </div>

    <script>
        const labels = @json($salesLabels);
        const data = @json($salesData);

        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Monthly Sales ($)',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.3)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
