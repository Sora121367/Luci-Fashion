<x-layout>
    <div class="max-w-xl mx-auto py-16 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Access Denied</h1>
        <p class="text-gray-600 mb-6">
            You need to complete at least one purchase before you can submit a report.
        </p>
        <a href="{{ route('home') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Back to Home
        </a>
    </div>
</x-layout>
