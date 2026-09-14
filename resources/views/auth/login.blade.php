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
<body class="antialiased text-slate-900 bg-slate-50 min-h-screen flex selection:bg-brand-500 selection:text-white relative"
      x-data="{ 
          openDemo: true, 
          emailVal: '{{ old('email') }}', 
          passVal: '', 
          fillAndLogin(email, pass, autoSubmit = false) { 
              this.emailVal = email; 
              this.passVal = pass; 
              if(autoSubmit) { 
                  this.$nextTick(() => document.getElementById('login-form').submit()); 
              } 
          } 
      }">

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

            <form id="login-form" method="POST" action="{{ route('login') }}" class="space-y-5" x-data="{ showPass: false }">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <input id="email" type="email" name="email" x-model="emailVal" required autofocus autocomplete="username" 
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
                        <input id="password" :type="showPass ? 'text' : 'password'" name="password" x-model="passVal" required autocomplete="current-password" 
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

    <!-- FLOATING POPUP: AKUN DEMO PENGUJIAN (TOGGLE BISA DIBUKA / DITUTUP) -->
    <div class="fixed bottom-6 right-6 z-50">
        <!-- Tombol Pembuka Floating (Muncul saat popup ditutup) -->
        <button type="button" 
                @click="openDemo = true" 
                x-show="!openDemo" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                class="flex items-center space-x-2.5 bg-slate-900 hover:bg-slate-800 text-white px-5 py-3.5 rounded-full shadow-2xl border-2 border-brand-400/80 hover:border-brand-400 group transition-all transform hover:scale-105">
            <span class="flex h-3 w-3 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            <span class="text-xs sm:text-sm font-black tracking-wide text-brand-300 group-hover:text-emerald-300">
                🔑 Akun Demo (Admin / User)
            </span>
            <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
        </button>

        <!-- Kartu Popup Modal Demo (Muncul saat terbuka) -->
        <div x-show="openDemo" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-6 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-6 scale-95"
             class="w-[90vw] max-w-sm sm:w-96 bg-slate-900/95 border border-brand-500/40 rounded-3xl p-5 shadow-2xl backdrop-blur-xl text-white relative">
            
            <!-- Header Kartu -->
            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-800">
                <div class="flex items-center space-x-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <h3 class="text-sm font-black text-white tracking-tight">Akun Demo Pengujian</h3>
                </div>
                <button type="button" 
                        @click="openDemo = false" 
                        title="Sembunyikan popup akun demo"
                        class="w-7 h-7 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <p class="text-xs text-slate-300 mb-3.5 leading-relaxed">
                Pilih peran di bawah untuk mencoba aplikasi langsung tanpa perlu mendaftar:
            </p>

            <div class="space-y-3">
                <!-- 1. Akun Admin -->
                <div class="bg-slate-800/90 rounded-2xl p-3.5 border border-slate-700/80 transition-all hover:border-brand-500/50 group">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-brand-500 text-slate-950">
                            🛡️ Administrator
                        </span>
                        <span class="text-[11px] text-slate-400">Full Dashboard</span>
                    </div>
                    <div class="text-xs space-y-0.5 text-slate-300 font-mono mb-3">
                        <div>Email: <strong class="text-white">admin@admin.com</strong></div>
                        <div>Pass: <strong class="text-emerald-400">password</strong></div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" 
                                @click="fillAndLogin('admin@admin.com', 'password', false)"
                                class="w-full py-2 px-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-bold text-xs transition-colors">
                            Isi Form
                        </button>
                        <button type="button" 
                                @click="fillAndLogin('admin@admin.com', 'password', true)"
                                class="w-full py-2 px-3 rounded-xl bg-gradient-to-r from-brand-500 to-emerald-400 hover:from-brand-400 hover:to-emerald-300 text-slate-950 font-black text-xs shadow-glow-green transition-all flex items-center justify-center">
                            Masuk Langsung &rarr;
                        </button>
                    </div>
                </div>

                <!-- 2. Akun Pelanggan -->
                <div class="bg-slate-800/90 rounded-2xl p-3.5 border border-slate-700/80 transition-all hover:border-blue-500/50 group">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-blue-500 text-white">
                            ⚽ Pengguna / Member
                        </span>
                        <span class="text-[11px] text-slate-400">Booking & Tiket</span>
                    </div>
                    <div class="text-xs space-y-0.5 text-slate-300 font-mono mb-3">
                        <div>Email: <strong class="text-white">sapik@gmail.com</strong></div>
                        <div>Pass: <strong class="text-blue-400">password</strong></div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" 
                                @click="fillAndLogin('sapik@gmail.com', 'password', false)"
                                class="w-full py-2 px-3 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-bold text-xs transition-colors">
                            Isi Form
                        </button>
                        <button type="button" 
                                @click="fillAndLogin('sapik@gmail.com', 'password', true)"
                                class="w-full py-2 px-3 rounded-xl bg-gradient-to-r from-blue-500 to-cyan-400 hover:from-blue-400 hover:to-cyan-300 text-white font-black text-xs shadow-md transition-all flex items-center justify-center">
                            Masuk Langsung &rarr;
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer Popup -->
            <div class="mt-3.5 pt-3 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
                <span>Klik ✕ atau Sembunyikan</span>
                <button type="button" @click="openDemo = false" class="text-brand-400 hover:text-brand-300 font-bold hover:underline">
                    Sembunyikan Bantuan
                </button>
            </div>
        </div>
    </div>

</body>
</html>
