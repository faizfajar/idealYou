@extends('layouts.app')

@section('title', 'Hasil Perhitungan BMI')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Kalkulator
        </a>
    </div>

    <!-- Main Result Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Hasil Perhitungan BMI Anda</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- BMI Score -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 text-center">
                <p class="text-sm font-medium text-gray-600 mb-2">BMI Anda</p>
                <p class="text-5xl font-bold text-purple-600 mb-2">{{ $calculation->bmi }}</p>
                <p class="text-lg font-semibold {{
                    $calculation->isNormal() ? 'text-green-600' :
                    ($calculation->isUnderweight() || $calculation->category === 'Kelebihan Berat Badan' ? 'text-yellow-600' : 'text-red-600')
                }}">
                    {{ $calculation->category }}
                </p>
            </div>

            <!-- Input Summary -->
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Tinggi Badan:</span>
                    <span class="font-bold text-gray-900">{{ $calculation->height }} cm</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Berat Badan:</span>
                    <span class="font-bold text-gray-900">{{ $calculation->weight }} kg</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Jenis Kelamin:</span>
                    <span class="font-bold text-gray-900">{{ $calculation->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
            </div>
        </div>

        <!-- Weight Range -->
        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Rentang Berat Badan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-600 mb-1">Berat Ideal</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $calculation->ideal_weight }} kg</p>
                </div>
                <div class="bg-green-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-600 mb-1">Berat Minimum</p>
                    <p class="text-2xl font-bold text-green-600">{{ $calculation->min_weight }} kg</p>
                </div>
                <div class="bg-orange-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-600 mb-1">Berat Maximum</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $calculation->max_weight }} kg</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Food Suggestions -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center mb-6">
            <div class="bg-green-100 p-3 rounded-lg mr-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Rekomendasi Pola Makan</h2>
        </div>
        <ul class="space-y-3">
            @foreach($suggestions['diet'] as $diet)
            <li class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-gray-700">{{ $diet }}</span>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Diet Suggestions -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center mb-6">
            <div class="bg-green-100 p-3 rounded-lg mr-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Rekomendasi Pola Makan</h2>
        </div>
        <ul class="space-y-3">
            @foreach($suggestions['diet'] as $diet)
            <li class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-gray-700">{{ $diet }}</span>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Exercise Suggestions -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center mb-6">
            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Program Olahraga</h2>
        </div>
        <ul class="space-y-3">
            @foreach($suggestions['exercise'] as $exercise)
            <li class="flex items-start">
                <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-gray-700">{{ $exercise }}</span>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Weekly Schedule -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
        <div class="flex items-center mb-6">
            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Jadwal Mingguan</h2>
        </div>
        <div class="space-y-3">
            @foreach($suggestions['schedule'] as $schedule)
            <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-5 h-5 text-purple-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-gray-700">{{ $schedule }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Important Tips -->
    <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl shadow-xl p-8">
        <div class="flex items-start mb-4">
            <svg class="w-8 h-8 text-orange-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Catatan Penting</h3>
                <div class="space-y-2 text-gray-700">
                    <p>⚠️ <strong>Konsultasi Medis:</strong> Hasil ini adalah panduan umum. Untuk program diet dan olahraga yang spesifik, konsultasikan dengan dokter atau ahli gizi.</p>
                    <p>🏥 <strong>Kondisi Kesehatan:</strong> Jika Anda memiliki kondisi kesehatan khusus, diabetes, hipertensi, atau sedang hamil/menyusui, konsultasikan terlebih dahulu dengan tenaga medis.</p>
                    <p>⚡ <strong>Keamanan Olahraga:</strong> Mulai program olahraga secara bertahap. Hentikan aktivitas jika mengalami nyeri, pusing, atau sesak napas.</p>
                    <p>📊 <strong>Monitoring:</strong> Pantau berat badan secara teratur dan catat progress Anda untuk hasil optimal.</p>
                    <p>💪 <strong>Konsistensi:</strong> Perubahan berat badan yang sehat adalah 0.5-1 kg per minggu. Hindari diet ekstrem.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-8 flex gap-4">
        <a href="{{ route('home') }}" class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 text-white py-4 rounded-lg font-bold text-center hover:opacity-90 transition shadow-lg">
            Hitung Lagi
        </a>
        <a href="{{ route('bmi.history') }}" class="flex-1 bg-white border-2 border-purple-600 text-purple-600 py-4 rounded-lg font-bold text-center hover:bg-purple-50 transition">
            Lihat History
        </a>
    </div>
</div>
@endsection
