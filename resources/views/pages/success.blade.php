<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <script src="{{asset('assets/script/tailwind.js')}}"></script>
    <style>
        .checkmark {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: dash 1s ease-in-out forwards;
        }

        @keyframes dash {
            to {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <svg class="mx-auto mb-4" width="100" height="100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="10" stroke="#34D399" stroke-width="2"/>
            <path class="checkmark" d="M6 12l4 4 8-8" stroke="#34D399" stroke-width="2" fill="none"/>
        </svg>
        <h1 class="text-3xl font-bold text-green-600 mb-4">Order Successful!</h1>
        <p class="text-gray-700 mb-6">Thank you for your purchase. Your order has been placed successfully and will be shipped soon.</p>
        <p class="text-gray-700 mb-6">Order Reference Number: <span class="font-bold">#{{session('ref_no')}}</span></p>
        <div class="flex justify-center space-x-4">
            <a href="/" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Return to Homepage</a>
        </div>
    </div>
</body>
</html>
