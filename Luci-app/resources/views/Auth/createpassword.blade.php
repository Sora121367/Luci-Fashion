
<x-layout>
    <div class="flex items-center justify-center h-screen">
    <form action="{{ route('createPassword') }}" method="POST" class="bg-white p-6 rounded-lg w-[24rem]">
        @csrf
         
        <h2 class="text-lg font-semibold mb-4 text-center">Create new password</h2>
    
        <!-- Hidden input for email -->
        <input type="hidden" name="email" value="{{ request()->query('email') }}">
    
        <div class="mt-3">
            <label for="password" class="block text-sm text-gray-700">Password</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password"
                class="w-full mt-1 p-2 border border-black rounded-md text-sm focus:ring focus:ring-gray-200">
        </div>
    
        <div class="mt-3">
            <label for="password_confirmation" class="block text-sm text-gray-700">Confirm password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm password"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md text-sm focus:ring focus:ring-gray-200">
        </div>
    
        <button type="submit"
            class="w-full bg-black text-white py-2 rounded-md text-sm font-semibold hover:bg-gray-800 transition mt-6">
            Done
        </button>
    </form>
    
    
</div>
</x-layout>

