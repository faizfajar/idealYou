<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Preahvihear&display=swap" rel="stylesheet">
    <title>Register - Ideal You</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .logo-font { font-family: 'Preahvihear', sans-serif; }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Left Side - Branding -->
        <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 flex flex-col justify-center items-center w-full px-12 text-white">
                <div class="animate-float mb-8">
                    <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>

                <h1 class="text-4xl font-bold logo-font gradient-bg bg-clip-text">iDealYou</h1>
                <p class="text-xl text-center text-white/90 max-w-md">
                    Temukan berat badan ideal Anda dan raih hidup yang lebih sehat
                </p>

                <div class="mt-12 space-y-4 text-white/80">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Kalkulator BMI Akurat</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Rekomendasi Personal</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Tracking History</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <h1 class="text-4xl font-bold gradient-bg bg-clip-text text-transparent">Ideal You</h1>
                    <p class="text-gray-600 mt-2">Hidup Sehat, Berat Ideal</p>
                </div>

                <!-- Register Form -->
                <div>
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
                        <p class="mt-2 text-sm text-gray-600">Mulai perjalanan menuju berat badan ideal Anda</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap"
                            >
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('email') border-red-500 @enderror"
                                placeholder="nama@email.com"
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative flex items-center justify-center p-4 border-2 rounded-lg cursor-pointer transition hover:border-purple-500 {{ old('gender') === 'male' ? 'border-purple-500 bg-purple-50' : 'border-gray-300' }}">
                                    <input
                                        type="radio"
                                        name="gender"
                                        value="male"
                                        {{ old('gender') === 'male' ? 'checked' : '' }}
                                        required
                                        class="sr-only"
                                    >
                                    <div class="text-center">
                                        <svg class="w-8 h-8 mx-auto mb-2 {{ old('gender') === 'male' ? 'text-purple-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium {{ old('gender') === 'male' ? 'text-purple-700' : 'text-gray-700' }}">Laki-laki</span>
                                    </div>
                                </label>

                                <label class="relative flex items-center justify-center p-4 border-2 rounded-lg cursor-pointer transition hover:border-purple-500 {{ old('gender') === 'female' ? 'border-purple-500 bg-purple-50' : 'border-gray-300' }}">
                                    <input
                                        type="radio"
                                        name="gender"
                                        value="female"
                                        {{ old('gender') === 'female' ? 'checked' : '' }}
                                        required
                                        class="sr-only"
                                    >
                                    <div class="text-center">
                                        <svg class="w-8 h-8 mx-auto mb-2 {{ old('gender') === 'female' ? 'text-purple-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium {{ old('gender') === 'female' ? 'text-purple-700' : 'text-gray-700' }}">Perempuan</span>
                                    </div>
                                </label>
                            </div>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition @error('password') border-red-500 @enderror"
                                placeholder="Minimal 8 karakter"
                            >
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                placeholder="Ulangi password"
                            >
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full gradient-bg text-white py-3 rounded-lg font-semibold hover:opacity-90 transition shadow-lg"
                        >
                            Daftar Sekarang
                        </button>
                    </form>

                    <!-- Login Link -->
                    <p class="mt-6 text-center text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add interactive styling for gender selection
        document.querySelectorAll('input[name="gender"]').forEach(input => {
            input.addEventListener('change', function() {
                document.querySelectorAll('label').forEach(label => {
                    label.classList.remove('border-purple-500', 'bg-purple-50');
                    label.classList.add('border-gray-300');
                    label.querySelectorAll('svg').forEach(svg => {
                        svg.classList.remove('text-purple-500');
                        svg.classList.add('text-gray-400');
                    });
                    label.querySelectorAll('span').forEach(span => {
                        span.classList.remove('text-purple-700');
                        span.classList.add('text-gray-700');
                    });
                });

                const label = this.closest('label');
                label.classList.remove('border-gray-300');
                label.classList.add('border-purple-500', 'bg-purple-50');
                label.querySelectorAll('svg').forEach(svg => {
                    svg.classList.remove('text-gray-400');
                    svg.classList.add('text-purple-500');
                });
                label.querySelectorAll('span').forEach(span => {
                    span.classList.remove('text-gray-700');
                    span.classList.add('text-purple-700');
                });
            });
        });
    </script>
</body>
</html>
