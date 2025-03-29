<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentication</title>
    @vite(['resources/css/app.css'])
</head>

<body class="flex p-6 items-center justify-center h-screen bg-gray-100">
    <form class="bg-white p-6 rounded-lg shadow-md w-[24rem]" method="POST" action="{{ route('login.post') }}">

        @csrf

        <!-- Navigation Links -->
        <div class="flex items-center gap-4 text-center mb-4">
            <a href="{{ route('login.post') }}" class="text-xl font-semibold {{ request()->routeIs('login.post') ? 'text-gray-500' : 'hover:text-gray-400' }}">Login</a>
            <a href="{{ route('register.post') }}" class="text-md font-medium {{ request()->routeIs('register.post') ? 'text-gray-500' : 'hover:text-gray-400' }}">Register</a>
        </div>

        <div class="p-3">
            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="block text-sm text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md text-sm focus:ring focus:ring-gray-200"
                    required autocomplete="email">
                @if($errors->has('email'))
                    <span class="text-red-500 text-sm">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="block text-sm text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md text-sm focus:ring focus:ring-gray-200"
                    required autocomplete="current-password">
                @if($errors->has('password'))
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
            <a href="{{ route('forgetpassword.post') }}" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
        </div>

        <!-- OR Section -->
        <div class="my-4 flex flex-col items-center">
            <p class="text-sm text-gray-500">Or</p>
            <a href="{{ route('google.redirect') }}" class="w-full bg-gray-100 px-4 py-3 rounded-md text-sm font-semibold hover:bg-gray-300 transition mt-2 text-center">
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
</body>

</html>