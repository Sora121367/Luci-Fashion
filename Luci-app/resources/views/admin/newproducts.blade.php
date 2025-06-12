<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add New Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>
<body class="bg-gray-100">

    @include('layouts.navbar')

    <div class="flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
                <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>
                <form action="{{ route('admin.saveproduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label class="block font-medium">Product Name:</label>
                        <input type="text" name="name" class="border border-gray-400 w-full px-3 py-2 rounded-md" required />
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
                        <input type="text" name="price" class="border border-gray-400 w-full px-3 py-2 rounded-md" required />
                    </div>

                    <!-- Sizes -->
                    <label class="block font-semibold mb-2">Sizes</label>
                    <div class="flex gap-4 mb-4">
                        @php
                            $allSizes = ['S', 'M', 'L', 'XL'];
                            $selectedSizes = old('sizes', []);
                        @endphp

                        @foreach ($allSizes as $size)
                            <label class="inline-flex items-center">
                                <input 
                                    type="checkbox" 
                                    name="sizes[]" 
                                    value="{{ $size }}" 
                                    {{ in_array($size, $selectedSizes) ? 'checked' : '' }}
                                    class="form-checkbox text-indigo-600"
                                >
                                <span class="ml-2">{{ $size }}</span>
                            </label>
                        @endforeach
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block font-medium">Description:</label>
                        <textarea name="description" class="border border-gray-400 w-full px-3 py-2 rounded-md" rows="4"></textarea>
                    </div>

                    <!-- Images -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Upload Images (Max 4)</label>

                        <!-- Main Image -->
                        <label class="block mb-1 font-semibold">Main Image</label>
                        <input type="file" name="image_path" accept="image/*" class="mb-4" onchange="previewMainImage(event)" />
                        <img id="mainImagePreview" class="w-48 h-48 object-cover rounded border hidden mb-4" alt="Main Image Preview">


                        <label class="block mb-1 font-semibold">Related Images</label>
                        <input type="file" name="images[]" accept="image/*" class="border border-gray-400 w-full px-3 py-2 rounded-md mb-2" onchange="previewImage(event, 0)">
                        <input type="file" name="images[]" accept="image/*" class="border border-gray-400 w-full px-3 py-2 rounded-md mb-2" onchange="previewImage(event, 1)">
                        <input type="file" name="images[]" accept="image/*" class="border border-gray-400 w-full px-3 py-2 rounded-md mb-2" onchange="previewImage(event, 2)">

                        <!-- Image preview container -->
                        <div id="imagePreviewContainer" class="mt-4 flex gap-4 flex-wrap">
                            <img id="preview0" class="w-48 h-48 object-cover rounded border hidden" alt="Preview Image 1">
                            <img id="preview1" class="w-48 h-48 object-cover rounded border hidden" alt="Preview Image 2">
                            <img id="preview2" class="w-48 h-48 object-cover rounded border hidden" alt="Preview Image 3">
                        </div>    
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">Save Product</button>
                </form>
            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        // Filter sub-categories by main category
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
        // Preview main image
        function previewMainImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('mainImagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }

        // Preview multiple images
        function previewImage(event, index) {
            const file = event.target.files[0];
            const preview = document.getElementById(`preview${index}`);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
