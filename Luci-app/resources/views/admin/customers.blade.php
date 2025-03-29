<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Customer's Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
        <main class="flex-1 p-6">
            <div class="border border-gray-400 bg-white p-6 rounded-lg shadow-md w-full">
                <h2 class="text-2xl font-semibold mb-4">Customer's Orders</h2>

                <!-- Customer Table -->
                <div class="overflow-x-auto">
                    <table id="customerTable" class="min-w-full border border-gray-400 bg-white rounded-lg shadow-md">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="p-3 text-left">
                                    <input type="checkbox">
                                </th>
                                <th class="p-3 text-left">Customer Name</th>
                                <th class="p-3 text-left">Email</th>
                                <th class="p-3 text-left">Orders</th>
                                <th class="p-3 text-left">Total</th>
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Dynamic Content -->
                        </tbody>
                    </table>
                </div>

                <!-- Delete Button -->
                <div class="mt-4 flex justify-end">
                    <button id="deleteButton" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600">
                        Delete Customer
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Function to toggle showing/hiding the Products list
        function toggleProducts() {
            const productList = document.getElementById('productList');
            productList.classList.toggle('hidden'); // Toggle the 'hidden' class
        }

        // Fetch Data from API
        async function fetchCustomerData() {
            const response = await fetch('/api/customers'); // Replace with your API endpoint
            const data = await response.json();
            const tableBody = document.getElementById('tableBody');

            tableBody.innerHTML = ''; // Clear existing rows
            data.forEach(customer => {
                const row = `
                    <tr>
                        <td class="p-3">
                            <input type="checkbox" data-id="${customer.id}">
                        </td>
                        <td class="p-3">${customer.name}</td>
                        <td class="p-3">${customer.email}</td>
                        <td class="p-3">${customer.orders}</td>
                        <td class="p-3">$${customer.total.toFixed(2)}</td>
                        <td class="p-3">
                            <button class="bg-blue-500 text-white px-4 py-1 rounded-md hover:bg-blue-600">
                                Action
                            </button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        // Initialize Table on Page Load
        document.addEventListener('DOMContentLoaded', fetchCustomerData);
    </script>
</body>
</html>
