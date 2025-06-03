<x-layout>
    <div class="flex p-6 justify-center items-center h-[100vh]">
        <form class="bg-white p-8 rounded-lg shadow-md w-[30rem] md:w-[36rem]" method="POST" action="{{ route('register.post') }}">
            @csrf

            <!-- Navigation Links -->
            <div class="flex items-center gap-4 text-center mb-6">
                <a href="{{ route('login.post') }}" class="text-lg font-medium hover:text-gray-400">Login</a>
                <a href="{{ route('register.post') }}" class="text-2xl font-semibold text-black">Register</a>
            </div>

            <!-- Name Fields -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="fname" class="block text-base text-gray-700">First Name</label>
                    <input type="text" id="Firstname" name="Firstname" placeholder="Enter first name"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-md text-base"
                        required autocomplete="given-name">
                    @if($errors -> has('Firstname'))
                        <span class="text-red-500 text-sm">{{ $errors -> first('Firstname') }}</span>
                    @endif
                </div>
                <div>
                    <label for="lname" class="block text-base text-gray-700">Last Name</label>
                    <input type="text" id="lname" name="Lastname" placeholder="Enter last name"
                        class="w-full mt-2 p-3 border border-gray-300 rounded-md text-base"
                        required autocomplete="family-name">
                    @error('Lastname')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Contact Details -->
            <div class="mb-4">
                <label for="phone" class="block text-base text-gray-700">Mobile Number</label>
                <input type="tel" id="phone" name="phonenumber" placeholder="Enter your phone number"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-md text-base"
                    required autocomplete="tel">
                @error('phonenumber')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-base text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-md text-base"
                    required autocomplete="email">
                @if($errors -> has('email'))
                    <span class="text-red-500 text-sm">{{ $errors -> first('email') }}</span>
                @endif
            </div>

            <!-- Password Fields -->
            <div class="mb-4">
                <label for="password" class="block text-base text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-md text-base"
                    required autocomplete="new-password">
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-base text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full mt-2 p-3 border border-gray-300 rounded-md text-base"
                    required autocomplete="new-password">
                @error('password_confirmation')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-black text-white py-3 rounded-lg text-base font-semibold hover:bg-gray-800 transition">
                Create Account
            </button>
        </form>
    </div>
</x-layout>
