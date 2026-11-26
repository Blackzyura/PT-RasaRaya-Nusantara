@extends('layouts.app')

@section('title', 'PT RasaRaya Nusantara — Kuliner & Rempah Autentik UMKM Indonesia')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-amber-900 via-amber-800 to-stone-900 text-white">
        <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#fde68a 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-7 space-y-6">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/30 text-amber-200 text-xs font-semibold tracking-wide uppercase">
                    UMKM Unggulan Nusantara
                </span>
                <h1 class="font-display text-3xl sm:text-5xl font-bold leading-tight">
                    Cita Rasa Asli <span class="text-amber-300">PT RasaRaya Nusantara</span> untuk Meja Makan Anda
                </h1>
                <p class="text-amber-100/90 text-base sm:text-lg max-w-2xl leading-relaxed">
                    Menghadirkan aneka sambal khas daerah, bumbu rempah siap masak, camilan tradisional renyah, dan minuman herbal alami yang diolah secara higienis bersama petani lokal Indonesia.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="#katalog-produk" class="px-6 py-3 rounded-xl bg-amber-400 text-stone-900 font-bold text-sm hover:bg-amber-300 transition shadow-lg">
                        Jelajahi Produk
                    </a>
                    <a href="#tentang-usaha" class="px-6 py-3 rounded-xl bg-white/10 border border-white/25 text-white font-semibold text-sm hover:bg-white/20 transition">
                        Tentang Usaha Kami
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 sm:p-8 space-y-5 shadow-2xl">
                    <div class="flex items-center gap-4">
                        <div class="bg-white p-2 rounded-2xl shadow shrink-0">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo PT RasaRaya Nusantara" class="h-14 w-14 rounded-xl object-contain">
                        </div>
                        <div>
                            <p class="font-display text-xl font-bold text-white">PT RasaRaya Nusantara</p>
                            <p class="text-xs text-amber-200 tracking-wider uppercase font-semibold">Kuliner &amp; Rempah Nusantara</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div class="bg-black/20 rounded-2xl p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-amber-300">100%</p>
                            <p class="text-xs text-amber-100/80 mt-1">Rempah Alami Tanpa Pengawet</p>
                        </div>
                        <div class="bg-black/20 rounded-2xl p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-amber-300">{{ $products->count() }}+</p>
                            <p class="text-xs text-amber-100/80 mt-1">Varian Produk Pilihan</p>
                        </div>
                        <div class="bg-black/20 rounded-2xl p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-amber-300">{{ $categories->count() }}</p>
                            <p class="text-xs text-amber-100/80 mt-1">Kategori Kuliner Nusantara</p>
                        </div>
                        <div class="bg-black/20 rounded-2xl p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-amber-300">UMKM</p>
                            <p class="text-xs text-amber-100/80 mt-1">Pemberdayaan Petani Lokal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Usaha Section -->
    <section id="tentang-usaha" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
        <div class="bg-white rounded-3xl border border-amber-200/80 shadow-sm p-6 sm:p-12 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-7 space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-700">Profil & Deskripsi Usaha</span>
                <h2 class="font-display text-2xl sm:text-4xl font-bold text-stone-900">
                    Mengenal PT RasaRaya Nusantara
                </h2>
                <p class="text-stone-600 leading-relaxed">
                    <strong>PT RasaRaya Nusantara</strong> adalah usaha mikro, kecil, dan menengah (UMKM) yang bergerak di bidang produksi makanan olahan, bumbu rempah tradisional, dan minuman herbal khas Nusantara. Berawal dari dapur rumahan di Yogyakarta, kami berkomitmen menjaga warisan resep kuliner Indonesia agar tetap praktis dinikmati oleh keluarga modern.
                </p>
                <p class="text-stone-600 leading-relaxed">
                    Seluruh bahan baku seperti cabai rawit, ikan roa asap, jahe merah, kayu secang, dan tempe kedelai diperoleh langsung dari mitra petani serta perajin lokal. Setiap produk diproses secara higienis, dikemas kedap udara, dan bebas dari pengawet maupun pewarna sintetis.
                </p>
            </div>
            <div class="lg:col-span-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                <div class="p-5 rounded-2xl bg-amber-50 border border-amber-200/70">
                    <h3 class="font-bold text-stone-900 mb-1">Visi Usaha</h3>
                    <p class="text-sm text-stone-600">Menjadi UMKM kuliner dan rempah terpercaya yang membawa cita rasa autentik Indonesia ke setiap rumah tangga.</p>
                </div>
                <div class="p-5 rounded-2xl bg-orange-50 border border-orange-200/70">
                    <h3 class="font-bold text-stone-900 mb-1">Komitmen Kualitas</h3>
                    <p class="text-sm text-stone-600">Mengutamakan bahan segar, standar kebersihan tinggi, serta kemasan aman untuk pengiriman ke seluruh Indonesia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Katalog Produk Section -->
    <section id="katalog-produk" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-amber-700">Produk Unggulan</span>
                <h2 class="font-display text-2xl sm:text-4xl font-bold text-stone-900 mt-1">Katalog Produk Nusantara</h2>
            </div>

            <!-- Search Form -->
            <form action="{{ route('home') }}#katalog-produk" method="GET" class="flex gap-2 w-full md:w-80">
                @if($activeCategory)
                    <input type="hidden" name="kategori" value="{{ $activeCategory }}">
                @endif
                <input type="text" name="cari" value="{{ $search }}" placeholder="Cari sambal, bumbu, wedang..."
                       class="w-full px-4 py-2.5 rounded-xl border border-stone-300 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-amber-700 text-white text-sm font-semibold hover:bg-amber-800 transition shrink-0">
                    Cari
                </button>
            </form>
        </div>

        <!-- Category Filter Pills -->
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('home') }}#katalog-produk"
               class="px-4 py-2 rounded-full text-sm font-semibold transition {{ !$activeCategory ? 'bg-amber-700 text-white shadow-sm' : 'bg-white text-stone-700 border border-stone-200 hover:border-amber-400' }}">
                Semua Kategori
            </a>
            @foreach($categories as $category)
                <a href="{{ route('home', ['kategori' => $category->slug, 'cari' => $search ?: null]) }}#katalog-produk"
                   class="px-4 py-2 rounded-full text-sm font-semibold transition {{ $activeCategory === $category->slug ? 'bg-amber-700 text-white shadow-sm' : 'bg-white text-stone-700 border border-stone-200 hover:border-amber-400' }}">
                    {{ $category->name }} ({{ $category->products_count }})
                </a>
            @endforeach
        </div>

        <!-- Product Grid -->
        @if($products->isEmpty())
            <div class="bg-white rounded-3xl border border-stone-200 p-12 text-center">
                <p class="text-stone-600 font-medium">Produk tidak ditemukan untuk pencarian atau kategori yang dipilih.</p>
                <a href="{{ route('home') }}#katalog-produk" class="inline-block mt-4 px-5 py-2.5 rounded-xl bg-amber-700 text-white text-sm font-semibold hover:bg-amber-800 transition">
                    Reset Filter
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <article class="bg-white rounded-3xl border border-amber-100 shadow-sm hover:shadow-lg transition overflow-hidden flex flex-col group">
                        <a href="{{ route('products.show', $product->slug) }}" class="relative aspect-square bg-amber-50 overflow-hidden block">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-stone-400 text-sm">Tidak ada foto</div>
                            @endif

                            @if($product->is_featured)
                                <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-amber-600 text-white text-xs font-bold shadow">
                                    Unggulan
                                </span>
                            @endif
                        </a>

                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-100 text-amber-800">
                                    {{ $product->category->name }}
                                </span>
                                <span class="text-xs text-stone-500">Stok: {{ $product->stock }}</span>
                            </div>

                            <h3 class="font-bold text-lg text-stone-900 mb-1 line-clamp-1">
                                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-amber-700 transition">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <p class="text-sm text-stone-600 line-clamp-2 mb-4 flex-1">
                                {{ $product->description }}
                            </p>

                            <div class="flex items-center justify-between pt-3 border-t border-stone-100">
                                <div>
                                    <p class="text-lg font-bold text-amber-800">{{ $product->formatted_price }}</p>
                                    <p class="text-xs text-stone-500">per {{ $product->unit }}</p>
                                </div>
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="px-4 py-2 rounded-xl bg-stone-900 text-white text-xs font-semibold hover:bg-amber-700 transition">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
