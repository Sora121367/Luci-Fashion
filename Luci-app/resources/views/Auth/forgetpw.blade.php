@php
    $isActive = true;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100" x-data="{ showVerification: false }">

    {{-- Email Input Form --}}
    <form x-show="!showVerification" x-cloak action="{{ route('forgetpassword') }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md w-[24rem]"
        @submit.prevent="showVerification = true">
        @csrf
        <h2 class="text-lg font-semibold mb-4">Reset Password</h2>

        <label for="email" class="block text-sm text-gray-700">E-mail</label>
        <input type="email" id="email" name="email" required placeholder="Enter your phone number"
            class="w-full mt-1 p-2 border border-gray-300 rounded-md text-sm focus:ring focus:ring-gray-200">

        <button type="submit"
            class="w-full bg-black text-white py-2 rounded-md text-sm font-semibold hover:bg-gray-800 transition mt-10">
            Submit
        </button>
    </form>

    
</body>
</html>
