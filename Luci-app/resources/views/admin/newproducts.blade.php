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

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

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
                        <label class="block font-medium">Main Category:</label>
                        <select id="mainCategory" class="border border-gray-400 w-full px-3 py-2 rounded-md">
                            <option value="">Select Main Category</option>
                            @foreach($mainCategories as $main)
                                <option value="{{ $main->id }}">{{ $main->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub-Category -->
                    <div class="mb-4">
                        <label class="block font-medium">Sub-Category:</label>
                        <select name="category_id" id="subCategory" class="border border-gray-400 w-full px-3 py-2 rounded-md" required>
                            <option value="">Select Sub-Category</option>
                            @foreach($subCategories as $sub)
                                <option value="{{ $sub->id }}" data-parent="{{ $sub->parent_id }}">{{ $sub->name }}</option>
                            @endforeach
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

                    <!-- Product Image -->
                    <div class="mb-4">
                        <label class="block font-medium">Product Image:</label>
                        <input type="file" name="image" id="productImage" class="border border-gray-400 w-full px-3 py-2 rounded-md" onchange="previewImage(event)">
                        
                        <!-- Image Preview -->
                        <div id="imagePreviewContainer" class="mt-4">
                            <img id="imagePreview" src="#" alt="Image Preview" class="hidden w-48 h-48 object-cover rounded border" />
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">Save Product</button>
                </form>
            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        // Handle sub-category filtering
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

        // Image preview
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('imagePreview');

            reader.onload = function () {
                imagePreview.src = reader.result;
                imagePreview.classList.remove('hidden');
            };

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</body>
</html>
