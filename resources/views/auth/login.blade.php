<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — PT RasaRaya Nusantara</title>
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
<body class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50/60 to-stone-100 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl border border-amber-200/80 shadow-xl p-7 sm:p-9 space-y-6">
            <div class="text-center space-y-3">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo PT RasaRaya Nusantara" class="h-16 w-16 rounded-2xl object-contain shadow-sm">
                </a>
                <div>
                    <h1 class="font-display text-2xl font-bold text-stone-900">Masuk Akun</h1>
                    <p class="text-xs font-semibold tracking-widest uppercase text-amber-700 mt-1">PT RasaRaya Nusantara</p>
                </div>
                <p class="text-sm text-stone-500">Masuk sebagai pelanggan atau admin UMKM.</p>
            </div>

            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           placeholder="nama@email.com"
                           class="w-full px-4 py-2.5 rounded-xl border @error('email') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">Password</label>
                    <input type="password" name="password" id="password" required
                           placeholder="••••••••"
                           class="w-full px-4 py-2.5 rounded-xl border @error('password') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="inline-flex items-center gap-2 text-stone-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-amber-700 focus:ring-amber-600">
                        <span>Ingat saya</span>
                    </label>
                    <a href="{{ route('home') }}" class="font-semibold text-amber-700 hover:text-amber-800">
                        &larr; Ke Halaman Publik
                    </a>
                </div>

                <button type="submit"
                        class="w-full py-3 rounded-xl bg-amber-700 text-white font-bold text-sm hover:bg-amber-800 transition shadow-md">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-stone-600">
                Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-amber-700 hover:text-amber-800">Daftar di sini</a>
            </p>

            <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200/70 text-xs text-stone-600 space-y-1">
                <p class="font-bold text-amber-900">Akun Admin Default (Seeder):</p>
                <p>Email: <code class="font-mono bg-white px-1.5 py-0.5 rounded border border-amber-200">admin@rasarayanusantara.co.id</code></p>
                <p>Password: <code class="font-mono bg-white px-1.5 py-0.5 rounded border border-amber-200">password</code></p>
            </div>
        </div>
    </div>
</body>
</html>
