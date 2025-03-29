<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="web-images/logo.png" alt="Logo" class="w-20 h-10 mr-3">
            <h1 class="text-xl font-semibold">Admin Dashboard</h1>
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

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Product List</h2>
                    <a href="{{ url('newproducts') }}" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">
                        + Add New Product
                    </a>
                </div>

                <table class="w-full border-collapse border border-gray-300 text-left text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 p-2">Product Name</th>
                            <th class="border border-gray-300 p-2">Category / Sub-Category</th>
                            <th class="border border-gray-300 p-2">Price</th>
                            <th class="border border-gray-300 p-2">Description</th>
                            <th class="border border-gray-300 p-2">Status</th>
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="border border-gray-300 p-2 flex items-center">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-12 h-14 mr-2">
                                    @else
                                        <img src="{{ asset('web-images/default.png') }}" alt="Default Image" class="w-12 h-14 mr-2">
                                    @endif
                                    {{ $product->name }}
                                </td>
                                <td class="border border-gray-300 p-2">{{ $product->category }} / {{ $product->sub_category }}</td>
                                <td class="border border-gray-300 p-2">${{ $product->price }}</td>
                                <td class="border border-gray-300 p-2">{{ $product->description }}</td>
                                <td class="border border-gray-300 p-2">{{ ucfirst($product->status) }}</td>
                                <td class="border border-gray-300 p-2">
                                    <form action="{{ url('productlist/' . $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-black text-white px-4 py-1 rounded-md hover:bg-gray-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>