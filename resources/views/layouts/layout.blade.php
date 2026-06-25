<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Barly Kost') }} - Solusi Kost Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">BK</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Barly Kost</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#rooms" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Kamar</a>
                    <a href="#contact"
                        class="text-gray-600 hover:text-gray-900 font-medium transition-colors">Kontak</a>

                    @guest
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-gray-900 font-medium transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-full font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Daftar Sekarang
                        </a>
                    </div>
                    @else
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Halo, {{ Auth::user()->name }}</span>
                        <a href="{{ route('dashboard') }}"
                            class="bg-gray-100 text-gray-900 px-4 py-2 rounded-full font-medium hover:bg-gray-200 transition-colors">
                            Dashboard
                        </a>
                    </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-600 hover:text-gray-900" id="mobile-menu-button">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div class="hidden md:hidden pb-4" id="mobile-menu">
                <div class="flex flex-col space-y-4 pt-4 border-t border-gray-200">
                    <a href="#rooms" class="text-gray-600 hover:text-gray-900 font-medium">Kamar</a>
                    <a href="#about" class="text-gray-600 hover:text-gray-900 font-medium">Tentang</a>
                    <a href="#contact" class="text-gray-600 hover:text-gray-900 font-medium">Kontak</a>

                    @guest
                    <div class="flex flex-col space-y-2 pt-4">
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-gray-900 font-medium text-center py-2">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-full font-semibold text-center hover:from-blue-700 hover:to-purple-700 transition-all duration-200">
                            Daftar Sekarang
                        </a>
                    </div>
                    @else
                    <div class="flex flex-col space-y-2 pt-4">
                        <span class="text-gray-600 text-center">Halo, {{ Auth::user()->name }}</span>
                        <a href="{{ route('dashboard') }}"
                            class="bg-gray-100 text-gray-900 px-4 py-2 rounded-full font-medium text-center hover:bg-gray-200 transition-colors">
                            Dashboard
                        </a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    @yield('content')

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">BK</span>
                        </div>
                        <span class="text-xl font-bold">Barly Kost</span>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md">
                        Platform modern untuk pengelolaan kost yang memudahkan penghuni dan pemilik dalam mengelola
                        tagihan dan status kamar.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#rooms" class="text-gray-400 hover:text-white transition-colors">Kamar Tersedia</a>
                        </li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="{{ route('login') }}"
                                class="text-gray-400 hover:text-white transition-colors">Masuk</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 info@barlykost.com</li>
                        <li>📱 +62 812-3456-7890</li>
                        <li>📍 Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; {{ date('Y') }} Barly Kost.
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>