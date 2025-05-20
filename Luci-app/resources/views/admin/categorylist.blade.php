<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Category List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Page Content -->
        <main class="flex-1 p-6 flex gap-6">
            <!-- Categories Section -->
            <div class="border border-gray-400 bg-white p-6 rounded-lg shadow-md w-full">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-semibold">Category List</h2>
                    <a href="{{ url('newcategory') }}" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">+ Add New Category</a>
                </div>
                
                <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 border-b">
                            <th class="px-4 py-2 text-left">Main Category</th>
                            <th class="px-4 py-2 text-left">Sub-Category</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $category->name }}</td>
                                <td class="px-4 py-2">{{ $category->parent_id }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ url('editcategory/'.$category->id) }}" class="text-blue-500"><i class="bi bi-pencil cursor-pointer"></i></a>

                                    <form action="{{ url('deletecategory/'.$category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')" class="text-black">
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
