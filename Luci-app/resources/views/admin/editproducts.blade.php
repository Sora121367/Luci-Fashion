<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">

    @include('layouts.navbar')

    <div class="flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Edit Product</h2>
                <form action="{{ url('updateproducts/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label class="block font-medium">Product Name:</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                    </div>

                    <!-- Main Category -->
                    <div class="mb-4">
                        <label class="block font-medium">Main Category:</label>
                        <select id="mainCategory" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                            <option value="">Select Main Category</option>
                            @foreach($mainCategories as $main)
                                <option value="{{ $main->id }}" {{ $main->id == $selectedMainCategoryId ? 'selected' : '' }}>
                                    {{ $main->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub-Category -->
                    <div class="mb-4">
                        <label class="block font-medium">Sub-Category:</label>
                        <select name="category_id" id="subCategory" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                            <option value="">Select Sub-Category</option>
                            @foreach($subCategories as $sub)
                                <option value="{{ $sub->id }}" data-parent="{{ $sub->parent_id }}" {{ $sub->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $sub->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label class="block font-medium">Price:</label>
                        <input type="text" name="price" value="{{ $product->price }}" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                    </div>

                    <!-- Sizes -->
                    <div class="mb-4">
                        <label class="block font-medium">Choose Size:</label>
                        <div class="space-y-2">
                            @php
                                $selectedSizes = json_decode($product->sizes, true) ?? [];
                            @endphp
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" name="sizes[]" value="{{ $size }}"
                                        class="form-checkbox h-5 w-5 text-gray-600"
                                        {{ in_array($size, $selectedSizes) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $size }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block font-medium">Description:</label>
                        <textarea name="description" class="border border-gray-400 w-full px-3 py-2 rounded-md" rows="4">{{ $product->description }}</textarea>
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label class="block font-medium">Current Image:</label>
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="w-32 h-32 object-cover mb-2" alt="Product Image">
                        <label class="block font-medium">Change Image:</label>
                        <input type="file" name="image" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                    </div>

                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">Update Product</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        const mainCategory = document.getElementById('mainCategory');
        const subCategory = document.getElementById('subCategory');
        const originalOptions = Array.from(subCategory.options);

        mainCategory.addEventListener('change', () => {
            const selectedMain = mainCategory.value;
            subCategory.innerHTML = '<option value="">Select Sub-Category</option>';
            originalOptions.forEach(option => {
                if (option.dataset.parent === selectedMain) {
                    subCategory.appendChild(option);
                }
            });
        });

        // Trigger filtering on page load
        window.addEventListener('DOMContentLoaded', () => {
            const selectedMain = mainCategory.value;
            subCategory.innerHTML = '<option value="">Select Sub-Category</option>';
            originalOptions.forEach(option => {
                if (option.dataset.parent === selectedMain || option.value === "{{ $product->category_id }}") {
                    subCategory.appendChild(option);
                }
            });
        });
    </script>
</body>
</html>
