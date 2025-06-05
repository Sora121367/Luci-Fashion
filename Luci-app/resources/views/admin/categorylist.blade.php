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
        <main class="flex-1 p-6 space-y-8">

            <!-- Header -->
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold">Category List</h2>
                <a href="{{ url('newcategory') }}" class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-700">+ Add New Category</a>
            </div>

            <!-- Main Categories Section -->
            <div class="bg-white p-6 rounded-xl shadow max-w-2xl mx-auto">
                <h3 class="text-xl font-semibold mb-4">Main Categories List</h3>
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mainCategories as $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $category->name }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ url('editcategory/' . $category->id) }}" class="text-blue-500"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ url('deletecategory/' . $category->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="text-red-500"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-2 text-center text-gray-500">No main categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Sub Categories Section -->
            <div class="bg-white p-6 rounded-xl shadow max-w-2xl mx-auto">
                <!-- <h3 class="text-xl font-semibold mb-4">Sub-Categories</h3> -->
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Sub Category</th>
                            <th class="px-4 py-2 text-left">Main Category</th>
                            <th class="px-4 py-2 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subCategories as $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $category->name }}</td>
                                <td class="px-4 py-2">{{ $category->parent->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ url('editcategory/' . $category->id) }}" class="text-blue-500"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ url('deletecategory/' . $category->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')" class="text-red-500"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500">No sub-categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</body>
</html>
