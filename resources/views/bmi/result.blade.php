@extends('layouts.app')

@section('title', 'Hasil Perhitungan BMI')

@section('content')
<div class="max-w-5xl mx-auto px-4 pb-12">
    <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium transition group">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Hitung Ulang
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border border-gray-100">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Hasil Perhitungan BMI Anda</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-gradient-to-br from-purple-50 to-indigo-100 rounded-2xl p-8 text-center border border-purple-200 shadow-inner">
                <p class="text-xs font-bold text-purple-400 uppercase tracking-[0.2em] mb-3">Indeks Massa Tubuh</p>
                <p class="text-7xl font-black text-purple-600 mb-3">{{ $calculation->bmi }}</p>
                <div class="inline-block px-6 py-2 rounded-full font-bold text-lg shadow-sm {{
                    $calculation->category === 'Ideal' ? 'bg-green-500 text-white' :
                    ($calculation->category === 'Underweight' || $calculation->category === 'Overweight' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white')
                }}">
                    {{ $calculation->category }}
                </div>
            </div>

            <div class="flex flex-col justify-center space-y-4">
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <span class="text-gray-500 font-semibold uppercase text-xs tracking-wider">Tinggi Badan</span>
                    <span class="font-bold text-gray-900 text-xl">{{ $calculation->height }} <small class="text-gray-400 font-normal">cm</small></span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <span class="text-gray-500 font-semibold uppercase text-xs tracking-wider">Berat Badan</span>
                    <span class="font-bold text-gray-900 text-xl">{{ $calculation->weight }} <small class="text-gray-400 font-normal">kg</small></span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <span class="text-gray-500 font-semibold uppercase text-xs tracking-wider">Jenis Kelamin</span>
                    <span class="font-bold text-gray-900 text-lg">{{ $calculation->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-8">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <span class="w-2 h-6 bg-purple-600 rounded-full mr-3"></span>
                Analisis Berat Badan Ideal
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-50/50 rounded-2xl p-5 border border-blue-100 text-center transition-transform hover:scale-105">
                    <p class="text-[10px] text-blue-500 font-black uppercase tracking-widest mb-2">Target Ideal</p>
                    <p class="text-3xl font-black text-blue-700">{{ $calculation->ideal_weight }} <span class="text-sm font-medium">kg</span></p>
                </div>
                <div class="bg-green-50/50 rounded-2xl p-5 border border-green-100 text-center transition-transform hover:scale-105">
                    <p class="text-[10px] text-green-500 font-black uppercase tracking-widest mb-2">Batas Minimum</p>
                    <p class="text-3xl font-black text-green-700">{{ $calculation->min_weight }} <span class="text-sm font-medium">kg</span></p>
                </div>
                <div class="bg-orange-50/50 rounded-2xl p-5 border border-orange-100 text-center transition-transform hover:scale-105">
                    <p class="text-[10px] text-orange-500 font-black uppercase tracking-widest mb-2">Batas Maksimum</p>
                    <p class="text-3xl font-black text-orange-700">{{ $calculation->max_weight }} <span class="text-sm font-medium">kg</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-10">

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden flex flex-col transition-all hover:shadow-2xl">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="bg-green-100 p-4 rounded-2xl mr-5 shadow-sm">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168 0.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332 0.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332 0.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 tracking-tight">Rekomendasi Pola Makan
                        <p class="text-sm text-green-600 font-semibold tracking-wider uppercase mt-1">Nutrisi & Pola Makan Sehat</p>
                    </div>
                </div>

                @php
                    $dietImages = $suggestions['diet_images'] ?? [];
                    $dietImgCount = count($dietImages);
                    $dietScrollable = $dietImgCount > 2;
                    $dietSliderId = 'slider-diet';
                @endphp

                <div class="relative group mb-8">
                    @if($dietScrollable)
                        <button onclick="scrollSlider('{{ $dietSliderId }}', 'left')"
                                class="absolute left-2 top-1/2 -translate-y-1/2 z-10 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity hidden md:block">
                            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                    @endif

                    <div id="{{ $dietSliderId }}"
                        class="flex gap-4 pb-2 {{ $dietScrollable ? 'overflow-x-auto snap-x snap-mandatory scroll-smooth scrollbar-hide' : 'justify-start' }}"
                        style="-webkit-overflow-scrolling: touch;">

                        @foreach($dietImages as $path)
                            <div class="flex-none {{ $dietScrollable ? 'w-[85%] md:w-[calc(50%-0.5rem)] snap-center' : 'w-1/2 md:w-[48%]' }}">
                                <img src="{{ asset($path) }}"
                                    class="w-full h-56 object-cover rounded-2xl shadow-md border border-gray-100"
                                    alt="Rekomendasi Makanan">
                            </div>
                        @endforeach
                    </div>

                    @if($dietScrollable)
                        <button onclick="scrollSlider('{{ $dietSliderId }}', 'right')"
                                class="absolute right-2 top-1/2 -translate-y-1/2 z-10 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity hidden md:block">
                            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
                </div>

                <div id="detail-makan" class="hidden animate-fade-in-up">
                    <div class="bg-green-50/50 p-8 rounded-2xl border border-green-100">

                        @foreach($suggestions['diet'] as $jenis => $makananList)
                            <div class="mb-10 last:mb-0">
                                <h3 class="text-2xl font-extrabold text-green-800 uppercase tracking-wider mb-1">
                                    {{ $jenis }}
                                </h3>

                                <p class="text-sm font-semibold text-green-600/70 mb-4 ml-1">
                                    Makanan dan Kalori :
                                </p>

                                <ul class="space-y-5">
                                    @foreach($makananList as $item)
                                        <li class="flex items-start text-gray-700">
                                            <div class="bg-green-500 rounded-full p-1 mr-4 mt-1 flex-shrink-0 shadow-sm">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="text-lg leading-relaxed font-medium">
                                                {{ $item }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            @if(!$loop->last)
                                <hr class="my-8 border-green-100">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <button onclick="toggleCard('detail-makan', this)"
                    class="w-full py-6 bg-gray-50 hover:bg-green-50 text-gray-500 hover:text-green-600 font-black transition-all border-t border-gray-100 tracking-[0.2em] text-xs uppercase">
                Lihat Detail
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden flex flex-col transition-all hover:shadow-2xl">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="bg-blue-100 p-4 rounded-2xl mr-5 shadow-sm">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 tracking-tight">Rekomendasi Olahraga</h2>
                        <p class="text-sm text-blue-600 font-semibold tracking-wider uppercase mt-1">Aktivitas Fisik & Kebugaran</p>
                    </div>
                </div>

                @php
                    $exImages = $suggestions['exercise_images'] ?? [];
                    $exImgCount = count($exImages);
                    $exScrollable = $exImgCount > 2;
                @endphp

                <div class="relative group mb-8">
                    @if($exScrollable)
                        <button onclick="scrollSlider('slider-ex', 'left')" class="absolute left-2 top-1/2 -translate-y-1/2 z-10 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity hidden md:block">
                            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                    @endif

                    <div id="slider-ex" class="flex gap-4 pb-2 {{ $exScrollable ? 'overflow-x-auto snap-x snap-mandatory scroll-smooth scrollbar-hide' : 'justify-start' }}">
                        @foreach($exImages as $path)
                            <div class="flex-none {{ $exScrollable ? 'w-[85%] md:w-[calc(50%-0.5rem)] snap-center' : 'w-1/2 md:w-[48%]' }}">
                                <img src="{{ asset($path) }}" class="w-full h-56 object-cover rounded-2xl shadow-md border border-gray-100" alt="Workout Plan">
                            </div>
                        @endforeach
                    </div>

                    @if($exScrollable)
                        <button onclick="scrollSlider('slider-ex', 'right')" class="absolute right-2 top-1/2 -translate-y-1/2 z-10 bg-white/90 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity hidden md:block">
                            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    @endif
                </div>

                <div id="detail-olahraga" class="hidden animate-fade-in-up">
                    <div class="bg-blue-50/50 p-8 rounded-2xl border border-blue-100">
                        @foreach($suggestions['exercise'] as $jenis => $olahragaList)
                            <div class="mb-10 last:mb-0">
                                <h3 class="text-2xl font-extrabold text-blue-800 uppercase tracking-wider mb-1">{{ $jenis }}</h3>
                                <p class="text-sm font-semibold text-blue-600/70 mb-4 ml-1">Aktivitas dan Durasi :</p>
                                <ul class="space-y-5">
                                    @foreach($olahragaList as $item)
                                        <li class="flex items-start text-gray-700">
                                            <div class="bg-blue-500 rounded-full p-1 mr-4 mt-1 flex-shrink-0 shadow-sm">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                            </div>
                                            <span class="text-lg leading-relaxed font-medium">{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @if(!$loop->last) <hr class="my-8 border-blue-100"> @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <button onclick="toggleCard('detail-olahraga', this)" class="w-full py-6 bg-gray-50 hover:bg-blue-50 text-gray-500 hover:text-blue-600 font-black transition-all border-t border-gray-100 tracking-[0.2em] text-xs uppercase">
                Lihat Detail
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden flex flex-col transition-all hover:shadow-2xl">
            <div class="p-8">
                <div class="flex items-center mb-8">
                    <div class="bg-red-100 p-4 rounded-2xl mr-5 shadow-sm">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 tracking-tight">Tips Sehat Harian</h2>
                        <p class="text-sm text-red-600 font-semibold tracking-wider uppercase mt-1">Gaya Hidup & Keseimbangan</p>
                    </div>
                </div>

                <div class="bg-red-50/30 rounded-3xl p-6 flex flex-col items-center mb-8 border border-red-50">
                    <img src="{{ asset('img/tips-sehat.svg') }}" class="w-full max-w-md h-auto mb-4" alt="Healthy Lifestyle Illustration">
                    <p class="text-gray-400 text-xs italic tracking-wide">Ilustrasi Gaya Hidup Sehat</p>
                </div>

                <div id="detail-tips" class="animate-fade-in-up">
                    <div class="bg-red-50/50 p-8 rounded-2xl border border-red-100">
                        <div class="space-y-8">
                            @foreach($suggestions['tips'] as $index => $tip)
                            <div class="flex items-start group">
                                <div class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center font-black mr-5 flex-shrink-0 shadow-md transform group-hover:scale-110 transition">{{ $index + 1 }}</div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $tip['judul'] }}</h4>
                                    <p class="text-gray-600 leading-relaxed text-md">{{ $tip['isi_tips'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- <button onclick="toggleCard('detail-tips', this)" class="w-full py-6 bg-gray-50 hover:bg-red-50 text-gray-500 hover:text-red-600 font-black transition-all border-t border-gray-100 tracking-[0.2em] text-xs">
                Lihat Detail
            </button> -->
        </div>

    </div>
</div>
@endsection
