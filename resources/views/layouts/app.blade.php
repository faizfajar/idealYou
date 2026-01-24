<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ideal You - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-xl font-bold">Ideal You</span>
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-white hover:text-white/80 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'bg-white/20' : '' }}">
                        Cek BMI
                    </a>
                    <a href="{{ route('bmi.history') }}" class="text-white hover:text-white/80 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('bmi.history') ? 'bg-white/20' : '' }}">
                        History
                    </a>
                    <a href="{{ route('bmi.history') }}" class="text-white hover:text-white/80 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('bmi.history') ? 'bg-white/20' : '' }}">
                        Tips Sehat
                    </a>

                    <div class="relative">
                        <div class="flex items-center space-x-2 text-white">
                            <span class="text-sm">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin logout?');">
                                @csrf
                                <button type="submit" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-medium transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                &copy; 2025 Ideal You. Semua hak dilindungi.
            </p>
        </div>
    </footer>
</body>
</html>
