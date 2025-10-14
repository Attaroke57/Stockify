<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Stockify</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-8 text-center">
                <div class="inline-block p-3 bg-white/20 rounded-full mb-4 backdrop-blur-sm">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">
                    Stockify
                </h1>
                <p class="text-indigo-100 text-sm">
                    Sistem Manajemen Inventory Modern
                </p>
            </div>

            <!-- Content Section -->
            <div class="p-8">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-2">
                    Selamat Datang!
                </h2>
                <p class="text-gray-500 text-center mb-8 text-sm">
                    Kelola stok barang Anda dengan mudah
                </p>

                <div class="space-y-4">
                    @auth
                        {{-- Jika sudah login, tampilkan tombol ke Dashboard --}}
                        <a href="{{ url('/dashboard') }}"
                            class="flex items-center justify-center w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:from-indigo-700 hover:to-purple-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Ke Dashboard
                        </a>
                    @else
                        {{-- Jika belum login, tampilkan tombol Login --}}
                        <a href="{{ url('/login') }}"
                            class="flex items-center justify-center w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:from-indigo-700 hover:to-purple-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk ke Akun
                        </a>

                        {{-- Divider --}}
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white text-gray-500">atau</span>
                            </div>
                        </div>

                        {{-- Tombol Register --}}
                        <a href="{{ url('/register') }}"
                            class="flex items-center justify-center w-full bg-white border-2 border-indigo-600 text-indigo-600 px-6 py-3 rounded-lg font-medium hover:bg-indigo-50 transform hover:scale-[1.02] transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Buat Akun Baru
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Footer Section -->
            <div class="bg-gray-50 px-8 py-4 text-center border-t border-gray-100">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} Stockify. All rights reserved.
                </p>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Butuh bantuan? <a href="#"
                    class="text-indigo-600 hover:text-indigo-700 font-medium hover:underline">Hubungi Support</a>
            </p>
        </div>
    </div>
</body>

</html>
