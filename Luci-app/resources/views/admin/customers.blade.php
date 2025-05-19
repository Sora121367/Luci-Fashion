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

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

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
