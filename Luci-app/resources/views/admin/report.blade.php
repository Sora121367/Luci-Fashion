<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-2xl font-bold mb-4">User Reports</h2>

            <div class="bg-white p-6 rounded shadow-lg">
                <table class="w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-300">
                            <th class="border p-2">Issue Title</th>
                            <th class="border p-2">Description</th>
                            <th class="border p-2">Category</th>
                            <th class="border p-2">Priority</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Submitted On</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Data -->
                        <tr class="bg-gray-100">
                            <td class="border p-2">Login Issue</td>
                            <td class="border p-2">User unable to log in.</td>
                            <td class="border p-2">Bug</td>
                            <td class="border p-2 text-red-500">High</td>
                            <td class="border p-2 text-green-500">Resolved</td>
                            <td class="border p-2">2025-05-09</td>
                            <td class="border p-2">
                                <button class="bg-black text-white px-4 py-1 rounded-md hover:bg-gray-700">Mark as Pending</button>
                            </td>
                        </tr>
                        <tr class="bg-gray-100">
                            <td class="border p-2">Feature Request</td>
                            <td class="border p-2">Request for dark mode.</td>
                            <td class="border p-2">Feature Request</td>
                            <td class="border p-2 text-yellow-500">Medium</td>
                            <td class="border p-2 text-red-500">Pending</td>
                            <td class="border p-2">2025-05-08</td>
                            <td class="border p-2">
                                <button class="bg-gray-900 text-white px-3 py-1 rounded-md hover:bg-gray-700">Mark as Resolved</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>