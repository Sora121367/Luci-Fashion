<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Page Content (Logout Confirmation) -->
        <main class="flex-1 p-6 flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md text-center" role="dialog" aria-modal="true">
                <h2 class="text-2xl font-semibold mb-6">Are you sure you want to log out?</h2>
                <p class="text-sm text-gray-600 mb-6">You will be logged out and redirected to the login page.</p>
                <div class="flex justify-center gap-6">
                    <!-- Cancel Button -->
                    <a href="/dashboard" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-md hover:bg-gray-400">Cancel</a>

                    <!-- Confirm Logout Button as POST -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-700">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
