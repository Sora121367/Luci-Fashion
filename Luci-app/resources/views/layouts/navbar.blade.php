<nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <div class="flex items-center">
        <img src="web-images/logo.png" alt="Logo" class="w-20 h-10 mr-3">
        <h1 class="text-xl font-semibold">Dashboard</h1>
    </div>

    <div class="flex items-center space-x-4">
        <input type="search" placeholder="Search" class="border rounded-md px-3 py-1 focus:outline-none">
        <button class="bg-gray-400 text-white px-4 py-1 rounded-md hover:bg-gray-500">Search</button>
         
      {{-- Use Livewire component --}}
      @livewire('admin-notifications')
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
