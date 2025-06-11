<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ $title ?? 'Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        function toggleProducts() {
            var productList = document.getElementById('productList');
            productList.classList.toggle('hidden');
        }
    </script>

     @vite('resources/js/app.js')
    @livewireStyles
</head>

<body class="bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="{{ asset('web-images/logo.png') }}" alt="Logo" class="w-20 h-10 mr-3">
            <h1 class="text-xl font-semibold">Admin Panel</h1>
        </div>
        <div class="flex items-center space-x-4">
            <input type="search" placeholder="Search" class="border rounded-md px-3 py-1 focus:outline-none">
            <button class="bg-gray-400 text-white px-4 py-1 rounded-md hover:bg-gray-500">Search</button>
            <i class="bi bi-bell text-xl cursor-pointer"></i>

            @guest('admin')
                <div class="relative">
                    <button class="flex items-center space-x-2">
                        <img src="web-images/adminpro.png" alt="User" class="w-8 h-8 rounded-full">
                        <span>Admin</span>
                    </button>
                </div>
            @endguest

            @auth('admin')
                <div class="relative">
                    <button class="flex items-center space-x-2">
                        <img src="{{ asset('web-images/adminpro.png') }}" alt="Admin" class="w-8 h-8 rounded-full">
                        <span>{{ Auth::guard('admin')->user()->name }}</span>
                    </button>
                </div>
            @endauth


        </div>
    </nav>

    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-60 min-h-screen bg-gray-300 p-4">
            <ul class="space-y-2">
                <li><a href="/dashboard" class="flex items-center p-3 hover:bg-gray-400 rounded-md"><i
                            class="bi bi-house-door mr-2"></i> Dashboard</a></li>
                <li><a href="{{ url('productlist') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md"><i
                            class="bi bi-box-seam mr-2"></i> Product List</a></li>
                <li><a href="{{ url('categories') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md"><i
                            class="bi bi-tags mr-2"></i> Categories</a></li>
                <li><a href="{{ url('sales') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md"><i
                            class="bi bi-cart mr-2"></i> Sales</a></li>
                <li><a href="{{ url('customers') }}" class="flex items-center p-3 hover:bg-gray-400 rounded-md"><i
                            class="bi bi-person-lines-fill mr-2"></i> Customers</a></li>
                <li><a href="/settings" class="flex items-center p-3 hover:bg-gray-400 rounded-md"><i
                            class="bi bi-gear mr-2"></i> Settings</a></li>
                {{-- <li><a href="/logout" class="flex items-center p-3 hover:bg-gray-400 rounded-md"><i class="bi bi-box-arrow-right mr-2"></i> Logout</a></li> --}}

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                        Logout
                    </button>
                </form>
            </ul>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
   
     @livewireScripts
</body>

</html>
