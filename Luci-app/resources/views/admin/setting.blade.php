<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100">

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <div class="flex">
        <!-- Include Sidebar -->
        @include('layouts.sidebar')

        <!-- Page Content -->
        <main class="flex-1 p-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6">Settings</h2>

                <!-- Profile Settings Section -->
                <div class="mb-8">
                    <h3 class="text-xl font-medium mb-4">Profile Settings</h3>
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="flex flex-col">
                                <label for="name" class="text-sm font-semibold">Full Name</label>
                                <input type="text" id="name" class="mt-2 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter your name">
                            </div>
                            <!-- Email -->
                            <div class="flex flex-col">
                                <label for="email" class="text-sm font-semibold">Email Address</label>
                                <input type="email" id="email" class="mt-2 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter your email">
                            </div>
                        </div>
                        <button type="submit" class="mt-4 bg-black text-white px-6 py-2 rounded-md hover:bg-gray-700">Save Changes</button>
                    </form>
                </div>

                <!-- Theme Settings Section -->
                <div class="mb-8">
                    <h3 class="text-xl font-medium mb-4">Theme Settings</h3>
                    <form>
                        <div class="flex items-center space-x-4">
                            <label for="theme-light" class="flex items-center">
                                <input type="radio" id="theme-light" name="theme" class="mr-2">
                                <span>Light Theme</span>
                            </label>
                            <label for="theme-dark" class="flex items-center">
                                <input type="radio" id="theme-dark" name="theme" class="mr-2">
                                <span>Dark Theme</span>
                            </label>
                        </div>
                        <button type="submit" class="mt-4 bg-black text-white px-6 py-2 rounded-md hover:bg-gray-700">Save Changes</button>
                    </form>
                </div>

                <!-- Notification Settings Section -->
                <div class="mb-8">
                    <h3 class="text-xl font-medium mb-4">Notification Settings</h3>
                    <form>
                        <div class="flex items-center space-x-4">
                            <label for="notifications-email" class="flex items-center">
                                <input type="checkbox" id="notifications-email" class="mr-2">
                                <span>Receive Email Notifications</span>
                            </label>
                            <label for="notifications-app" class="flex items-center">
                                <input type="checkbox" id="notifications-app" class="mr-2">
                                <span>Receive App Notifications</span>
                            </label>
                        </div>
                        <button type="submit" class="mt-4 bg-black text-white px-6 py-2 rounded-md hover:bg-gray-700">Save Changes</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
