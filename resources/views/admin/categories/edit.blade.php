@extends('layouts.admin')

@section('title', 'Ubah Kategori — Admin PT RasaRaya Nusantara')

@section('content')
    <div class="max-w-xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-stone-900">Ubah Kategori</h1>
            <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold text-stone-600 hover:text-stone-900">&larr; Kembali</a>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST"
              class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-semibold text-stone-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" maxlength="80" required
                       class="w-full px-4 py-2.5 rounded-xl border @error('name') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-stone-700 mb-1.5">Deskripsi Singkat</label>
                <textarea name="description" id="description" rows="3" maxlength="255"
                          class="w-full px-4 py-2.5 rounded-xl border @error('description') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">{{ old('description', $category->description) }}</textarea>
                @error('description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 border-t border-stone-100 flex justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-5 py-2.5 rounded-xl border border-stone-300 text-stone-700 text-sm font-semibold hover:bg-stone-50">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-amber-700 text-white text-sm font-semibold hover:bg-amber-800 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
