<x-layout>
    <div>
    <form action="" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white p-6 rounded-lg shadow-md w-[24rem]">
            <h2 class="text-lg font-semibold mb-4">Confirm Code</h2>
            
            <label for="code" class="block text-sm text-gray-700">Verification Code</label>
            <input type="text" id="code" name="code" required placeholder="Enter verification code"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md text-sm focus:ring focus:ring-gray-200">

            <button type="button" 
                class="w-full bg-black text-white py-2 rounded-md text-sm font-semibold hover:bg-gray-800 transition mt-4"
            
                Verify
            </button>

        </div>
    </form>
</div>
</x-layout>