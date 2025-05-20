<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sales Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Page Content -->
        <main class="flex-1 p-6">
            <h2 class="text-2xl font-semibold mb-4">Admin Dashboard - Sales Overview</h2>

            <!-- Today's Sales Summary -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">$1k Total Sales</h3>
                    <p class="text-sm"><i class="bi bi-arrow-up"></i> 6% from yesterday</p>
                </div>
                <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">300 Total Orders</h3>
                    <p class="text-sm"><i class="bi bi-arrow-up"></i> 5% from yesterday</p>
                </div>
                <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">5 Products Sold</h3>
                    <p class="text-sm"><i class="bi bi-arrow-up"></i> 12% from yesterday</p>
                </div>
                <div class="bg-teal-500 text-white p-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">8 New Customers</h3>
                    <p class="text-sm"><i class="bi bi-arrow-up"></i> 0.5% from yesterday</p>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold mb-4">Sales Overview</h3>
                <canvas id="salesChart"></canvas>
            </div>
        </main>
    </div>

    <!-- Chart Initialization -->
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Sales ($)',
                    data: [5000, 8000, 6000, 12000, 15000],
                    backgroundColor: [ 'rgba(75, 192, 192, 0.2)']
                }]
            }
        });
    </script>

</body>
</html>