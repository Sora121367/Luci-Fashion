<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <h1 class="text-2xl font-semibold mb-6">Customer Feedbacks</h1>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">User</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Title</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Reason</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Comments</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Date</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($feedbacks as $feedback)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $feedback->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $feedback->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $feedback->reason }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $feedback->comments }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $feedback->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.report.delete', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-1 text-sm rounded hover:bg-red-600">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No feedbacks found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
