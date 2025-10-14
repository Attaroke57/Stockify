<!-- Sidebar Navigation dengan Role-based Menu -->
<nav class="mt-8">
    <!-- Dashboard - Semua role -->
    <a href="{{ route('dashboard') }}"
        class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-100 border-r-4 border-indigo-600' : '' }}">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Dashboard
    </a>

    <!-- Products - Admin & Manager only -->
    @if (auth()->user()->hasRole(['admin', 'manager']))
        <a href="{{ route('products.index') }}"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('products.*') ? 'bg-gray-100 border-r-4 border-indigo-600' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Produk
        </a>
    @endif

    <!-- Stock - Semua role -->
    <a href="{{ route('stocks.index') }}"
        class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('stocks.*') ? 'bg-gray-100 border-r-4 border-indigo-600' : '' }}">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        Stok
    </a>

    <!-- Suppliers - Admin & Manager only -->
    @if (auth()->user()->hasRole(['admin', 'manager']))
        <a href="{{ route('suppliers.index') }}"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('suppliers.*') ? 'bg-gray-100 border-r-4 border-indigo-600' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Supplier
        </a>
    @endif

    <!-- Reports - Admin & Manager only -->
    @if (auth()->user()->hasRole(['admin', 'manager']))
        <a href="{{ route('reports.index') }}"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('reports.*') ? 'bg-gray-100 border-r-4 border-indigo-600' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Laporan
        </a>
    @endif

    <!-- Users - Admin only -->
    @if (auth()->user()->isAdmin())
        <a href="{{ route('users.index') }}"
            class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 {{ request()->routeIs('users.*') ? 'bg-gray-100 border-r-4 border-indigo-600' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg
