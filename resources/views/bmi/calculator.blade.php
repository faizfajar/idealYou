@extends('layouts.app')

@section('title', 'Kalkulator BMI')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Kalkulator BMI</h1>
        <p class="text-lg text-gray-600">Masukan tinggi dan berat badan Anda untuk menghitung BMI</p>
    </div>

    <!-- Calculator Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <form method="POST" action="{{ route('bmi.calculate') }}" class="space-y-6">
            @csrf

            <!-- Height Input -->
            <div>
                <label for="height" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tinggi Badan (cm)
                </label>
                <div class="relative">
                    <input
                        type="number"
                        step="0.1"
                        id="height"
                        name="height"
                        value="{{ old('height') }}"
                        class="w-full px-4 py-4 rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-lg @error('height') border-red-500 @enderror"
                        placeholder="Contoh: 170"
                        required
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <span class="text-gray-400 font-medium">cm</span>
                    </div>
                </div>
                @error('height')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Weight Input -->
            <div>
                <label for="weight" class="block text-sm font-semibold text-gray-700 mb-2">
                    Berat Badan (kg)
                </label>
                <div class="relative">
                    <input
                        type="number"
                        step="0.1"
                        id="weight"
                        name="weight"
                        value="{{ old('weight') }}"
                        class="w-full px-4 py-4 rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-lg @error('weight') border-red-500 @enderror"
                        placeholder="Contoh: 65"
                        required
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                        <span class="text-gray-400 font-medium">kg</span>
                    </div>
                </div>
                @error('weight')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender Display -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Jenis Kelamin
                </label>
                <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-gray-700 font-medium">
                        {{ auth()->user()->gender_label }}
                    </span>
                </div>
                <p class="mt-2 text-xs text-gray-500">Sesuai dengan profil akun Anda</p>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full gradient-bg text-white py-4 rounded-lg font-bold text-lg hover:opacity-90 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
                <span class="flex items-center justify-center space-x-2">
                    <span>Hitung Sekarang</span>
                </span>
            </button>
        </form>
    </div>

    <!-- Info Cards -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-500 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Akurat</p>
                    <p class="text-sm text-gray-600">Hasil terpercaya</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl">
            <div class="flex items-center space-x-3">
                <div class="bg-green-500 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Cepat</p>
                    <p class="text-sm text-gray-600">Hasil instan</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl">
            <div class="flex items-center space-x-3">
                <div class="bg-purple-500 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Panduan</p>
                    <p class="text-sm text-gray-600">Rekomendasi personal</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
