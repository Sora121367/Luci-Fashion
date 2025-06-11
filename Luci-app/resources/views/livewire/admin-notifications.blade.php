<div class="relative">
    <button wire:click="openModal" class="relative focus:outline-none">
        <i class="bi bi-bell text-xl cursor-pointer"></i>
        @if (auth('admin')->check() && auth('admin')->user()->unreadNotifications->count())
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">
                {{ auth('admin')->user()->unreadNotifications->count() }}
            </span>
        @endif
    </button>

    <div wire:poll.5000ms>
        @if ($showModal)
            <div class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-md z-50">
                <div class="p-4 border-b font-semibold">
                    Notifications
                </div>
                <div class="max-h-60 overflow-y-auto">
                    @forelse(auth('admin')->user()->unreadNotifications as $notification)
                        @php
                            $diffInMinutes = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();
                        @endphp

                        <div class="px-4 py-2 hover:bg-gray-100 border-b text-sm">
                            <p class="font-medium text-md">
                                New order placed by 
                                <span class="font-semibold">{{ $notification->data['Firstname'] }}</span>
                            </p>
                            <p class="text-xs text-gray-500">
                                Order ID: 
                                <span class="font-semibold">{{ $notification->data['order_id'] ?? '-' }}</span>
                            </p>
                            <p class="text-xs text-gray-400">
                                @if ($diffInMinutes < 1)
                                    Just now
                                @elseif ($diffInMinutes >1)
                                    {{ $diffInMinutes }}
                                @endif
                            </p>
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
        @endif
    </div>
</div>
