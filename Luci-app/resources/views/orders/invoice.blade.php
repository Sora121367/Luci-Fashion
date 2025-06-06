<!-- resources/views/orders/invoice.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $order->id }}</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 py-10">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Logo -->
        <div class="flex justify-center mt-6">
            <img src="{{ asset('/web-images/bow.jpg') }}" alt="Logo" class="h-12">
        </div>

        <!-- Thank You -->
        <div class="text-center mt-4 px-6">
            <h2 class="text-2xl font-semibold">Thanks For Your Order!</h2>
        </div>

        <!-- Order Section -->
        <div class="mt-6 px-6">
             <div class="flex flex-col items-center">
                <h3 class="text-lg font-semibold mb-2">Your order</h3>
            <p class="text-sm text-gray-600 mb-4">{{ $order->created_at->format('l, M d Y \a\t g:i A') }}</p>
             </div>

            <table class="w-full text-sm text-left text-gray-700 mb-4">
                <tbody  >
                    @foreach ($order->items as $item)
                        <tr class="border-t-1">
                            <td class="py-1">Price</td>
                            <td class="py-1 text-right">${{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="border-t-1">
                        <td class="py-1 font-semibold">Subtotal</td>
                        <td class="py-1 text-right">${{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr class="border-t-1">
                        <td class="py-1 font-semibold">Delivery</td>
                        <td class="py-1 text-right">${{ number_format($order->tax, 2) }}</td>
                    </tr>
                    {{-- <tr>
                        <td class="py-1 font-semibold">Other hidden fee</td>
                        <td class="py-1 text-right">${{ number_format($order->fee, 2) }}</td>
                    </tr> --}}
                    <tr class="border-t-4 border-b-4 ">
                        <td class="py-2 font-bold">Total</td>
                        <td class="py-2 text-right font-bold text-black">${{ number_format($order->total_price, 2) }}</td>
                        
                    </tr>
                   

                </tbody>
            </table>
        </div>

        <!-- Shipping & Billing -->
        <div class="px-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">Your details</h3>
            <div class="text-sm text-gray-700 mb-3">
                <p class="font-medium">Shipping to</p>
                {{-- <p>{{ $order->user->name }}</p> --}}
                {{-- <p>{{ $order->user->address }}</p> --}}
                {{-- <p>{{ $order->user->city }}, {{ $order->user->zip }}</p> --}}
            </div>
            <div class="text-sm text-gray-700">
                <p class="font-medium">Billed to</p>
                <p>Visa ending in **** {{ substr($order->card_last4, -4) }}</p>
                <p>Expiring {{ $order->card_expiry }}</p>
            </div>

            <p class="text-xs mt-4 text-gray-500">
                Notice something wrong? <a href="#" class="text-blue-500 underline">Contact our support team</a> and we'll be happy to help.
            </p>
        </div>

        <!-- Referral -->
        <div class="bg-teal-500 text-white text-center py-6">
            <h3 class="text-lg font-semibold mb-2">Tell your friends</h3>
            <p class="text-sm mb-4">Share your unique URL with friends and earn $5 credit when they sign up.</p>
            <div class="flex justify-center space-x-4 mt-2">
                <img src="{{ asset('/web-images/twitter.png') }}" alt="Twitter" class="h-6">
                <img src="{{ asset('/web-images/facebook.png') }}" alt="Facebook" class="h-6">
            </div>
        </div>

        <!-- Account Button -->
        <div class="text-center py-6">
            <a href="#" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">View My Account</a>
            <p class="text-xs text-gray-600 mt-2">Thanks for being a great customer.</p>
        </div>
    </div>
</body>

</html>
