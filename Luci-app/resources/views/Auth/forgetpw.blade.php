<x-layout>
    <div class="flex items-center justify-center h-screen bg-gray-100" x-data="{ showVerification: false }">

    <div class="container">
        <h2>Forgot Password</h2>
        @if(session('error')) <p class="text-danger">{{ session('error') }}</p> @endif
        @if(session('success')) <p class="text-success">{{ session('success') }}</p> @endif
    
        <form action="{{ route('forgetpassword.post') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Send Reset Code</button>
        </form>
    </div>
    

    
</div>
</x-layout>