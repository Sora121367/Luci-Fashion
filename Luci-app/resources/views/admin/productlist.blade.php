<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    />
</head>
<body class="bg-gray-100">

    @include('layouts.navbar')

    <div class="flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">Product List</h2>
                    <a href="{{ url('newproducts') }}"
                       class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">
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
                            <th class="border border-gray-300 p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="border border-gray-300 p-2">
                                    <div class="flex items-center space-x-2">
                                        {{-- Show only the main image --}}
                                        @if ($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}"
                                                 alt="Main Image"
                                                 class="w-12 h-14 object-cover rounded border" />
                                        @else
                                            <img src="{{ asset('web-images/default.png') }}"
                                                 alt="Default"
                                                 class="w-12 h-14 object-cover rounded border" />
                                        @endif

                                        <span class="ml-2 font-medium">{{ $product->name }}</span>
                                    </div>
                                </td>

                                <td class="border border-gray-300 p-2">
                                    {{ $product->category->parent->name ?? '' }}
                                    @if ($product->category->parent)
                                        /
                                    @endif
                                    {{ $product->category->name ?? 'N/A' }}
                                </td>

                                <td class="border border-gray-300 p-2">${{ number_format($product->price, 2) }}</td>

                                <td class="border border-gray-300 p-2">
                                    @if (is_array($product->sizes))
                                        {{ implode(', ', $product->sizes) }}
                                    @elseif (is_string($product->sizes))
                                        {{ $product->sizes }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="border border-gray-300 p-2">
                                    {{ $product->description }}
                                </td>

                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ url('editproducts/' . $product->id) }}"
                                       class="text-blue-500"
                                       title="Edit Product">
                                        <i class="bi bi-pencil cursor-pointer"></i>
                                    </a>

                                    <form action="{{ url('productlist/' . $product->id) }}"
                                          method="POST"
                                          style="display: inline"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-black" title="Delete Product">
                                            <i class="bi bi-trash cursor-pointer"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($products->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 p-4">
                                    No products found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
