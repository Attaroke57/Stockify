<x-layout title="Pengaturan Aplikasi">
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Aplikasi</h1>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- App Name -->
                <div class="mb-6">
                    <label for="app_name" class="block text-gray-700 font-medium mb-2">Nama Aplikasi</label>
                    <input type="text" name="app_name" id="app_name" value="{{ old('app_name', $settings['app_name']) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @error('app_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- App Logo -->
                <div class="mb-6">
                    <label for="app_logo" class="block text-gray-700 font-medium mb-2">Logo Aplikasi</label>

                    <!-- Current Logo Preview -->
                    @if($settings['app_logo'])
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Logo Saat Ini:</p>
                            <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Current Logo"
                                class="w-24 h-24 object-contain border rounded-lg">
                        </div>
                    @endif

                    <input type="file" name="app_logo" id="app_logo" accept="image/*"
                        class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                    @error('app_logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>
</x-layout>
