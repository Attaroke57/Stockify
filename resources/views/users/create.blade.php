<x-layout title="Tambah Pengguna Baru">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .fade-in {
        animation: fadeIn 0.6s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper input,
    .input-wrapper select {
        transition: all 0.3s ease;
    }

    .input-wrapper input:focus,
    .input-wrapper select:focus {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container mx-auto p-4 md:p-8">
    <!-- Header -->
    <div class="mb-8 fade-in">
        <a href="{{ route('users.index') }}" class="inline-flex items-center text-white hover:text-purple-100 mb-4 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
        <h1 class="text-4xl font-bold text-white mb-2">Tambah Pengguna Baru</h1>
        <p class="text-purple-100">Lengkapi form di bawah untuk menambahkan pengguna</p>
    </div>

    <!-- Form Card -->
    <div class="glass-card rounded-3xl shadow-2xl p-8 max-w-2xl fade-in">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div class="input-wrapper">
                <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Nama Lengkap
                </label>
                <input type="text"
                       name="name"
                       required
                       placeholder="Masukkan nama lengkap"
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-100 focus:outline-none">
            </div>

            <!-- Email -->
            <div class="input-wrapper">
                <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Email
                </label>
                <input type="email"
                       name="email"
                       required
                       placeholder="contoh@email.com"
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-100 focus:outline-none">
            </div>

            <!-- Role -->
            <div class="input-wrapper">
                <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Role / Peran
                </label>
                <select name="role"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-100 focus:outline-none cursor-pointer">
                    <option value="">Pilih Role</option>
                    <option value="admin">👑 Admin</option>
                    <option value="manager">📊 Manajer Gudang</option>
                    <option value="staff">👤 Staff Gudang</option>
                </select>
            </div>

            <!-- Password -->
            <div class="input-wrapper">
                <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Password
                </label>
                <input type="password"
                       name="password"
                       required
                       placeholder="Minimal 8 karakter"
                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl shadow-sm focus:border-purple-500 focus:ring-4 focus:ring-purple-100 focus:outline-none">
                <p class="text-xs text-gray-500 mt-2 ml-1">Password minimal 8 karakter untuk keamanan</p>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                        class="btn-primary text-white px-8 py-3 rounded-xl font-semibold shadow-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Pengguna
                </button>
                <a href="{{ route('users.index') }}"
                   class="btn-secondary bg-gray-100 text-gray-700 px-8 py-3 rounded-xl font-semibold hover:bg-gray-200 shadow flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
</x-layout>
