@extends('layouts.layout')

@section('title', 'Detail Kamar: ' . $kamar->nama_kamar)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-6">
        <a href="{{ route('landing') }}" class="inline-flex items-center text-gray-600 hover:text-amber-600 font-medium transition duration-150">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Kamar
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        
        {{-- BAGIAN ATAS: Nama dan Tombol Pesan --}}
        <div class="p-6 sm:p-10 border-b border-gray-100 flex justify-between items-start flex-col sm:flex-row">
            <div>
                <span class="text-sm font-semibold text-amber-600 uppercase tracking-wider">{{ $kamar->tipe }} (Lantai {{ $kamar->lantai }})</span>
                <h1 class="text-4xl font-extrabold text-gray-900 mt-1">{{ $kamar->nama_kamar }}</h1>
            </div>
            
            <div class="mt-4 sm:mt-0 sm:text-right">
                <p class="text-2xl font-bold text-amber-700">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mb-4">per bulan</p>
                
                @if ($kamar->status == 'Kosong')
                    @guest
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('kamar.pesan', $kamar->id)) }}" class="bg-blue-600 text-white px-8 py-3 rounded-xl hover:bg-blue-700 font-bold transition duration-150 shadow-lg">
                            Login untuk Pesan &rarr;
                        </a>
                    @else
                        <a href="{{ route('kamar.pesan', $kamar->id) }}" class="bg-green-600 text-white px-8 py-3 rounded-xl hover:bg-green-700 font-bold transition duration-150 shadow-lg">
                            Pesan Kamar Ini &rarr;
                        </a>
                    @endguest
                @else
                    <span class="bg-red-500 text-white px-8 py-3 rounded-xl font-bold opacity-70 cursor-not-allowed">
                        Status: {{ $kamar->status }}
                    </span>
                @endif
            </div>
        </div>
        
        {{-- BAGIAN TENGAH: GALERI FOTO --}}
        @php
            // Asumsi Model Kamar memiliki casting 'foto_kamar' => 'array'
            $fotos = is_array($kamar->foto_kamar) ? $kamar->foto_kamar : [];
            $default_foto = 'images/default_room.jpg'; 
            
            // Tentukan foto utama
            $main_foto = $fotos[0] ?? $default_foto;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-1 p-2 bg-gray-100">
            @if (!empty($fotos))
                {{-- Foto Utama (Foto pertama) --}}
                <div class="md:col-span-1">
                    <img src="{{ asset('storage/' . $main_foto) }}" alt="Foto Utama Kamar {{ $kamar->nama_kamar }}" class="w-full h-96 object-cover rounded-tl-xl md:rounded-bl-xl transition duration-500 hover:opacity-90">
                </div>
                
                {{-- Foto Galeri Kecil (3 Foto berikutnya, jika ada) --}}
                <div class="grid grid-cols-2 gap-1">
                    @for ($i = 1; $i < min(count($fotos), 5); $i++)
                        <img src="{{ asset('storage/' . $fotos[$i]) }}" alt="Foto Galeri {{ $i }}" class="w-full h-48 object-cover transition duration-500 hover:scale-[1.02] hover:opacity-90">
                    @endfor
                </div>
            @else
                <div class="md:col-span-2 w-full h-96 bg-gray-200 flex flex-col justify-center items-center text-gray-500 rounded-xl">
                    
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 16m-4-4h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="mt-2">Belum ada foto yang diunggah.</p>
                </div>
            @endif
        </div>
        
        {{-- BAGIAN BAWAH: DETAIL DATA DARI MODEL --}}
        <div class="p-6 sm:p-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Detail Kamar</h2>
            
            <dl class="space-y-4 text-gray-700 border p-4 rounded-lg bg-gray-50">
                
                {{-- Nama Kamar --}}
                <div class="flex justify-between items-center border-b pb-2">
                    <dt class="font-medium">Nama/Kode Kamar</dt>
                    <dd class="font-semibold text-gray-800">{{ $kamar->nama_kamar }}</dd>
                </div>

                {{-- Tipe --}}
                <div class="flex justify-between items-center border-b pb-2">
                    <dt class="font-medium">Tipe Kamar</dt>
                    <dd class="font-semibold text-blue-600">{{ $kamar->tipe }}</dd>
                </div>
                
                {{-- Lantai --}}
                <div class="flex justify-between items-center border-b pb-2">
                    <dt class="font-medium">Terletak di Lantai</dt>
                    <dd class="font-semibold text-gray-800">{{ $kamar->lantai }}</dd>
                </div>
                
                {{-- Listrik --}}
                <div class="flex justify-between items-center border-b pb-2">
                    <dt class="font-medium">Daya Listrik</dt>
                    <dd class="font-semibold {{ $kamar->listrik == 'Include' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $kamar->listrik == 'Include' ? 'Termasuk (Free)' : 'Token (Bayar Sendiri)' }}
                    </dd>
                </div>
                
                {{-- Harga Bulanan --}}
                <div class="flex justify-between items-center pt-4 bg-amber-100 p-3 rounded-lg border border-amber-300">
                    <dt class="text-xl font-bold">Harga Bulanan</dt>
                    <dd class="text-2xl font-extrabold text-amber-700">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</dd>
                </div>
                
                {{-- Status --}}
                <div class="flex justify-between items-center pt-4">
                    <dt class="font-medium">Status Saat Ini</dt>
                    <dd class="font-semibold text-xl {{ $kamar->status == 'Kosong' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $kamar->status }}
                    </dd>
                </div>
            </dl>
        </div>
        
    </div>
</div>
@endsection