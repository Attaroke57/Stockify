<nav class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Stockify</span>
        </a>

        <!-- Right side buttons -->
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <!-- Notification Button -->
            <button type="button" data-dropdown-toggle="notification-dropdown" class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                <span class="sr-only">View notifications</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                    <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
                </svg>
            </button>

            <!-- Notification Dropdown -->
            <div id="notification-dropdown" class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700">
                <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                    Notifikasi
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-11 h-11 rounded-full bg-blue-100 dark:bg-blue-900">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"/>
                                    <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="w-full pl-3">
                            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">Stok produk <span class="font-semibold text-gray-900 dark:text-white">Laptop Asus</span> menipis</div>
                            <div class="text-xs text-blue-600 dark:text-blue-500">5 menit yang lalu</div>
                        </div>
                    </a>
                    <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center w-11 h-11 rounded-full bg-green-100 dark:bg-green-900">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"/>
                                    <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="w-full pl-3">
                            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">Barang masuk dari <span class="font-semibold text-gray-900 dark:text-white">PT. Supplier Jaya</span> telah diterima</div>
                            <div class="text-xs text-blue-600 dark:text-blue-500">1 jam yang lalu</div>
                        </div>
                    </a>
                </div>
                <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                    <div class="inline-flex items-center">
                        Lihat semua
                    </div>
                </a>
            </div>

            <!-- Profile Dropdown Button -->
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=4f46e5&color=fff" alt="user photo">
            </button>

            <!-- Profile Dropdown -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">{{ auth()->user()->name ?? 'User' }}</span>
                    <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email ?? 'user@example.com' }}</span>
                    <span class="inline-flex items-center px-2 py-0.5 mt-2 text-xs font-medium text-indigo-800 bg-indigo-100 rounded dark:bg-indigo-900 dark:text-indigo-300">
                        {{ auth()->user()->role ?? 'Admin' }}
                    </span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profil</a>
                    </li>
                    <li>
                        <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Pengaturan</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- Mobile menu button -->
            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-blue bg-indigo-700 md:bg-transparent md:text-indigo-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700' }} block py-2 px-3 rounded md:p-0 dark:text-blue md:dark:text-indigo-500 dark:hover:bg-gray-700 dark:hover:text-blue md:dark:hover:bg-transparent dark:border-gray-700" aria-current="page">Dashboard</a>
                </li>

                <li>
                    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'text-blue bg-indigo-700 md:bg-transparent md:text-indigo-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700' }} block py-2 px-3 rounded md:p-0 dark:text-blue dark:hover:bg-gray-700 dark:hover:text-blue md:dark:hover:bg-transparent dark:border-gray-700">Produk</a>
                </li>

                <li>
                    <a href="{{ route('stocks.index') }}" class="{{ request()->routeIs('stocks.*') ? 'text-blue bg-indigo-700 md:bg-transparent md:text-indigo-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700' }} block py-2 px-3 rounded md:p-0 dark:text-blue dark:hover:bg-gray-700 dark:hover:text-blue md:dark:hover:bg-transparent dark:border-gray-700">Stok</a>
                </li>

                <li>
                    <a href="{{ route('suppliers.index') }}" class="{{ request()->routeIs('suppliers.*') ? 'text-blue bg-indigo-700 md:bg-transparent md:text-indigo-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700' }} block py-2 px-3 rounded md:p-0 dark:text-white dark:hover:bg-gray-700 dark:hover:text-blue md:dark:hover:bg-transparent dark:border-gray-700">Supplier</a>
                </li>

                <li>
                    <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'text-blue bg-indigo-700 md:bg-transparent md:text-indigo-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700' }} block py-2 px-3 rounded md:p-0 dark:text-white dark:hover:bg-gray-700 dark:hover:text-blue md:dark:hover:bg-transparent dark:border-gray-700">Laporan</a>
                </li>

                <li>
                    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'text-white bg-indigo-700 md:bg-transparent md:text-indigo-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-indigo-700' }} block py-2 px-3 rounded md:p-0 dark:text-white dark:hover:bg-gray-700 dark:hover:text-blue md:dark:hover:bg-transparent dark:border-gray-700">Pengguna</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Tambahkan script Flowbite di layout.blade.php sebelum closing body tag --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> --}}
