<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css'])
</head>
<body class="flex p-6 justify-center h-auto bg-gray-100">

    <form class="bg-white p-6 rounded-lg shadow-md w-[24rem]" method="POST" action="{{ route('register.post') }}">
        @csrf

        <!-- Navigation Links -->
        <div class="flex items-center gap-4 text-center mb-4">
            <a href="{{ route('login.post') }}" class="text-md font-medium hover:text-gray-400">Login</a>
            <a href="{{ route('register.post') }}" class="text-xl font-semibold text-black">Register</a>
        </div>

        <!-- Name Fields -->
        <div class="grid grid-cols-2 gap-2 mb-3">
            <div>
                <label for="fname" class="block text-sm text-gray-700">First Name</label>
                <input type="text" id="Firstname" name="Firstname" placeholder="Enter first name"
                    class="w-full mt-1 p-1.5 border border-gray-300 rounded-md text-sm"
                    required autocomplete="given-name">
                 @if($errors -> has('Firstname'))

                     <span class=" text-red-500">
                        {{$errors -> first('Firstname')}}
                     </span>
                 @endif
                     
             
            </div>
            <div>
                <label for="lname" class="block text-sm text-gray-700">Last Name</label>
                <input type="text" id="lname" name="Lastname" placeholder="Enter last name"
                    class="w-full mt-1 p-1.5 border border-gray-300 rounded-md text-sm"
                    required autocomplete="family-name">
                @error('Lastname')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Contact Details -->
        <div class="mb-3">
            <label for="phone" class="block text-sm text-gray-700">Mobile Number</label>
            <input type="tel" id="phone" name="phonenumber" placeholder="Enter your phone number"
                class="w-full mt-1 p-1.5 border border-gray-300 rounded-md text-sm"
                required autocomplete="tel">
            @error('phonenumber')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="block text-sm text-gray-700">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email"
                class="w-full mt-1 p-1.5 border border-gray-300 rounded-md text-sm"
                required autocomplete="email">
                @if($errors -> has('email'))

                <span class=" text-red-500">
                   {{$errors -> first('email')}}
                </span>
            @endif
        </div>

        <!-- Password Fields -->
        <div class="mb-3">
            <label for="password" class="block text-sm text-gray-700">Password</label>
            <input type="password" id="password" name="password"
                class="w-full mt-1 p-1.5 border border-gray-300 rounded-md text-sm"
                required autocomplete="new-password">
            @error('password')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="block text-sm text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full mt-1 p-1.5 border border-gray-300 rounded-md text-sm"
                required autocomplete="new-password">
            @error('password_confirmation')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Location Section -->
        <div class="grid grid-cols-2 gap-2 mb-3">
            <div>
                <label class="block text-sm text-gray-700">Country</label>
                <input type="text" value="Cambodia" readonly
                    class="w-full p-1.5 border border-gray-300 rounded-md text-sm bg-gray-100">
            </div>
            <div>
                <label for="location" class="block text-sm text-gray-700">City / Province</label>
                <input type="text" id="location" name="city" placeholder="Enter your location"
                    class="w-full p-1.5 border border-gray-300 rounded-md text-sm"
                    required>
                @error('city')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Gender Selection -->
        <div class="mb-3">
            <label class="block text-sm text-gray-700 mb-1">Gender</label>
            <div class="flex items-center gap-3">
                <label class="flex items-center gap-1 text-sm">
                    <input type="radio" name="gender" value="male" required>
                    <span>Male</span>
                </label>
                <label class="flex items-center gap-1 text-sm">
                    <input type="radio" name="gender" value="female" required>
                    <span>Female</span>
                </label>
            </div>
            @error('gender')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-black text-white py-2 rounded-md text-sm hover:bg-gray-800 transition">
            Create Account
        </button>

    </form>

</body>
</html>
