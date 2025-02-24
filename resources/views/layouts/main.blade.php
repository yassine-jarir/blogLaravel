<!-- layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'The Weekly') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
<!-- Navbar -->
<nav class="sticky top-0 z-50 bg-gray-900/95 border-b border-gray-700 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center font-bold text-xl">
                    <span class="text-red-500">The</span> Weekly
                </a>
            </div>
            <div class="ml-6 flex items-center">
                <div class="hidden md:block">
                    <div class="flex items-center space-x-6">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">Home</a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">Announcements</a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors">Dashboard</a>
                        <a href="/category" class="text-gray-300 hover:text-white transition-colors">Category</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Content -->
<main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    @yield('content')
</main>

<!-- Footer -->
<footer class="mt-12 py-6 border-t border-gray-700 text-gray-400 text-center text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p>&copy; {{ date('Y') }} Laravel Office. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
