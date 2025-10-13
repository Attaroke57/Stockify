<x-layout title="Laporan Aktivitas">
<div class="container mx-auto p-4">
    <h1 class="text-xl mb-4">Laporan Aktivitas Pengguna</h1>

    <form method="GET" class="mb-4 flex gap-2 items-center">
        <input type="date" name="from" value="{{ request('from') }}" class="border rounded px-2 py-1">
        <input type="date" name="to" value="{{ request('to') }}" class="border rounded px-2 py-1">
        <select name="user" class="border rounded px-2 py-1">
            <option value="">Semua User</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}" @selected(request('user') == $u->id)>{{ $u->name }}</option>
            @endforeach
        </select>
        <button class="px-3 py-2 bg-indigo-600 text-white rounded">Filter</button>
        <a href="{{ route('reports.activities.export', request()->query()) }}" class="px-3 py-2 border rounded">Export CSV</a>
    </form>

    <div class="bg-white border rounded shadow">
        <ul class="divide-y">
            @forelse($activities as $a)
            <li class="p-3">
                <div class="text-sm"><strong>{{ $a->user->name ?? 'User' }}</strong> — {{ $a->description ?? '-' }}</div>
                <div class="text-xs text-gray-500">{{ $a->created_at }}</div>
            </li>
            @empty
            <li class="p-4 text-center text-gray-500">Tidak ada aktivitas.</li>
            @endforelse
        </ul>
    </div>
</div>
</x-layout>
