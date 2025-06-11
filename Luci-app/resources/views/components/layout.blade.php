<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luci-Fashion</title>
    @vite(['resources/css/app.css']) {{-- Make sure this is included --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    @livewireStyles

</head>

<body>
    <nav class="fixed w-full shadow-md flex justify-between items-center py-4 px-16  z-50 bg-white ">
        <ul class="flex space-x-4 text-black text-xl">
            <a href="/">
                <li class="hover:text-gray-500">HOME</li>
            </a>
            <a href="/men-products">
                <li class="hover:text-gray-500">MEN</li>
            </a>
            <a href="/women-products">
                <li class="hover:text-gray-500">WOMEN</li>
            </a>
            <a href="/contact-us">
                <li class="hover:text-gray-500">CONTACT US</li>
            </a>
        </ul>
        <div class="flex items-center space-x-4">
            <img src="{{ asset('web-images/luci-logo.jpg') }}" alt="Logo Image" class="w-25 h-12" />
            <input type="text" placeholder="Search" class="border rounded-lg p-2">
            <ul class="flex space-x-2">
                <a href="/user-favorite">
                    <img src="{{ asset('web-images/love.jpg') }}" alt="Favorite Button" class="w-6 h-6">
                </a>
                <livewire:notifications />
                <livewire:cart-modal />
            </ul>
            <ul class="flex space-x-6 items-center">
                @guest
                    <li>
                        <a href="{{ route('login.post') }}"
                            class="relative text-black text-lg font-semibold hover:text-gray-600 transition-all duration-300 group">
                            Login
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-black transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register.post') }}"
                            class="bg-black hover:bg-gray-800 text-white text-lg font-semibold px-6 py-2.5 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-lg border-2 border-black hover:border-gray-800">
                            Register
                        </a>
                    </li>
                @endguest

                @auth
                    <li x-data="{ open: false }" class="relative">
                        <!-- Profile Button -->
                        <button @click="open = !open"
                            class="flex items-center space-x-3 bg-white hover:bg-gray-50 px-4 py-2.5 rounded-full transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
                            <div class="relative">
                                <img src="{{ asset('web-images/profile.png') }}" alt="Profile Icon"
                                    class="w-10 h-10 rounded-full transition-colors duration-300" />
                            </div>
                            <span
                                class="text-black text-lg font-semibold group-hover:text-gray-600 transition-colors duration-300">
                                {{ Auth::user()->Lastname }}
                            </span>
                            <svg class="w-5 h-5 text-black group-hover:text-gray-600 transition-all duration-300 transform group-hover:rotate-180"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <!-- Enhanced Slide-out Sidebar -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition transform duration-500 ease-out"
                            x-transition:enter-start="translate-x-full opacity-0"
                            x-transition:enter-end="translate-x-0 opacity-100"
                            x-transition:leave="transition transform duration-300 ease-in"
                            x-transition:leave-start="translate-x-0 opacity-100"
                            x-transition:leave-end="translate-x-full opacity-0"
                            class="fixed top-0 right-0 w-80 h-full bg-white shadow-2xl z-50 overflow-hidden border-l-4 border-black">

                            <!-- Sidebar Header -->
                            <div class="bg-black p-6 text-white">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-2xl font-bold">Profile</h2>
                                    <button @click="open = false"
                                        class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-4 flex items-center space-x-3">
                                    <img src="{{ asset('web-images/profile.png') }}" alt="Profile"
                                        class="w-16 h-16 rounded-full border-3 border-white shadow-lg" />
                                    <div>
                                        <p class="text-lg font-semibold">Welcome back!</p>
                                        <p class="text-gray-300 text-sm">{{ Auth::user()->Lastname }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar Content -->
                            <div class="p-6 space-y-6">
                                <!-- User Info Card -->
                                <div
                                    class="bg-gray-50 rounded-xl p-5 border-2 border-gray-200 hover:border-black transition-colors duration-300">
                                    <h3 class="text-lg font-semibold text-black mb-3 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-black" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        Account Details
                                    </h3>
                                    <div class="space-y-2">
                                        <p class="text-gray-700 flex items-center">
                                            <span class="font-medium text-black w-16">Name:</span>
                                            {{ Auth::user()->Lastname }}
                                        </p>
                                        <p class="text-gray-700 flex items-center">
                                            <span class="font-medium text-black w-16">Email:</span>
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="space-y-3">
                                    <a href="/view-order-history"
                                        class="flex items-center space-x-3 p-4 bg-gray-50 hover:bg-gray-100 rounded-xl border-2 border-gray-200 hover:border-black transition-all duration-300 group">
                                        <div
                                            class="w-10 h-10 bg-black group-hover:bg-gray-800 rounded-lg flex items-center justify-center transition-colors duration-300">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p
                                                class="font-semibold text-black group-hover:text-gray-700 transition-colors duration-300">
                                                Order History</p>
                                            <p class="text-sm text-gray-600">View your past orders</p>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-black transition-colors duration-300 ml-auto"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>

                                <!-- Logout Button -->
                                <div class="pt-4 border-t-2 border-gray-200">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-black hover:bg-gray-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center space-x-2 border-2 border-black hover:border-gray-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Decorative Elements -->
                            <div class="absolute top-0 left-0 w-full h-2 bg-black"></div>
                            <div
                                class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-black via-gray-500 to-black">
                            </div>
                        </div>

                        <!-- Backdrop Overlay -->
                        <div x-show="open" @click="open = false" x-transition:enter="transition-opacity duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition-opacity duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40">
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <main class="relative pt-20">
        {{ $slot }}

    </main>
    <footer class="bg-black text-white ">
        <div class="flex gap-10 py-10 px-20 justify-between">
            <div class="flex flex-col gap-2">
                <h3>FOLLOW US</h3>
                <a href="facebook.com" class="flex">
                    <img src="{{ asset('web-images/facebook.jpg') }}" alt="Facebook Logo">
                    <p>Facebook</p>
                </a>
                <a href="facebook.com" class="flex">
                    <img src="{{ asset('web-images/instagram.png') }}" alt="Instagram Logo" class=" w-6 h-6">
                    <p>Instagram</p>
                </a>
                <a href="facebook.com" class="flex">
                    <img src="{{ asset('web-images/youtube.png') }}" alt="Youtube Logo" class="w-6 h-6 ">
                    <p>Youtube</p>
                </a>
            </div>
            <div>
                <h3>CUSTOMER SERVICES</h3>
                <a href="facebook.com" class="flex">
                    <img src="{{ asset('web-images/privacy.png') }}" class="w-6 h-6" alt="Telegram Logo">
                    <p>Privacy & Policy</p>
                </a>
            </div>
            <div>
                <h3>CONTACT US</h3>
                <a href="facebook.com" class="flex">
                    <img src="{{ asset('web-images/phone-call.png') }}" class="w-6 h-6" alt="Facebook Logo">
                    <p>+855 78219291</p>
                </a>
                <a href="facebook.com" class="flex">
                    <img src="{{ asset('web-images/mail.png') }}" alt="Instagram Logo">
                    <p>Leomheng1@gmail.com</p>
                </a>
                <a href="facebook.com" class="flex">
                    <img src="{{ asset('web-images/telegram-white.png') }}" class="w-6 h-6" alt="Youtube Logo">
                    <p>Telegram</p>
                </a>
            </div>
            <div class="">
                <h3 class="py-2">WE ACCEPT</h3>
                <div class="flex gap-4">
                    <img src="{{ asset('web-images/aba.jpg') }}" class="rounded-md" alt="ABA Logo">
                    <img src="{{ asset('web-images/ac.jpg') }}" class="rounded-md" alt="AC Logo">
                </div>
            </div>
        </div>
        <hr class="border-t-2 border-gray-300 ml-18 pb-2">
        <p class="text-right p-2">&copy; <span>2025</span> Luci. All rights reserved.</p>
    </footer>
    @livewireScripts
</body>

</html>
