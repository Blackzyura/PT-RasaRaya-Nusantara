@extends('layouts.admin')

@section('title', 'Kelola Produk — Admin PT RasaRaya Nusantara')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-stone-900">Daftar Produk</h1>
            <p class="text-sm text-stone-500">Kelola katalog produk UMKM PT RasaRaya Nusantara.</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-amber-700 text-white text-sm font-semibold hover:bg-amber-800 transition shadow-sm">
            + Tambah Produk
        </a>
    </div>

    <!-- Filter Bar -->
    <form action="{{ route('admin.products.index') }}" method="GET"
          class="bg-white p-4 rounded-2xl border border-stone-200 mb-6 flex flex-col sm:flex-row gap-3">
        <input type="text" name="cari" value="{{ $search }}" placeholder="Cari nama produk..."
               class="flex-1 px-4 py-2 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
        <select name="category_id"
                class="sm:w-56 px-4 py-2 rounded-xl border border-stone-300 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-amber-600">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected($categoryId == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <div class="flex gap-2">
            <button type="submit" class="px-4 py-2 rounded-xl bg-stone-900 text-white text-sm font-semibold hover:bg-stone-800 transition">
                Filter
            </button>
            @if($search !== '' || $categoryId)
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-xl border border-stone-300 text-stone-700 text-sm font-semibold hover:bg-stone-50 transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- Responsive Table -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-xs font-bold uppercase tracking-wider text-stone-500">
                        <th class="py-3.5 px-4">Produk</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Harga</th>
                        <th class="py-3.5 px-4">Stok</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-sm">
                    @forelse($products as $product)
                        <tr class="hover:bg-amber-50/40 transition">
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                             class="w-12 h-12 rounded-xl object-cover bg-stone-100 shrink-0 border border-stone-200">
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-stone-100 flex items-center justify-center text-xs text-stone-400 shrink-0">N/A</div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-semibold text-stone-900">{{ $product->name }}</p>
                                        <p class="text-xs text-stone-500">{{ $product->unit }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-semibold">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-stone-900 whitespace-nowrap">
                                {{ $product->formatted_price }}
                            </td>
                            <td class="py-3.5 px-4 text-stone-600">
                                {{ $product->stock }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($product->is_featured)
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-semibold">Unggulan</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-stone-100 text-stone-600 text-xs font-semibold">Reguler</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('products.show', $product->slug) }}" target="_blank"
                                       class="px-3 py-1.5 rounded-lg bg-stone-100 text-stone-700 hover:bg-stone-200 font-semibold text-xs transition">
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-800 hover:bg-amber-100 font-semibold text-xs transition">
                                        Ubah
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }}?')">
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
                            <td colspan="6" class="py-10 text-center text-stone-500">
                                Belum ada data produk. Klik <strong>+ Tambah Produk</strong> untuk menambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-4 border-t border-stone-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
