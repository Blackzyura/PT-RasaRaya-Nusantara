@extends('layouts.app')

@section('title', $product->name . ' — PT RasaRaya Nusantara')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-stone-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-amber-700 transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('home', ['kategori' => $product->category->slug]) }}#katalog-produk" class="hover:text-amber-700 transition">
                {{ $product->category->name }}
            </a>
            <span>/</span>
            <span class="text-stone-800 font-medium truncate">{{ $product->name }}</span>
        </nav>

        <!-- Product Detail Card -->
        <div class="bg-white rounded-3xl border border-amber-100 shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-12">
            <div class="lg:col-span-5 bg-amber-50 aspect-square lg:aspect-auto">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full min-h-[320px] flex items-center justify-center text-stone-400">Tidak ada foto</div>
                @endif
            </div>

            <div class="lg:col-span-7 p-6 sm:p-10 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-bold">
                            {{ $product->category->name }}
                        </span>
                        @if($product->is_featured)
                            <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-800 text-xs font-bold">
                                Produk Unggulan
                            </span>
                        @endif
                    </div>

                    <h1 class="font-display text-2xl sm:text-4xl font-bold text-stone-900">
                        {{ $product->name }}
                    </h1>

                    <div class="flex items-baseline gap-3">
                        <span class="text-3xl font-bold text-amber-800">{{ $product->formatted_price }}</span>
                        <span class="text-sm text-stone-500">/ {{ $product->unit }}</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 py-3 border-y border-stone-100 text-sm">
                        <div>
                            <p class="text-stone-500 text-xs">Ketersediaan Stok</p>
                            <p class="font-semibold text-stone-800">{{ $product->stock }} {{ $product->unit }}</p>
                        </div>
                        <div>
                            <p class="text-stone-500 text-xs">Kemasan</p>
                            <p class="font-semibold text-stone-800">{{ $product->unit }}</p>
                        </div>
                        <div>
                            <p class="text-stone-500 text-xs">Produsen</p>
                            <p class="font-semibold text-stone-800">PT RasaRaya Nusantara</p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold uppercase tracking-wider text-stone-500 mb-2">Deskripsi Produk</h2>
                        <p class="text-stone-700 leading-relaxed whitespace-pre-line">{{ $product->description }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-4">
                    @auth
                        <a href="https://wa.me/6281234567890?text={{ urlencode('Halo PT RasaRaya Nusantara, saya ' . auth()->user()->name . ' ingin memesan ' . $product->name . ' (' . $product->formatted_price . ').') }}"
                           target="_blank" rel="noopener"
                           class="flex-1 sm:flex-none text-center px-6 py-3 rounded-xl bg-amber-700 text-white font-bold text-sm hover:bg-amber-800 transition shadow">
                            Pesan via WhatsApp
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="flex-1 sm:flex-none text-center px-6 py-3 rounded-xl bg-amber-700 text-white font-bold text-sm hover:bg-amber-800 transition shadow">
                            Masuk untuk Memesan via WhatsApp
                        </a>
                    @endauth
                    <a href="{{ route('home') }}#katalog-produk"
                       class="px-6 py-3 rounded-xl border border-stone-300 text-stone-700 font-semibold text-sm hover:bg-stone-100 transition">
                        Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->isNotEmpty())
            <section class="mt-14">
                <h2 class="font-display text-2xl font-bold text-stone-900 mb-6">Produk Serupa Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related->slug) }}"
                           class="bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-md transition flex items-center gap-4 p-3">
                            <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}"
                                 class="w-20 h-20 rounded-xl object-cover shrink-0 bg-amber-50">
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-amber-700">{{ $related->category->name }}</p>
                                <h3 class="font-bold text-stone-900 truncate">{{ $related->name }}</h3>
                                <p class="text-sm font-bold text-stone-700 mt-1">{{ $related->formatted_price }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
