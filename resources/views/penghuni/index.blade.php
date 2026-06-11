<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar Penghuni - {{ config('app.name', 'UP-Resident') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">UP</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900">UP-Resident</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('landing') }}#rooms" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Kamar</a>
                    <a href="{{ route('landing') }}#about" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Tentang</a>
                    <a href="{{ route('landing') }}#contact" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Kontak</a>
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Daftar Penghuni
                </h2>
                <p class="text-gray-600">
                    Kelola data penghuni Anda
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('penghuni.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Tambah Penghuni Baru
                </a>
            </div>

            <!-- Penghuni Cards -->
            @if($penghunis->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($penghunis as $penghuni)
                        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-200">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $penghuni->nama_penghuni }}</h3>
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    @if($penghuni->tanggal_keluar)
                                        bg-red-100 text-red-800
                                    @else
                                        bg-green-100 text-green-800
                                    @endif">
                                    @if($penghuni->tanggal_keluar)
                                        Keluar
                                    @else
                                        Aktif
                                    @endif
                                </span>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600">
                                <p><strong>Kamar:</strong> {{ $penghuni->kamar->nama_kamar }} ({{ $penghuni->kamar->tipe }})</p>
                                <p><strong>No. KTP:</strong> {{ $penghuni->no_ktp }}</p>
                                <p><strong>No. Telepon:</strong> {{ $penghuni->no_telepon }}</p>
                                <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($penghuni->tanggal_masuk)->format('d M Y') }}</p>
                                @if($penghuni->tanggal_keluar)
                                    <p><strong>Tanggal Keluar:</strong> {{ \Carbon\Carbon::parse($penghuni->tanggal_keluar)->format('d M Y') }}</p>
                                @endif
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex space-x-2">
                                    <!-- You can add edit/view buttons here if needed -->
                                    <button class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada penghuni</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan penghuni pertama Anda.</p>
                    <a href="{{ route('penghuni.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Tambah Penghuni Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="fixed top-20 left-10 w-20 h-20 bg-blue-200 rounded-full opacity-20 animate-bounce"></div>
    <div class="fixed top-40 right-20 w-16 h-16 bg-purple-200 rounded-full opacity-20 animate-bounce" style="animation-delay: 1s;"></div>
</body>
</html>