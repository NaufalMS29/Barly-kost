<x-app-layout>
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Permintaan Perbaikan Saya</h2>
                <p class="text-sm text-gray-600">Daftar permintaan perbaikan untuk kamar Anda.</p>
            </div>
            <div>
                <a href="{{ route('perbaikan.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Buat Permintaan</a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        @if($perbaikans->isEmpty())
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <p class="text-gray-600">Belum ada permintaan perbaikan.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($perbaikans as $p)
                    <div class="bg-white rounded-xl shadow p-4 flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $p->judul }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $p->deskripsi }}</p>
                            <p class="text-xs text-gray-500 mt-2">Dibuat: {{ $p->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium {{ $p->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($p->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">{{ ucfirst($p->status) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
</x-app-layout>