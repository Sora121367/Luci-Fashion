<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewCategory - Admin Dashboard</title>
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
        <main class="flex-1 p-6 flex justify-center items-center">
            <div class="bg-white w-full max-w-md p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-center">Add New Category</h2>
                <form action="{{ url('savecategory') }}" method="POST">
                    @csrf

                    <!-- Main Category -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <!-- Parent Category Dropdown -->
                    <div class="mb-4">
                        <label for="parent_id" class="block text-gray-700 font-semibold mb-2">Parent Category</label>
                        <select name="parent_id" id="parent_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- None --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex justify-between items-center">
                        <button type="submit" class="bg-black text-white px-5 py-2 rounded-md hover:bg-gray-700">Save</button>
                    </div>
                </form>

            </div>
        </main>
    </div>

</body>
</html>