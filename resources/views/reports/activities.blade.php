<x-layout title="Laporan Aktivitas">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
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

    .activity-item {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }

    .activity-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .activity-item:hover {
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        transform: translateX(4px);
        border-color: rgba(102, 126, 234, 0.3);
    }

    .activity-item:hover::before {
        opacity: 1;
    }

    .input-field {
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
    }

    .input-field:focus {
        background: rgba(255, 255, 255, 0.95);
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .avatar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        animation: fadeIn 0.6s ease backwards;
    }

    .icon-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border: 1px solid rgba(102, 126, 234, 0.2);
        transition: all 0.3s ease;
    }

    .activity-item:hover .icon-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
        transform: scale(1.1);
    }
</style>

<div class="min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header with Breadcrumb -->
        <div class="mb-8 fade-in">
            <div class="flex items-center text-sm text-purple-100 mb-3">
                <a href="{{ route('reports.index') }}" class="hover:text-white transition-colors">Laporan</a>
                <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-semibold">Laporan Aktivitas</span>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Laporan Aktivitas Pengguna</h1>
            <p class="text-purple-100">Pantau dan lacak aktivitas pengguna dalam sistem 📝</p>
        </div>

        <!-- Filter Card -->
        <div class="glass-card rounded-3xl shadow-2xl p-6 mb-6 fade-in">
            <form method="GET">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <label for="from" class="block text-sm font-semibold text-gray-700 mb-2">Dari Tanggal</label>
                        <input type="date" id="from" name="from" value="{{ request('from') }}"
                            class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none">
                    </div>
                    <div>
                        <label for="to" class="block text-sm font-semibold text-gray-700 mb-2">Sampai Tanggal</label>
                        <input type="date" id="to" name="to" value="{{ request('to') }}"
                            class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none">
                    </div>
                    <div>
                        <label for="user" class="block text-sm font-semibold text-gray-700 mb-2">Pengguna</label>
                        <select id="user" name="user"
                            class="input-field w-full border-2 border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none appearance-none bg-white">
                            <option value="">Semua User</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" @selected(request('user') == $u->id)>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all inline-flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            Filter
                        </button>
                    </div>
                    <div class="flex items-end gap-2">
                        <a href="{{ route('reports.activities.export', request()->query()) }}" class="flex-1 px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all inline-flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Export
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Activity Timeline Card -->
        <div class="glass-card rounded-3xl shadow-2xl overflow-hidden fade-in">
            <div class="divide-y divide-gray-200">
                @forelse($activities as $a)
                <div class="activity-item p-6">
                    <div class="flex items-start gap-4">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="avatar relative inline-flex items-center justify-center w-12 h-12 overflow-hidden rounded-xl border-2 border-white shadow-md">
                                <span class="font-bold text-white text-lg">{{ substr($a->user->name ?? 'U', 0, 1) }}</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900">
                                        <span class="font-semibold">{{ $a->user->name ?? 'User' }}</span>
                                        <span class="text-gray-600 ml-1">{{ $a->description ?? 'melakukan aktivitas' }}</span>
                                    </p>
                                    <div class="mt-2 flex items-center text-xs text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <time>{{ $a->created_at ? $a->created_at->format('d M Y, H:i') : '-' }}</time>
                                    </div>
                                </div>

                                <!-- Activity Icon Badge -->
                                <div class="flex-shrink-0">
                                    <span class="icon-badge inline-flex items-center justify-center w-10 h-10 rounded-lg">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Tidak ada aktivitas</h3>
                    <p class="text-sm text-gray-600 mt-1">Aktivitas pengguna akan muncul di sini</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

</x-layout>
