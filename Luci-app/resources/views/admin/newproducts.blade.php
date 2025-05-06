<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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
            <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>
                <form action="{{ url('saveproduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label class="block font-medium">Product Name:</label>
                        <input type="text" name="name" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                    </div>

                    <!-- Main Category -->
                    <div class="mb-4">
                        <label class="block font-medium">Main Category</label>
                        <select name="category" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                            <option value="Man">Man</option>
                            <option value="Women">Women</option>
                        </select>
                    </div>
                    
                    <!-- Sub-Category -->
                    <div class="mb-4">
                        <label class="block font-medium">Sub-Category:</label>
                        <select name="sub_category" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                            <option value="Shirt">Shirt</option>
                            <option value="Jeans">Jeans</option>
                            <option value="Dress">Dress</option>
                            <option value="Shoes">Shoes</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label class="block font-medium">Price:</label>
                        <input type="text" name="price" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                    </div>

                    <!-- Choose Size (Multiple Options with Checkboxes) -->
                    <div class="mb-4">
                        <label class="block font-medium">Choose Size:</label>
                        <div class="space-y-2">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="sizes[]" value="{{ $size }}" class="form-checkbox h-5 w-5 text-gray-600">
                                    <span class="ml-2">{{ $size }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block font-medium">Description:</label>
                        <textarea name="description" class="border border-gray-400 w-full px-3 py-2 rounded-md" rows="4"></textarea>
                    </div>

                    <!-- Product Image with Preview -->
                    <div class="mb-4">
                        <label class="block font-medium">Product Image:</label>
                        <input type="file" name="image" id="productImage" class="border border-gray-400 w-full px-3 py-2 rounded-md" onchange="previewImage(event)">
                        <div id="imagePreviewContainer" class="mt-3">
                            <img id="imagePreview" src="" alt="Image Preview" class="max-w-xs h-32 rounded-md hidden">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="block font-medium">Status:</label>
                        <div>
                            <label><input type="radio" name="status" value="active"> Active</label>
                            <label><input type="radio" name="status" value="inactive"> Inactive</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">Save Product</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "";
                imagePreview.classList.add('hidden');
            }
        }
    </script>
</body>
</html>