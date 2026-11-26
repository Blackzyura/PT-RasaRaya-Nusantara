<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — PT RasaRaya Nusantara</title>
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
                    <h1 class="font-display text-2xl font-bold text-stone-900">Daftar Akun Baru</h1>
                    <p class="text-xs font-semibold tracking-widest uppercase text-amber-700 mt-1">PT RasaRaya Nusantara</p>
                </div>
                <p class="text-sm text-stone-500">Buat akun pelanggan untuk terhubung dengan UMKM kami.</p>
            </div>

            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm space-y-0.5">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-stone-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="100" required autofocus
                           placeholder="Nama Anda"
                           class="w-full px-4 py-2.5 rounded-xl border @error('name') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-stone-700 mb-1.5">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="120" required
                           placeholder="nama@email.com"
                           class="w-full px-4 py-2.5 rounded-xl border @error('email') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-stone-700 mb-1.5">Password (min. 6 karakter)</label>
                    <input type="password" name="password" id="password" minlength="6" required
                           placeholder="••••••••"
                           class="w-full px-4 py-2.5 rounded-xl border @error('password') border-red-400 @else border-stone-300 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-stone-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" minlength="6" required
                           placeholder="Ulangi password"
                           class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-600">
                </div>

                <button type="submit"
                        class="w-full py-3 rounded-xl bg-amber-700 text-white font-bold text-sm hover:bg-amber-800 transition shadow-md">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center text-sm text-stone-600 space-y-2 pt-2 border-t border-stone-100">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-amber-700 hover:text-amber-800">Masuk di sini</a></p>
                <p><a href="{{ route('home') }}" class="text-xs font-semibold text-stone-500 hover:text-stone-800">&larr; Kembali ke Beranda</a></p>
            </div>
        </div>
    </div>
</body>
</html>
