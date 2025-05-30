<x-layout>
    <div class="flex items-center justify-center">
    <div class="flex items-center justify-center min-h-screen">
        <div class="max-w-md mx-auto p-6 bg-white shadow-lg rounded-lg">
            @if (session('success'))
                <div class="mb-4 p-2 text-green-700 bg-green-100 border border-green-400 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-2 text-red-700 bg-red-100 border border-red-400 rounded">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('password.verify.post') }}" method="POST" class="space-y-4">
                @csrf
            
                <label for="code" class="block text-center text-gray-700 font-semibold">Verification Code:</label>
                <input type="text" name="code" maxlength="6" required 
                    class="w-full h-16 text-center text-xl border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                >
            
                <button type="submit" 
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Verify
                </button>
            </form>
            
            

        </div>
    </div>



</div>
</x-layout>