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
    

    
</body>
</html>
