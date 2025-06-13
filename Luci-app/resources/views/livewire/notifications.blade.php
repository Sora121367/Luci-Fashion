<div wire:poll.10s>
    <!-- Notification Icon and Count -->
    <div class="relative">
        <button wire:click="openModal">
            <img src="{{ asset('web-images/notification.jpg') }}" alt="Notifications" class="w-8 h-8">
        </button>
        @if($number_notifications > 0)
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5">
                {{ $number_notifications }}
            </span>
        @endif
    </div>

    @if($showModal)
    <div class="fixed inset-0 flex justify-end z-50">
        <!-- Modal backdrop -->
        <div class="fixed inset-0 bg-black opacity-50" wire:click="closeModal"></div>

        <!-- Modal content -->
        <div class="relative bg-white h-full w-[30%] rounded-l-lg shadow-lg z-10 overflow-y-auto">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-medium">{{ $title }}</h3>
                <button class="text-gray-500 hover:text-gray-700" wire:click="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-4">
                @if ($number_notifications == 0)
                    <div class="text-center space-y-6">
                        <div>
                            <h1 class="text-lg font-semibold">Your bag is empty</h1>
                            <p>Check our products and go shopping!</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <a href="/men-products" class="w-full">
                                <div class="bg-black text-white px-6 py-3 text-center rounded-lg w-full">Shop Men</div>
                            </a>
                            <a href="/women-products" class="w-full">
                                <div class="bg-black text-white px-6 py-3 text-center rounded-lg w-full">Shop Women</div>
                            </a>
                        </div>
                    </div>
                @else
                    <ul class="flex flex-col gap-4">
                        @foreach ($notifications as $index => $notification)
                        <li wire:key="notification-{{ $notification['id'] }}"class="relative border rounded-lg p-3">
                            <div class="flex flex-col gap-3">
                                <h1>Admin</h1>
                                <p>{{ $notification['message'] }}</p>
                                <p class="text-sm text-gray-500">{{ $notification['createdat'] }}</p>
                            </div>

                            <!-- Remove button -->
                            <button wire:click="removeNotification({{ $index }})" class="absolute top-2 right-2">
                                <img src="{{ asset('web-images/delete.png') }}" alt="Remove" class="w-6 h-6 hover:opacity-70 transition">
                            </button>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
