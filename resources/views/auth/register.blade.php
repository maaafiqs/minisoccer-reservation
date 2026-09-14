<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - Maaafiqs Mini Soccer</title>
    
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

    <!-- Left Form Panel -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 overflow-y-auto">
        <div class="max-w-md w-full my-auto py-8">
            
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
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Daftar Akun Member</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Gabung bersama ribuan pemain dan nikmati booking cepat 24 jam.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Nama Lengkap
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                           placeholder="Nama lengkap Anda"
                           class="w-full px-4 py-3.5 rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-sm font-bold text-slate-800 shadow-sm transition-colors">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Alamat Email
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                           placeholder="nama@email.com"
                           class="w-full px-4 py-3.5 rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-sm font-bold text-slate-800 shadow-sm transition-colors">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Kata Sandi
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" 
                           placeholder="Minimal 8 karakter"
                           class="w-full px-4 py-3.5 rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-sm font-bold text-slate-800 shadow-sm transition-colors">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Konfirmasi Kata Sandi
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                           placeholder="Ulangi kata sandi Anda"
                           class="w-full px-4 py-3.5 rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-sm font-bold text-slate-800 shadow-sm transition-colors">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="btn-shimmer w-full py-4 rounded-2xl font-black text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-500 hover:to-emerald-400 shadow-glow-green transform hover:-translate-y-0.5 transition-all text-sm">
                        Buat Akun Sekarang
                    </button>
                </div>
                
                <div class="pt-4 text-center text-xs text-slate-500">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="font-black text-brand-600 hover:text-brand-700 underline ml-1">
                        Masuk di sini
                    </a>
                </div>
            </form>

        </div>
    </div>

    <!-- Right Visual Panel (Desktop) -->
    <div class="hidden lg:flex w-1/2 bg-sports-mesh bg-pitch-grid relative overflow-hidden flex-col justify-between p-12 text-white">
        <!-- Ambient Floodlight Glow -->
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Top Brand Logo -->
        <div class="relative z-10 text-right">
            <a href="/" class="inline-flex items-center space-x-3 group">
                <div class="flex flex-col text-right">
                    <span class="font-black text-xl tracking-tight text-white group-hover:text-emerald-300 transition-colors">
                        Maaafiqs
                    </span>
                    <span class="text-[10px] tracking-widest uppercase font-bold text-brand-400 -mt-1">
                        Mini Soccer Arena
                    </span>
                </div>
                <div class="w-11 h-11">
                    <x-application-logo class="w-full h-full drop-shadow-md" />
                </div>
            </a>
        </div>

        <!-- Central Feature Box -->
        <div class="relative z-10 max-w-lg my-auto">
            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-brand-500/20 text-emerald-300 border border-brand-500/30 inline-block mb-4">
                ● KEUNTUNGAN MEMBER
            </span>
            <h2 class="text-4xl xl:text-5xl font-black tracking-tight leading-tight mb-4">
                Dapatkan Promo & Prioritas Booking.
            </h2>
            <p class="text-slate-300 text-base font-light leading-relaxed mb-8">
                Dengan menjadi member resmi, Anda dapat mengumpulkan poin reward, memakai kode promo voucher diskon, dan mencetak invoice PDF untuk pembukuan tim.
            </p>

            <div class="space-y-3 text-xs font-bold text-slate-300 border-t border-slate-800 pt-6">
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">✓</div>
                    <span>Prioritas pemesanan jadwal di jam prime night</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">✓</div>
                    <span>Dukungan turnamen internal & rompi tim gratis</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">✓</div>
                    <span>Sistem bukti pembayaran digital tanpa antre</span>
                </div>
            </div>
        </div>

        <!-- Bottom Note -->
        <div class="relative z-10 text-xs text-slate-500 text-right">
            &copy; {{ date('Y') }} Maaafiqs Mini Soccer Arena.
        </div>
    </div>

</body>
</html>
