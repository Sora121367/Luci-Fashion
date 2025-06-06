<!-- resources/views/layouts/navbar.blade.php -->
<nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <div class="flex items-center">
        <img src="web-images/logo.png" alt="Logo" class="w-20 h-10 mr-3">
        <h1 class="text-xl font-semibold">Dashboard</h1>
    </div>
    <div class="flex items-center space-x-4">
        <input type="search" placeholder="Search" class="border rounded-md px-3 py-1 focus:outline-none">
        <button class="bg-gray-400 text-white px-4 py-1 rounded-md hover:bg-gray-500">Search</button>
        {{-- Notifications --}}
        <div class="relative">
            <button id="notificationBtn" class="relative focus:outline-none">
                <i class="bi bi-bell text-xl cursor-pointer"></i>
                @if (auth('admin')->check() && auth('admin')->user()->unreadNotifications->count())
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">
                        {{ auth('admin')->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </button>

            {{-- Dropdown --}}
            <div id="notificationDropdown" class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-md z-50 hidden">
                <div class="p-4 border-b font-semibold">
                    Notifications
                </div>
                <div class="max-h-60 overflow-y-auto">
                    @forelse(auth('admin')->user()->unreadNotifications as $notification)
                        <div class="px-4 py-2 hover:bg-gray-100 border-b text-sm">
                           
                            {{-- <p class="font-medium">{{ $notification->data['message'] ?? 'New Notification' }}</p> --}}
                            <p class="font-medium text-md">New order placed by <span class="font-semibold">{{$notification->data['Firstname']}}</span></p>
                            <p class="text-xs text-gray-500">Order ID: <span class="font-semibold">{{ $notification->data['order_id'] ?? '-' }}</span> </p>
                            <p class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <div class="p-4 text-sm text-gray-500">No new notifications</div>
                    @endforelse
                </div>
                <form method="POST" action="{{ route('notifications.markAllRead') }}" class="text-right p-2">
                    @csrf
                    <button class="text-blue-600 text-sm hover:underline">Mark all as read</button>
                </form>
            </div>
        </div>


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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bell = document.getElementById('notificationBtn');
            const dropdown = document.getElementById('notificationDropdown');

            bell?.addEventListener('click', () => {
                dropdown?.classList.toggle('hidden');
            });

            // Optional: Close when clicking outside
            document.addEventListener('click', function(e) {
                if (!bell.contains(e.target) && !dropdown.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>

</nav>
