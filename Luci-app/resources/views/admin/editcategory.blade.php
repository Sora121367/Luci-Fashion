<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editcategory - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')


        <div class="flex justify-center">
            <div class="bg-white p-6 rounded shadow w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4">Edit Category</h2>

                <form action="{{ url('updatecategory/'.$category->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-1">Name</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Parent Name</label>
                        <input type="text" name="parent_id" value="{{ $category->parent_id }}" class="w-full border rounded px-3 py-2">
                    </div>
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded">Update</button>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
