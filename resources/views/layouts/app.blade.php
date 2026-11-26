<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT RasaRaya Nusantara — Kuliner & Rempah Autentik UMKM Indonesia')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-amber-50/40 text-stone-800 antialiased flex flex-col min-h-screen">
    <!-- Navbar -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-amber-200/70 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo PT RasaRaya Nusantara" class="h-11 sm:h-12 w-11 sm:w-12 rounded-xl object-contain">
                    <div class="leading-tight">
                        <span class="font-display font-bold text-lg sm:text-xl text-amber-900 block">RasaRaya</span>
                        <span class="text-[10px] font-bold tracking-[0.2em] text-amber-700 uppercase block">PT RasaRaya Nusantara</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-stone-700">
                    <a href="{{ route('home') }}" class="hover:text-amber-700 transition">Beranda</a>
                    <a href="{{ route('home') }}#tentang-usaha" class="hover:text-amber-700 transition">Tentang Usaha</a>
                    <a href="{{ route('home') }}#katalog-produk" class="hover:text-amber-700 transition">Katalog Produk</a>
                    @auth
                        <span class="text-xs text-stone-500 font-medium">Halo, <strong class="text-stone-800">{{ auth()->user()->name }}</strong></span>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.products.index') }}"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-700 text-white hover:bg-amber-800 transition shadow-sm">
                                Admin Panel
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3.5 py-2 rounded-xl border border-stone-300 text-stone-700 hover:bg-stone-100 transition">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 rounded-xl border border-amber-700 text-amber-800 hover:bg-amber-50 transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 rounded-xl bg-amber-700 text-white hover:bg-amber-800 transition shadow-sm">
                            Daftar
                        </a>
                    @endauth
                </nav>

                <!-- Mobile Menu Button -->
                <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                        class="md:hidden p-2 rounded-lg text-stone-700 hover:bg-amber-100 transition" aria-label="Toggle Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Nav -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2 border-t border-amber-100 pt-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-stone-700 hover:bg-amber-50">Beranda</a>
                <a href="{{ route('home') }}#tentang-usaha" class="block px-3 py-2 rounded-lg text-sm font-semibold text-stone-700 hover:bg-amber-50">Tentang Usaha</a>
                <a href="{{ route('home') }}#katalog-produk" class="block px-3 py-2 rounded-lg text-sm font-semibold text-stone-700 hover:bg-amber-50">Katalog Produk</a>
                @auth
                    <p class="px-3 py-1 text-xs text-stone-500">Masuk sebagai <strong>{{ auth()->user()->name }}</strong></p>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold bg-amber-700 text-white text-center">Admin Panel</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-3 py-2 rounded-lg text-sm font-semibold border border-stone-300 text-stone-700 text-center">Keluar</button>
                    </form>
                @else
                    <div class="grid grid-cols-2 gap-2 pt-1">
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold border border-amber-700 text-amber-800 text-center">Masuk</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold bg-amber-700 text-white text-center">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    @if(session('success') || session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if(session('success'))
                <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="font-bold">&times;</button>
                </div>
            @endif
            @if(session('error'))
                <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-medium flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="font-bold">&times;</button>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-stone-900 text-stone-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="inline-flex items-center gap-3 bg-white px-3.5 py-2.5 rounded-2xl mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo PT RasaRaya Nusantara" class="h-10 w-10 rounded-lg object-contain">
                    <div class="leading-tight">
                        <span class="font-display font-bold text-base text-amber-900 block">RasaRaya</span>
                        <span class="text-[9px] font-bold tracking-[0.18em] text-amber-700 uppercase block">PT RasaRaya Nusantara</span>
                    </div>
                </div>
                <p class="text-sm text-stone-400 leading-relaxed">
                    PT RasaRaya Nusantara adalah UMKM kuliner dan olahan rempah asli Indonesia yang menghadirkan sambal, bumbu tradisional, camilan renyah, dan minuman herbal berkualitas.
                </p>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3">Navigasi</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition">Beranda</a></li>
                    <li><a href="{{ route('home') }}#tentang-usaha" class="hover:text-amber-400 transition">Tentang PT RasaRaya Nusantara</a></li>
                    <li><a href="{{ route('home') }}#katalog-produk" class="hover:text-amber-400 transition">Katalog Produk</a></li>
                    <li><a href="{{ route('admin.products.index') }}" class="hover:text-amber-400 transition">Halaman Admin (CRUD)</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3">Kontak UMKM</h3>
                <ul class="space-y-2 text-sm text-stone-400">
                    <li>Jl. Rempah Nusantara No. 45, Yogyakarta</li>
                    <li>Email: halo@rasarayanusantara.co.id</li>
                    <li>WhatsApp: +62 812-3456-7890</li>
                    <li>Jam Operasional: Senin – Sabtu, 08.00 – 17.00 WIB</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-stone-800 py-4 text-center text-xs text-stone-500">
            &copy; {{ date('Y') }} PT RasaRaya Nusantara. Hak Cipta Dilindungi.
        </div>
    </footer>
</body>
</html>
