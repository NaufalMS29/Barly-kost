@extends('layouts.layout')

@section('title', 'Selamat Datang di Barly Kost')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-50 via-white to-purple-50 overflow-hidden">
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                Temukan <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Kos
                    Impian</span> Anda
            </h1>

            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Kelola tagihan, pantau status kamar, dan nikmati pengalaman kos yang modern dan praktis dengan sistem
                terintegrasi kami.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Terpercaya</h3>
                    <p class="text-gray-600">Semua properti diverifikasi untuk kualitas dan keamanan</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Cepat</h3>
                    <p class="text-gray-600">Proses pemesanan dan pembayaran dalam hitungan menit</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Mudah</h3>
                    <p class="text-gray-600">Interface yang intuitif untuk semua pengguna</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Kenapa Memilih Barly Kost?
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Kami menyediakan solusi lengkap untuk pengelolaan kos modern
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Pembayaran Otomatis</h3>
                <p class="text-gray-600">Sistem pembayaran tagihan yang terintegrasi dan mudah dilacak untuk penghuni
                    dan pemilik kos.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Manajemen Kamar</h3>
                <p class="text-gray-600">Pantau status kamar secara real-time, dari kosong hingga perbaikan, dengan
                    update otomatis.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Responsif & Cepat</h3>
                <p class="text-gray-600">Interface yang modern dan responsif di semua perangkat dengan performa tinggi.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Rooms Section -->
<section id="rooms" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Kamar Tersedia
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Pilih kamar impian Anda dari berbagai pilihan yang tersedia
            </p>
        </div>

        <!-- Filter Section -->
        <div class="bg-gray-50 p-6 rounded-2xl mb-12">
            <form method="GET" action="{{ route('landing') }}" id="filterForm"
                class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="flex flex-wrap gap-4">
                    <select name="tipe"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent filter-select">
                        <option value="Semua Tipe" {{ request('tipe')==='Semua Tipe' || !request('tipe') ? 'selected'
                            : '' }}>Semua Tipe</option>
                        <option value="AC" {{ request('tipe')==='AC' ? 'selected' : '' }}>AC</option>
                        <option value="Non-AC" {{ request('tipe')==='Non-AC' ? 'selected' : '' }}>Non-AC</option>
                    </select>
                    <select name="status"
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent filter-select">
                        <option value="Semua Status" {{ request('status')==='Semua Status' || !request('status')
                            ? 'selected' : '' }}>Semua Status</option>
                        <option value="Kosong" {{ request('status')==='Kosong' ? 'selected' : '' }}>Kosong</option>
                        <option value="Terisi" {{ request('status')==='Terisi' ? 'selected' : '' }}>Terisi</option>
                        <option value="Perbaikan" {{ request('status')==='Perbaikan' ? 'selected' : '' }}>Perbaikan
                        </option>
                    </select>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kamar..."
                        class="px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Cari
                </button>
            </form>
        </div>

        <!-- Rooms Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($kamars as $kamar)
            @php
            $statusClasses = match($kamar->status) {
            'Kosong' => 'bg-green-100 text-green-800 border-green-200',
            'Terisi' => 'bg-red-100 text-red-800 border-red-200',
            'Perbaikan' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            default => 'bg-gray-100 text-gray-800 border-gray-200'
            };
            $tipeClasses = $kamar->tipe === 'AC' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800';
            @endphp

            <div
                class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                <!-- Room Image -->
                <div class="relative overflow-hidden">
                    @php
                    $fotos = $kamar->foto_kamar;
                    $imagePath = is_array($fotos) && !empty($fotos) ? $fotos[0] : 'images/default_room.jpg';
                    @endphp
                    <img src="{{ asset('storage/' . $imagePath) }}" alt="Foto Kamar {{ $kamar->nama_kamar }}"
                        class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">

                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium border {{ $statusClasses }}">
                            {{ $kamar->status }}
                        </span>
                    </div>

                    <!-- Type Badge -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $tipeClasses }}">
                            {{ $kamar->tipe }}
                        </span>
                    </div>
                </div>

                <!-- Room Info -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $kamar->nama_kamar }}</h3>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-blue-600">
                            Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}
                        </span>
                        <span class="text-sm text-gray-500">/bulan</span>
                    </div>

                    @if($kamar->status === 'Kosong')
                    <a href="{{ route('kamar.detail', $kamar) }}"
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold text-center hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 block">
                        Lihat Detail & Pesan
                    </a>
                    @else
                    <a href="{{ route('kamar.detail', $kamar) }}"
                        class="w-full bg-gray-400 text-white py-3 px-6 rounded-xl font-semibold text-center cursor-pointer block">
                        Lihat Detail
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada kamar tersedia</h3>
                <p class="text-gray-600">Coba ubah filter pencarian atau kembali lagi nanti.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($kamars->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $kamars->links() }}
        </div>
        @endif
    </div>
</section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const filterSelects = document.querySelectorAll('.filter-select');
    const searchInput = document.querySelector('input[name="search"]');

    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });

    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            document.getElementById('filterForm').submit();
        }, 500); 
    });
});
</script>