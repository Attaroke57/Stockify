<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    .navbar-glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(102, 126, 234, 0.1);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
    }

    .nav-link {
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 50%;
        width: 0;
        height: 3px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
        transform: translateX(-50%);
        transition: width 0.3s ease;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 80%;
    }

    .nav-link.active {
        color: #667eea !important;
        font-weight: 600;
    }

    .logo-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .icon-button {
        position: relative;
        transition: all 0.3s ease;
    }

    .icon-button:hover {
        transform: scale(1.1);
    }

    .notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border-radius: 50%;
        border: 2px solid white;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.1);
        }
    }

    .dropdown-glass {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(102, 126, 234, 0.1);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        transform: translateX(4px);
    }

    .role-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 4px;
    }

    .mobile-menu {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
    }

    /* Spacer untuk fixed navbar */
    body {
        padding-top: 72px;
    }
</style>

<nav class="navbar-glass fixed top-0 left-0 right-0 z-50 transition-transform duration-300" id="mainNavbar">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse group">
            <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg transition-transform group-hover:scale-110">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <span class="self-center text-2xl font-bold logo-gradient">
                {{ \App\Models\Setting::get('app_name', 'Stockify') }}
            </span>
        </a>

        <!-- Right side buttons -->
        <div class="flex items-center md:order-2 space-x-2 rtl:space-x-reverse">
            <!-- Notification Button -->
            <button type="button" data-dropdown-toggle="notification-dropdown"
                class="icon-button p-2.5 text-gray-600 rounded-xl hover:bg-gradient-to-br hover:from-indigo-50 hover:to-purple-50 focus:ring-4 focus:ring-purple-200 transition-all">
                <span class="sr-only">View notifications</span>
                <div class="relative">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 14 20">
                        <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z" />
                    </svg>
                    <span class="notification-badge"></span>
                </div>
            </button>

            <!-- Notification Dropdown -->
            <div id="notification-dropdown" class="z-50 hidden w-full max-w-sm dropdown-glass rounded-2xl overflow-hidden">
                <div class="px-4 py-3 font-semibold text-center text-gray-800 bg-gradient-to-r from-indigo-50 to-purple-50">
                    Notifikasi
                </div>
                <div class="divide-y divide-gray-100">
                    <a href="#" class="dropdown-item flex px-4 py-3">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100">
                                <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                                    <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full pl-3">
                            <div class="text-gray-700 text-sm mb-1.5 font-medium">
                                Stok produk <span class="font-bold text-indigo-600">Laptop Asus</span> menipis
                            </div>
                            <div class="text-xs text-gray-500">5 menit yang lalu</div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item flex px-4 py-3">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-green-100 to-emerald-100">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                                    <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="w-full pl-3">
                            <div class="text-gray-700 text-sm mb-1.5 font-medium">
                                Barang masuk dari <span class="font-bold text-green-600">PT. Supplier Jaya</span> telah diterima
                            </div>
                            <div class="text-xs text-gray-500">1 jam yang lalu</div>
                        </div>
                    </a>
                </div>
                <a href="#" class="block py-3 text-sm font-semibold text-center text-indigo-600 bg-gradient-to-r from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 transition-all">
                    Lihat semua
                </a>
            </div>

            <!-- Profile Dropdown Button -->
            <button type="button" class="icon-button flex text-sm rounded-xl focus:ring-4 focus:ring-purple-200"
                id="user-menu-button" data-dropdown-toggle="user-dropdown">
                <span class="sr-only">Open user menu</span>
                <img class="w-9 h-9 rounded-xl border-2 border-white shadow-md"
                    src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=667eea&color=fff&bold=true"
                    alt="user photo">
            </button>

            <!-- Profile Dropdown -->
            <div class="z-50 hidden dropdown-glass rounded-2xl overflow-hidden" id="user-dropdown">
                <div class="px-4 py-3 bg-gradient-to-r from-indigo-50 to-purple-50">
                    <span class="block text-sm font-semibold text-gray-800">{{ auth()->user()->name ?? 'User' }}</span>
                    <span class="block text-sm text-gray-600 truncate">{{ auth()->user()->email ?? 'user@example.com' }}</span>
                    <span class="role-badge">
                        {{ ucfirst(auth()->user()->role ?? 'Admin') }}
                    </span>
                </div>
                <ul class="py-2">
                    <li>
                        <a href="{{ route('profile') }}" class="dropdown-item flex items-center px-4 py-2.5 text-sm text-gray-700 font-medium">
                            <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('settings.index') }}" class="dropdown-item flex items-center px-4 py-2.5 text-sm text-gray-700 font-medium">
                            <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Pengaturan
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item flex items-center w-full px-4 py-2.5 text-sm text-red-600 font-medium">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Mobile menu button -->
            <button data-collapse-toggle="navbar-user" type="button"
                class="icon-button inline-flex items-center p-2.5 w-10 h-10 justify-center text-gray-600 rounded-xl md:hidden hover:bg-gradient-to-br hover:from-indigo-50 hover:to-purple-50 focus:ring-4 focus:ring-purple-200">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 17 14">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-2xl mobile-menu md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }} block py-2 px-3 text-gray-700 rounded-xl md:p-0 hover:text-indigo-600 transition-colors">
                        Dashboard
                    </a>
                </li>

                <!-- Produk - ADMIN & MANAGER ONLY -->
                @if (auth()->check() && auth()->user()->hasRole(['admin', 'manager']))
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }} block py-2 px-3 text-gray-700 rounded-xl md:p-0 hover:text-indigo-600 transition-colors">
                            Produk
                        </a>
                    </li>
                @endif

                <!-- Stok -->
                <li>
                    <a href="{{ route('stocks.index') }}"
                        class="nav-link {{ request()->routeIs('stocks.*') ? 'active' : '' }} block py-2 px-3 text-gray-700 rounded-xl md:p-0 hover:text-indigo-600 transition-colors">
                        Stok
                    </a>
                </li>

                <!-- Supplier - ADMIN & MANAGER ONLY -->
                @if (auth()->check() && auth()->user()->hasRole(['admin', 'manager']))
                    <li>
                        <a href="{{ route('suppliers.index') }}"
                            class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }} block py-2 px-3 text-gray-700 rounded-xl md:p-0 hover:text-indigo-600 transition-colors">
                            Supplier
                        </a>
                    </li>
                @endif

                <!-- Laporan - ADMIN & MANAGER ONLY -->
                @if (auth()->check() && auth()->user()->hasRole(['admin', 'manager']))
                    <li>
                        <a href="{{ route('reports.index') }}"
                            class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }} block py-2 px-3 text-gray-700 rounded-xl md:p-0 hover:text-indigo-600 transition-colors">
                            Laporan
                        </a>
                    </li>
                @endif

                <!-- Pengguna - ADMIN ONLY -->
                @if (auth()->check() && auth()->user()->isAdmin())
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }} block py-2 px-3 text-gray-700 rounded-xl md:p-0 hover:text-indigo-600 transition-colors">
                            Pengguna
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('mainNavbar');
    let lastScrollTop = 0;
    let scrollThreshold = 10;

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Jika scroll lebih dari threshold
        if (Math.abs(scrollTop - lastScrollTop) > scrollThreshold) {
            if (scrollTop > lastScrollTop && scrollTop > 80) {
                // Scroll ke bawah - sembunyikan navbar
                navbar.style.transform = 'translateY(-100%)';
            } else {
                // Scroll ke atas - tampilkan navbar
                navbar.style.transform = 'translateY(0)';
            }

            lastScrollTop = scrollTop;
        }
    });
});
</script>
