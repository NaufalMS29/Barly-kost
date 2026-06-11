<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pembayaran Tagihan - {{ config('app.name', 'UP-Resident') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css'])

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
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
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Pembayaran Tagihan
                </h2>
                <p class="text-gray-600">
                    Lengkapi pembayaran untuk menyelesaikan pendaftaran kamar
                </p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <ul class="text-sm text-red-700">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Bill Details -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Detail Tagihan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama Penghuni</p>
                        <p class="font-medium">{{ $penghuni->nama_penghuni }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Kamar</p>
                        <p class="font-medium">{{ $penghuni->kamar->nama_kamar }} ({{ $penghuni->kamar->tipe }})</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Masuk</p>
                        <p class="font-medium">{{ $penghuni->tanggal_masuk->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Jumlah Tagihan</p>
                        <p class="font-medium text-lg text-blue-600">Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pembayaran</h3>

                <form id="paymentForm" action="{{ route('pembayaran.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                                Metode Pembayaran
                            </label>
                            <select id="metode_pembayaran" name="metode_pembayaran"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="Midtrans">💳 Midtrans (Transfer Bank, E-Wallet, Kartu Kredit)</option>
                                <option value="Tunai">💵 Tunai</option>
                            </select>
                        </div>

                        <div id="tanggal_field">
                            <label for="tanggal_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Pembayaran
                            </label>
                            <input type="date" id="tanggal_pembayaran" name="tanggal_pembayaran"
                                   value="{{ date('Y-m-d') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <input type="hidden" name="tagihan_id" value="{{ $tagihan->id }}">
                </form>

                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('dashboard') }}"
                       class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                        Kembali ke Dashboard
                    </a>

                    <div class="flex space-x-3">
                        <button type="button" id="payButton"
                                class="px-8 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 font-medium">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="fixed top-20 left-10 w-20 h-20 bg-blue-200 rounded-full opacity-20 animate-bounce"></div>
    <div class="fixed top-40 right-20 w-16 h-16 bg-purple-200 rounded-full opacity-20 animate-bounce" style="animation-delay: 1s;"></div>

    <!-- Midtrans Payment Logic -->
    @if(session('snapToken'))
    <script type="text/javascript">
        // Trigger snap popup automatically when token is present
        window.snap.pay('{{ session('snapToken') }}', {
            onSuccess: function(result){
                // Redirect ke success handler
                window.location.href = "{{ url('api/midtrans-success/' . $tagihan->midtrans_order_id) }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda!");
                console.log(result);
            },
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            }
        });
    </script>
    @endif

    <script>
        document.getElementById('metode_pembayaran').addEventListener('change', function() {
            const selectedMethod = this.value;
            const tanggalField = document.getElementById('tanggal_field');
            const catatanField = document.getElementById('catatan_field');
            const tanggalInput = document.getElementById('tanggal_pembayaran');
            const catatanTextarea = document.getElementById('catatan');

            if (selectedMethod === 'Midtrans') {
                // Hide tanggal and catatan fields for Midtrans
                tanggalField.style.display = 'none';
                catatanField.style.display = 'none';
                tanggalInput.required = false;
            } else {
                // Show fields for manual payments
                tanggalField.style.display = 'block';
                catatanField.style.display = 'block';
                tanggalInput.required = true;
            }
        });

        document.getElementById('payButton').addEventListener('click', function() {
            const selectedMethod = document.getElementById('metode_pembayaran').value;

            if (!selectedMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu.');
                return;
            }

            if (selectedMethod === 'Midtrans') {
                // Submit form to get snap token
                document.getElementById('paymentForm').submit();
            } else {
                // Submit form normally for manual payments
                document.getElementById('paymentForm').submit();
            }
        });
    </script>
</body>
</html>