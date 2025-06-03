<x-layout>
    <div class="flex p-6 items-center justify-center h-screen">
        <form class="bg-white p-6 rounded-lg shadow-md w-[30rem]" method="POST" action="{{ route('login.post') }}">

            @csrf

            <!-- Navigation Links -->
            <div class="flex items-center gap-4 text-center mb-4">
                <a href="{{ route('login.post') }}"
                    class="text-xl font-semibold {{ request()->routeIs('login.post') ? 'text-gray-500' : 'hover:text-gray-400' }}">Login</a>
                <a href="{{ route('register.post') }}"
                    class="text-md font-medium {{ request()->routeIs('register.post') ? 'text-gray-500' : 'hover:text-gray-400' }}">Register</a>
            </div>

            <div class="p-3">
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="block text-sm text-gray-700">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-md text-sm focus:ring focus:ring-gray-200"
                        required autocomplete="email">
                    @if ($errors->has('email'))
                        <span class="text-red-500 text-sm">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <!-- Password Field with toggle eye -->
                <div class="mb-5" x-data="{ show: false }">
                    <label for="password" class="block text-sm text-gray-700">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password"
                            class="w-full mt-1 p-3 border border-gray-300 rounded-md text-sm focus:ring focus:ring-gray-200 pr-10"
                            required autocomplete="current-password">
                        <button type="button" @click="show = !show"
                            class="absolute top-1/2 right-3 transform -translate-y-1/2 text-gray-500 focus:outline-none">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.985 9.985 0 012.442-3.61m2.572-2.112A9.985 9.985 0 0112 5c4.477 0 8.267 2.943 9.542 7a9.99 9.99 0 01-4.134 5.162M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-red-500 text-sm">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

            </div>

            <!-- Login Button -->
            <button type="submit"
                class="w-full bg-black text-white py-3 rounded-md text-sm font-semibold hover:bg-gray-800 transition">
                Login
            </button>

            <!-- Forgot Password -->
            <div class="mt-3 text-center">
                <a href="{{ route('forgetpassword.post') }}" class="text-sm text-blue-500 hover:underline">Forgot
                    password?</a>
            </div>

            <!-- OR Section -->
            <div class="my-4 flex flex-col items-center">
                <p class="text-sm text-gray-500">Or</p>
                <a href="{{ route('google.redirect') }}"
                    class="w-full bg-gray-100 px-4 py-3 rounded-md text-sm font-semibold hover:bg-gray-300 transition mt-2 text-center">
                    Continue with Google
                </a>
            </div>

            <!-- Register Section -->
            <div class="text-center mt-3">
                <p class="text-sm text-gray-700">Not yet an account?
                    <a href="{{ route('register.post') }}" class="text-blue-500 hover:underline">Register</a>
                </p>
            </div>
        </form>
    </div>

</x-layout>
