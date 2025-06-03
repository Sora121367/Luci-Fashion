<x-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="max-w-md w-full p-6 bg-white shadow-lg rounded-lg">
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

            <form method="POST" action="{{ route('verify.code') }}">
                @csrf

                <label class="block text-center text-gray-700 font-semibold mb-4">Verification Code:</label>

                <div class="flex justify-between space-x-2 mb-4">
                    @for ($i = 0; $i < 6; $i++)
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

    <script>
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

        function combineCode() {
            const inputs = document.querySelectorAll('input[name="code[]"]');
            const combined = Array.from(inputs).map(i => i.value).join('');
            document.getElementById('code_combined').value = combined;
        }
    </script>
</x-layout>
