<!DOCTYPE html>
<ht lang="id" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Stockify - Aplikasi Manajemen Stok' }}</title>

    {{-- Tailwind CSS --}}
    @vite('resources/css/app.css')

    {{-- Font Inter --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- Flowbite CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="h-full">

    <div class="min-h-full">
        {{-- Navbar --}}
        <x-navbar></x-navbar>

        {{-- Main Content --}}
        <main>
            {{ $slot }}
        </main>
    </div>

    {{-- Flowbite JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    {{-- Alpine.js (optional, jika diperlukan) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
