<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function toggleProducts() {
            var productList = document.getElementById('productList');
            productList.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Page Content -->
        <main class="flex-1 p-6 flex gap-6">
            <!-- Today's Sales Section -->
            <div class="border border-gray-400 bg-white p-6 rounded-lg shadow-md w-full">
                <h2 class="text-2xl font-semibold mb-2">Today's Sales</h2>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <!-- Total Sales -->
                    <div class="bg-blue-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">$1k Total Sales</h3>
                        <p class="text-sm"><i class="bi bi-arrow-up"></i> 6% from yesterday</p>
                    </div>
                    <!-- Total Orders -->
                    <div class="bg-yellow-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">300 Total Orders</h3>
                        <p class="text-sm"><i class="bi bi-arrow-up"></i> 5% from yesterday</p>
                    </div>
                    <!-- Products Sold -->
                    <div class="bg-green-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">5 Products Sold</h3>
                        <p class="text-sm"><i class="bi bi-arrow-up"></i> 12% from yesterday</p>
                    </div>
                    <!-- New Customers -->
                    <div class="bg-teal-500 text-white p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">8 New Customers</h3>
                        <p class="text-sm"><i class="bi bi-arrow-up"></i> 0.5% from yesterday</p>
                    </div>
                </div>

                <!-- Bar Graph inside Today's Sales Section -->
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-4">Sales Overview</h3>
                    <canvas id="salesChart"></canvas>
                </div>

                <!-- Border Below "Today's Sales" Section -->
                <div class="border-b-2 border-gray-400 mt-4 w-1/4 mx-auto"></div>
            </div>
        </main>
    </div>

    <!-- JavaScript for Chart.js -->
    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Sales ($)',
                    data: [1000, 1200, 1500, 1100, 1700, 1800],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
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
