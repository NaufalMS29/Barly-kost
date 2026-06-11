<x-app-layout>
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Permintaan Perbaikan</h2>
            <p class="text-gray-600">Laporkan masalah di kamar Anda, kami akan menindaklanjuti.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <ul class="text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('perbaikan.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <p class="text-sm text-gray-600">Kamar</p>
                    <p class="font-medium">{{ $penghuni->kamar->nama_kamar }} ({{ $penghuni->kamar->tipe }})</p>
                </div>

                <input type="hidden" name="kamar_id" value="{{ $penghuni->kamar_id }}">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                    <input type="text" name="judul" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="5" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('perbaikan.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Kembali</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md">Kirim Permintaan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>