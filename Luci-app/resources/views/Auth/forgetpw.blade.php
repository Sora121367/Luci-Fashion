<x-layout>
   <div class="relative flex items-center justify-center min-h-screen bg-gray-100 pt-20">

        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
            <h2 class="mb-6 text-2xl font-semibold text-center text-gray-800">Forgot Password</h2>

            @if(session('error'))
                <p class="mb-4 text-sm text-red-600">{{ session('error') }}</p>
            @endif

            @if(session('success'))
                <p class="mb-4 text-sm text-green-600">{{ session('success') }}</p>
            @endif

            <form action="{{ route('forgetpassword.post') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Enter your email" 
                        required 
                        class="w-full px-4 py-2 text-sm border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 text-white transition bg-blue-600 rounded-md hover:bg-blue-700"
                    >
                        Send Reset Code
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
