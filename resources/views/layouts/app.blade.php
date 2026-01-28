<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Preahvihear&display=swap" rel="stylesheet">
    <title>iDealYou - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .logo-font { font-family: 'Preahvihear', sans-serif; }
    </style>
    <style>
        /* Menghilangkan scrollbar agar terlihat lebih bersih tapi tetap bisa di-scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }

        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* Warna abu-abu Tailwind */
            border-radius: 10px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
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
                        <span class="text-xl font-bold logo-font">iDealYou</span>
                    </a>
                </div>

                <div class="flex items-center space-x-2">
                    <a href="{{ route('home') }}" class="text-white/90 hover:text-white px-3 py-1.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('home') ? 'bg-white/20 text-white' : 'hover:bg-white/10' }}">
                        Hitung BMI
                    </a>
                    <a href="{{ route('bmi.history') }}" class="text-white/90 hover:text-white px-3 py-1.5 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('bmi.history') ? 'bg-white/20 text-white' : 'hover:bg-white/10' }}">
                        Riwayat
                    </a>

                    <div class="h-6 w-[1px] bg-white/20 mx-1"></div>

                    <div class="relative inline-block text-left">
                        <button type="button" id="menu-button" class="flex items-center space-x-2 focus:outline-none group bg-white/10 hover:bg-white/20 py-1 pl-3 pr-2 rounded-lg transition-all border border-white/10">
                            <span class="text-xs font-medium text-white tracking-wide">
                                {{ explode(' ', auth()->user()->name)[0] }} </span>
                            
                            <div class="h-7 w-7 rounded-full bg-indigo-500 flex items-center justify-center text-[10px] text-white font-bold shadow-inner">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <svg class="w-3 h-3 text-white/50 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-xl border border-gray-100 py-1.5 z-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Keluar sekarang?')"
                                        class="w-full flex items-center px-4 py-2 text-xs text-red-600 hover:bg-red-50 transition font-semibold">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
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
                &copy; 2025 iDealYou. Semua hak dilindungi.
            </p>
        </div>
    </footer>
</body>


<script>
    // Ambil elemen tombol dan menu berdasarkan ID
    const menuButton = document.getElementById('menu-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    // Fungsi ketika tombol diklik
    menuButton.addEventListener('click', function(event) {
        // Mencegah klik "tembus" ke window
        event.stopPropagation(); 
        // Munculkan/Sembunyikan menu (toggle class hidden)
        dropdownMenu.classList.toggle('hidden');
    });

    // Fungsi untuk menutup dropdown jika klik di mana saja di luar menu
    window.addEventListener('click', function() {
        if (!dropdownMenu.classList.contains('hidden')) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>

<script>
    function toggleCard(targetId, button) {
        // Hanya mencari elemen berdasarkan ID yang dikirim (spesifik per kartu)
        const detailElement = document.getElementById(targetId);
        
        if (detailElement.classList.contains('hidden')) {
            detailElement.classList.remove('hidden');
            button.innerText = 'Tutup Detail';
        } else {
            detailElement.classList.add('hidden');
            button.innerText = 'Lihat Detail';
        }
    }
</script>

<script>
    function scrollSlider(id, direction) {
        const slider = document.getElementById(id);
        if (!slider) return;
        
        // Geser sejauh lebar satu card
        const cardWidth = slider.querySelector('.flex-none').clientWidth + 16; // 16 adalah gap-4
        
        slider.scrollBy({
            left: direction === 'left' ? -cardWidth : cardWidth,
            behavior: 'smooth'
        });
    }
</script>
</html>
