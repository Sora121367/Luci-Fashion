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

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

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
                            <th class="border border-gray-300 p-2">Size</th>
                            <th class="border border-gray-300 p-2">Description</th>
                            {{-- <th class="border border-gray-300 p-2">Status</th> --}}
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="border border-gray-300 p-2 flex items-center">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="w-12 h-14 mr-2">
                                    @else
                                        <img src="{{ asset('web-images/default.png') }}" alt="Default Image" class="w-12 h-14 mr-2">
                                    @endif
                                    {{ $product->name }}
                                </td>
                                <td class="border border-gray-300 p-2">
                                    {{ $product->category->parent->name ?? '' }} / {{ $product->category->name ?? 'N/A' }}
                                </td>
                                <td class="border border-gray-300 p-2">${{ $product->price }}</td>
                                <td class="border border-gray-300 p-2">
                                    @php
                                        $sizes = json_decode($product->sizes, true);
                                    @endphp
                                    {{ is_array($sizes) ? implode(', ', $sizes) : 'N/A' }}
                                </td>
                                <td class="border border-gray-300 p-2">{{ $product->description }}</td>

                                {{-- Edit & Delete --}}
                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ url('editproducts/'.$product->id) }}" class="text-blue-500"><i class="bi bi-pencil cursor-pointer"></i></a>

                                    <form action="{{ url('productlist/'.$product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this Product?')" class="text-black">
                                            <i class="bi bi-trash cursor-pointer"></i>
                                        </button>
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