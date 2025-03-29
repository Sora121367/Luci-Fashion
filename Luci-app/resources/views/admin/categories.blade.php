<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Categories</title>
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
        <main class="flex-1 p-6 flex gap-6">
            <!-- Categories Section -->
            <div class="border border-gray-400 bg-white p-6 rounded-lg shadow-md w-full">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Categories</h2>
                    <button class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">+ Add New Categories</button>
                </div>
                
                <table class="table-auto w-full mt-4 border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 border-b">
                            <th class="px-4 py-2 text-left">Category Name</th>
                            <th class="px-4 py-2 text-left">Child Type</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-2">Woman</td>
                            <td class="px-4 py-2">Pent, Jean, Hoodie, Skirt</td>
                            <td class="px-4 py-2 text-center flex items-center justify-center space-x-2">
                                <label class="flex justify-center items-center cursor-pointer">
                                    <input type="checkbox" class="hidden" checked>
                                    <div class="w-10 h-5 bg-gray-300 rounded-full relative">
                                        <div class="w-5 h-5 bg-blue-500 rounded-full absolute left-0 transition-transform"></div>
                                    </div>
                                </label>
                                <button class="bg-green-500 text-white text-xs px-3 py-1 rounded-md">Active</button>
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <i class="bi bi-eye  cursor-pointer"></i>
                                <i class="bi bi-pencil cursor-pointer"></i>
                                <i class="bi bi-trash cursor-pointer"></i>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2">Man</td>
                            <td class="px-4 py-2">Clothing, Shirt, Jacket</td>
                            <td class="px-4 py-2 text-center flex items-center justify-center space-x-2">
                                <label class="flex justify-center items-center cursor-pointer">
                                    <input type="checkbox" class="hidden">
                                    <div class="w-10 h-5 bg-gray-300 rounded-full relative">
                                        <div class="w-5 h-5 bg-blue-500 rounded-full absolute left-0 transition-transform transform translate-x-full"></div>
                                    </div>
                                </label>
                                <button class="bg-black text-white text-xs px-3 py-1 rounded-md">Draft</button>
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <i class="bi bi-eye cursor-pointer"></i>
                                <i class="bi bi-pencil cursor-pointer"></i>
                                <i class="bi bi-trash  cursor-pointer"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>
