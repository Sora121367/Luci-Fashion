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
              
                <div class="flex justify-between space-x-2 mb-4">
                         @for ($i= 0 ; $i < 6; $i++)
                 <input type="text" name="code[]" maxlength="1" required
                            class="w-12 h-16 text-center text-2xl border rounded focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            oninput="moveFocus(event)" />
                    
                @endfor
                </div>
                  <input type="hidden" name="code_combined" id="code_combined" />
                <button type="submit"
                  onclick="combineCode()" 
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    Verify
                </button>
            </form>
            
            

        </div>
    </div>


</div>

<script>
    function combineCode() {
        const inputs = document.querySelectorAll('input[name="code[]"]');
        const combined = Array.from(inputs).map(i => i.value.trim()).join('');
        document.getElementById('code_combined').value = combined;

        // Optionally log it for debugging:
        // console.log("Combined Code:", combined);

        return true; // allow form to submit
    }

    function moveFocus(event) {
        const input = event.target;
        const value = input.value;
        if (value.length === 1) {
            const nextInput = input.nextElementSibling;
            if (nextInput && nextInput.tagName === 'INPUT') {
                nextInput.focus();
            }
        } else if (value.length === 0) {
            const prevInput = input.previousElementSibling;
            if (prevInput && prevInput.tagName === 'INPUT') {
                prevInput.focus();
            }
        }
    }

    // Optional: auto-focus the first input on page load
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('input[name="code[]"]')?.focus();
    });
</script>

</x-layout>