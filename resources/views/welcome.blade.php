<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation System</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-cover bg-center" style="background-image: url('{{asset('images/background.jpg')}}')">
<div class="flex flex-col h-screen justify-between">
    <!-- Header -->
    <header class="bg-transparent">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-4xl font-semibold text-white">Hotel Reservation System</h1>
            <!-- Authentication Links -->
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}"
                           class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}"
                           class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-semibold text-white mb-4">Welcome to Hotel Reservation System</h2>
            <p class="text-xl text-white mb-8">Book your stay with ease and comfort. Discover amazing destinations and
                experiences.</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-transparent text-white">
        <div class="container mx-auto px-4 py-6 text-center">
            <p>&copy; 2024 Hotel Reservation System. All rights reserved.</p>
        </div>
    </footer>
</div>
</body>

</html>
