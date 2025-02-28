<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Document</title>
</head>

<body class="flex items-center justify-center h-screen">
    <form action="" class="bg-white p-6 rounded-lg  w-[24rem]   " {{ route('createPassword') }}  method="POST">
      
            <h2 class="text-lg font-semibold mb-4 text-center">Create new password</h2>

            <div class="mt-3">
                <label for="code" class="block text-sm text-gray-700">Password</label>
                <input type="text" id="code" name="code" required placeholder="Enter your password"
                    class="w-full mt-1 p-2 border border-black rounded-md text-sm focus:ring focus:ring-gray-200">
                
            </div>

            <div class="mt-3">
                <label for="code" class="block text-sm text-gray-700">Confirm password</label>
                <input type="text" id="code" name="code" required placeholder="Enter your password"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md text-sm focus:ring focus:ring-gray-200">
            </div>

            <button type="submit"
                class="w-full bg-black text-white py-2 rounded-md text-sm font-semibold hover:bg-gray-800  transition mt-6">
                Done
            </button>

    </form>
</body>

</html>
