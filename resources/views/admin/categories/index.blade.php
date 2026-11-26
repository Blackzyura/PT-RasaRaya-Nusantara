@extends('layouts.admin')

@section('title', 'Kelola Kategori — Admin PT RasaRaya Nusantara')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-stone-900">Daftar Kategori</h1>
            <p class="text-sm text-stone-500">Kelola kategori produk PT RasaRaya Nusantara.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-amber-700 text-white text-sm font-semibold hover:bg-amber-800 transition shadow-sm">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-xs font-bold uppercase tracking-wider text-stone-500">
                        <th class="py-3.5 px-4">Nama Kategori</th>
                        <th class="py-3.5 px-4">Deskripsi</th>
                        <th class="py-3.5 px-4">Jumlah Produk</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-sm">
                    @forelse($categories as $category)
                        <tr class="hover:bg-amber-50/40 transition">
                            <td class="py-3.5 px-4 font-semibold text-stone-900">{{ $category->name }}</td>
                            <td class="py-3.5 px-4 text-stone-600">{{ $category->description ?? '-' }}</td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-700 text-xs font-semibold">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-800 hover:bg-amber-100 font-semibold text-xs transition">
                                        Ubah
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 font-semibold text-xs transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-stone-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
