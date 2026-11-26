<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel — PT RasaRaya Nusantara')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-stone-100 text-stone-800 antialiased min-h-screen flex flex-col">
    <!-- Admin Topbar -->
    <header class="bg-white border-b border-stone-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2.5">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo PT RasaRaya Nusantara" class="h-9 w-9 rounded-lg object-contain">
                    <span class="font-bold text-stone-900 text-sm sm:text-base">PT RasaRaya Nusantara</span>
                </a>
                <span class="hidden sm:inline-block px-2.5 py-0.5 rounded-md bg-amber-100 text-amber-800 text-xs font-bold">
                    ADMIN PANEL
                </span>
            </div>

            <nav class="flex items-center gap-2 sm:gap-3 text-sm font-semibold">
                <a href="{{ route('admin.products.index') }}"
                   class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.products.*') ? 'bg-amber-700 text-white' : 'text-stone-600 hover:bg-stone-100' }}">
                    Produk
                </a>
                <a href="{{ route('admin.categories.index') }}"
                   class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.categories.*') ? 'bg-amber-700 text-white' : 'text-stone-600 hover:bg-stone-100' }}">
                    Kategori
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="px-3 py-2 rounded-lg transition {{ request()->routeIs('admin.users.*') ? 'bg-amber-700 text-white' : 'text-stone-600 hover:bg-stone-100' }}">
                    Pengguna
                </a>
                <a href="{{ route('home') }}"
                   class="px-3 py-2 rounded-lg border border-stone-300 text-stone-700 hover:bg-stone-50 transition">
                    Lihat Web
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="px-3 py-2 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 transition">
                        Keluar
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-medium flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-900 font-bold">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
