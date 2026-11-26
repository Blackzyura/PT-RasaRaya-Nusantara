@extends('layouts.admin')

@section('title', 'Tambah Produk — Admin PT RasaRaya Nusantara')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-stone-900">Tambah Produk Baru</h1>
                <p class="text-sm text-stone-500">Isi informasi produk dengan lengkap dan unggah foto produk.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-stone-600 hover:text-stone-900">
                &larr; Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
                <p class="font-bold mb-1">Periksa kembali input Anda:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 sm:p-8 space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-stone-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" required
                            class="w-full px-4 py-2.5 rounded-xl border @error('category_id') border-red-400 @else border-stone-300 @enderror bg-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="name" class="block text-sm font-semibold text-stone-700 mb-1.5">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="120" required
                           placeholder="Contoh: Sambal Cakalang Asap"
                           class="w-full px-4 py-2.5 rounded-xl border @error('name') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                    @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label for="price" class="block text-sm font-semibold text-stone-700 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" min="100" required
                           placeholder="35000"
                           class="w-full px-4 py-2.5 rounded-xl border @error('price') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                    @error('price') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold text-stone-700 mb-1.5">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', 10) }}" min="0" required
                           class="w-full px-4 py-2.5 rounded-xl border @error('stock') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                    @error('stock') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="unit" class="block text-sm font-semibold text-stone-700 mb-1.5">Satuan Kemasan <span class="text-red-500">*</span></label>
                    <input type="text" name="unit" id="unit" value="{{ old('unit') }}" maxlength="30" required
                           placeholder="botol 150g / pouch 200g"
                           class="w-full px-4 py-2.5 rounded-xl border @error('unit') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                    @error('unit') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-stone-700 mb-1.5">Deskripsi Produk <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="4" maxlength="2000" required
                          placeholder="Jelaskan komposisi, rasa, dan keunggulan produk..."
                          class="w-full px-4 py-2.5 rounded-xl border @error('description') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">{{ old('description') }}</textarea>
                @error('description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-stone-700 mb-1.5">Foto Produk (JPG/PNG/WEBP, maks 2 MB) <span class="text-red-500">*</span></label>
                <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" required
                       class="w-full text-sm text-stone-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100">
                @error('image') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-2.5 pt-1">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" @checked(old('is_featured'))
                       class="w-4 h-4 rounded border-stone-300 text-amber-700 focus:ring-amber-600">
                <label for="is_featured" class="text-sm font-medium text-stone-700">Tandai sebagai Produk Unggulan</label>
            </div>

            <div class="pt-4 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-300 text-stone-700 text-sm font-semibold hover:bg-stone-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-700 text-white text-sm font-semibold hover:bg-amber-800 transition shadow-sm">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
@endsection
