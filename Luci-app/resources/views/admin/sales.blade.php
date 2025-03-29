<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard-Sale</title>
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

    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="web-images/logo.png" alt="Logo" class="w-20 h-10 mr-3">
            <h1 class="text-xl font-semibold">Dashboard</h1>
        </div>
        <div class="flex items-center space-x-4">
            <input type="search" placeholder="Search" class="border rounded-md px-3 py-1 focus:outline-none focus:ring focus:ring-blue-300">
            <button class="bg-gray-400 text-white px-4 py-1 rounded-md hover:bg-gray-500">Search</button>
            <i class="bi bi-bell text-xl cursor-pointer"></i>
            <div class="relative">
                <button class="flex items-center space-x-2">
                    <img src="web-images/adminpro.png" alt="User" class="w-8 h-8 rounded-full">
                    <span>Admin</span>
                </button>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-60 min-h-screen bg-gray-300 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="/dashboard" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                        <i class="bi bi-house-door mr-2"></i> Dashboard
                    </a>
                </li>

                <!-- Collapsible Products Section -->
                <li>
                    <a href="{{ url('productlist') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                        <i class="bi bi-box-seam mr-2"></i> Product List
                    </a>
                </li>
                <li>
                    <a href="{{ url('categories') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                        <i class="bi bi-tags mr-2"></i> Categories
                    </a>
                </li>

                <li>
                    <a href="{{ url('sales') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                        <i class="bi bi-cart mr-2"></i> Sales
                    </a>
                </li>
                <li>
                    <a href="{{ url('customers') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                        <i class="bi bi-person-lines-fill mr-2"></i> Customers
                    </a>
                </li>
                <li>
                    <a href="{{ url('customers') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                        <i class="bi bi-file-earmark-text mr-2"></i> Report
                    </a>
                </li>
                <li>
                    <a href="/settings" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                        <i class="bi bi-gear mr-2"></i> Settings
                    </a>
                </li>
                <li>
                    <a href="/logout" class="flex items-center p-3 hover:bg-gray-400 rounded-md">
                        <i class="bi bi-box-arrow-right mr-2"></i> Logout
                    </a>
                </li>
            </ul>
        </aside>

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

</body>
</html>
