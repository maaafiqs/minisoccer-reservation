<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Maaafiqs Mini Soccer</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased text-slate-900 bg-slate-50 min-h-screen flex selection:bg-brand-500 selection:text-white">

    <!-- Left Visual Panel (Desktop) -->
    <div class="hidden lg:flex w-1/2 bg-sports-mesh bg-pitch-grid relative overflow-hidden flex-col justify-between p-12 text-white">
        <!-- Ambient Floodlight Glow -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Top Brand Logo -->
        <div class="relative z-10">
            <a href="/" class="inline-flex items-center space-x-3 group">
                <div class="w-11 h-11">
                    <x-application-logo class="w-full h-full drop-shadow-md" />
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-xl tracking-tight text-white group-hover:text-emerald-300 transition-colors">
                        Maaafiqs
                    </span>
                    <span class="text-[10px] tracking-widest uppercase font-bold text-brand-400 -mt-1">
                        Mini Soccer Arena
                    </span>
                </div>
            </a>
        </div>

        <!-- Central Quote & Value Proposition -->
        <div class="relative z-10 max-w-lg my-auto">
            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-brand-500/20 text-emerald-300 border border-brand-500/30 inline-block mb-4">
                ● 24/7 ONLINE BOOKING SYSTEM
            </span>
            <h2 class="text-4xl xl:text-5xl font-black tracking-tight leading-tight mb-4">
                Satu Akun untuk Semua Jadwal Pertandingan.
            </h2>
            <p class="text-slate-300 text-base font-light leading-relaxed mb-8">
                Cek jadwal real-time, dapatkan promo eksklusif member, dan nikmati kemudahan e-tiket instan tanpa menunggu konfirmasi manual yang lama.
            </p>

            <div class="flex items-center space-x-6 text-xs text-slate-400 font-bold border-t border-slate-800 pt-6">
                <div class="flex items-center">
                    <span class="text-emerald-400 mr-2">✓</span> Rumput FIFA Grade
                </div>
                <div class="flex items-center">
                    <span class="text-emerald-400 mr-2">✓</span> Lampu LED 1200 Lux
                </div>
                <div class="flex items-center">
                    <span class="text-emerald-400 mr-2">✓</span> Parkir Luas & Aman
                </div>
            </div>
        </div>

        <!-- Bottom Note -->
        <div class="relative z-10 text-xs text-slate-500">
            &copy; {{ date('Y') }} Maaafiqs Mini Soccer. All rights reserved.
        </div>
    </div>

    <!-- Right Form Panel -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 overflow-y-auto">
        <div class="max-w-md w-full my-auto">
            
            <!-- Mobile Brand Header -->
            <div class="text-center mb-8 lg:hidden">
                <a href="/" class="inline-flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10">
                        <x-application-logo class="w-full h-full drop-shadow-md" />
                    </div>
                    <span class="font-black text-xl text-slate-900">Maaafiqs Mini Soccer</span>
                </a>
            </div>

            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Selamat Datang Kembali</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Masuk ke akun Anda untuk memesan lapangan & kelola jadwal main.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5" x-data="{ showPass: false }">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                               placeholder="nama@email.com"
                               class="w-full px-4 py-3.5 rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-sm font-bold text-slate-800 shadow-sm transition-colors">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-black uppercase tracking-wider text-slate-500">
                            Kata Sandi
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <input id="password" :type="showPass ? 'text' : 'password'" name="password" required autocomplete="current-password" 
                               placeholder="••••••••"
                               class="w-full px-4 py-3.5 rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-sm font-bold text-slate-800 shadow-sm transition-colors pr-12">
                        <button type="button" @click="showPass = !showPass" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-1 text-xs font-bold">
                            <span x-text="showPass ? 'Sembunyikan' : 'Lihat'"></span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-brand-600 focus:ring-brand-500 border-slate-300 rounded">
                    <label for="remember_me" class="ml-2 block text-xs font-bold text-slate-600">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-shimmer w-full py-4 rounded-2xl font-black text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-500 hover:to-emerald-400 shadow-glow-green transform hover:-translate-y-0.5 transition-all text-sm">
                    Masuk Sekarang
                </button>
                
                <div class="pt-4 text-center text-xs text-slate-500">
                    Belum memiliki akun pemain? 
                    <a href="{{ route('register') }}" class="font-black text-brand-600 hover:text-brand-700 underline ml-1">
                        Daftar akun baru di sini
                    </a>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
