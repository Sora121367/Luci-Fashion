<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luci-Fashion</title>
    @vite(['resources/css/app.css']) {{-- Make sure this is included --}}
    @livewireStyles

</head>

<body>
    <nav class="fixed w-full shadow-md flex justify-between items-center py-4 px-16  z-50 bg-white ">
        <ul class="flex space-x-4 text-black text-xl">
            <a href="/home-user">
                <li class="hover:text-gray-500">HOME</li>
            </a>
            <a href="/men-products">
                <li class="hover:text-gray-500">MEN</li>
            </a>
            <a href="/women-products">
                <li class="hover:text-gray-500">WOMEN</li>
            </a>
            <a href="/home-user">
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
            <ul class="flex space-x-4">

                @guest
                    <a href="{{ route('login.post') }}" class="text-black text-xl font-semibold">Login</a>
                    <a href="{{ route('register.post') }}" class="text-black text-xl font-semibold">Register</a>
                @endguest
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <!-- Profile Icon -->
                        <button @click="open = !open" class="flex items-center space-x-2">
                            <img src="{{ asset('web-images/profile.png') }}" alt="Profile Icon"
                                class="w-8 h-8 rounded-full border border-gray-300" />
                            <span class="text-black text-xl font-semibold">{{ Auth::user()->Lastname }}</span>
                        </button>

                        <!-- Slide-out Sidebar -->
                        <div x-show="open" @click.away="open = false"
                            x-transition:enter="transition transform duration-300"
                            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                            x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0"
                            x-transition:leave-end="translate-x-full"
                            class="fixed top-0 right-0 w-64 h-full bg-white shadow-lg z-50 p-6">
                            <h2 class="text-2xl font-bold mb-4">Profile</h2>
                            <p class="text-gray-700 mb-2">Name: {{ Auth::user()->Lastname }}</p>
                            <p class="text-gray-700 mb-4">Email: {{ Auth::user()->email }}</p>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
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
