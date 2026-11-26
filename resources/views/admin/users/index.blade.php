@extends('layouts.admin')

@section('title', 'Kelola Pengguna — Admin PT RasaRaya Nusantara')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-stone-900">Daftar Pengguna Terdaftar</h1>
            <p class="text-sm text-stone-500">Data akun admin dan pelanggan yang mendaftar dari halaman publik (tersinkron dengan database).</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-xs font-bold uppercase tracking-wider text-stone-500">
                        <th class="py-3.5 px-4">Nama</th>
                        <th class="py-3.5 px-4">Email</th>
                        <th class="py-3.5 px-4">Peran (Role)</th>
                        <th class="py-3.5 px-4">Tanggal Daftar</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-amber-50/40 transition">
                            <td class="py-3.5 px-4 font-semibold text-stone-900">{{ $user->name }}</td>
                            <td class="py-3.5 px-4 text-stone-600">{{ $user->email }}</td>
                            <td class="py-3.5 px-4">
                                @if($user->isAdmin())
                                    <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-bold">Admin</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-semibold">Pelanggan</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-stone-500">{{ $user->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 font-semibold text-xs transition">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-stone-400">Akun aktif</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-stone-500">Belum ada pengguna terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-4 border-t border-stone-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
