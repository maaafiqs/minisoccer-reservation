<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maaafiqs Mini Soccer - Sewa Lapangan Mini Soccer Standar FIFA</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-900 selection:bg-brand-500 selection:text-white">

    <!-- Top Announcement Marquee (If Active) -->
    @if(isset($announcements) && $announcements->count() > 0)
    <div class="bg-gradient-to-r from-slate-900 via-brand-950 to-slate-900 border-b border-brand-500/30 text-white text-xs sm:text-sm py-2 px-4 shadow-sm relative z-50">
        <div class="max-w-7xl mx-auto flex items-center">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-brand-500 text-slate-950 uppercase tracking-wider mr-3 shrink-0 shadow-glow-green">
                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>
                PENGUMUMAN
            </span>
            <marquee class="font-semibold text-emerald-200" onmouseover="this.stop();" onmouseout="this.start();">
                @foreach($announcements as $announcement)
                    <span class="mx-6">
                        <strong class="text-white">{{ $announcement->title }}:</strong> {{ $announcement->content }}
                    </span>
                @endforeach
            </marquee>
        </div>
    </div>
    @endif

    <!-- Global Navigation -->
    <nav class="glass-nav sticky top-0 z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand Emblem -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-11 h-11 transition-transform duration-300 group-hover:scale-105">
                            <x-application-logo class="w-full h-full drop-shadow-md" />
                        </div>
                        <div class="flex flex-col">
                            <span class="font-black text-xl tracking-tight text-slate-900 group-hover:text-brand-600 transition-colors">
                                Maaafiqs
                            </span>
                            <span class="text-[10px] tracking-widest uppercase font-bold text-brand-600 -mt-1">
                                Mini Soccer Arena
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                    <a href="#cek-jadwal" class="px-3.5 py-2 rounded-full text-sm font-bold text-slate-600 hover:text-brand-600 hover:bg-brand-50 transition-all">
                        Cek Jadwal
                    </a>
                    <a href="#lapangan" class="px-3.5 py-2 rounded-full text-sm font-bold text-slate-600 hover:text-brand-600 hover:bg-brand-50 transition-all">
                        Lapangan & Tarif
                    </a>
                    <a href="#fasilitas" class="px-3.5 py-2 rounded-full text-sm font-bold text-slate-600 hover:text-brand-600 hover:bg-brand-50 transition-all">
                        Fasilitas
                    </a>
                    <a href="#galeri" class="px-3.5 py-2 rounded-full text-sm font-bold text-slate-600 hover:text-brand-600 hover:bg-brand-50 transition-all">
                        Galeri
                    </a>
                    <a href="#faq" class="px-3.5 py-2 rounded-full text-sm font-bold text-slate-600 hover:text-brand-600 hover:bg-brand-50 transition-all">
                        FAQ
                    </a>
                </div>

                <!-- Auth Action Buttons -->
                <div class="hidden sm:flex items-center space-x-3">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full text-sm font-extrabold text-slate-800 hover:text-brand-600 hover:bg-slate-100 transition-all">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full text-sm font-extrabold text-slate-800 hover:text-brand-600 hover:bg-slate-100 transition-all">
                                Dashboard Saya
                            </a>
                        @endif
                        <a href="{{ route('reservations.create') }}" class="btn-shimmer inline-flex items-center px-5 py-2.5 rounded-full text-sm font-extrabold text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-500 hover:to-emerald-400 shadow-glow-green transform hover:-translate-y-0.5 transition-all">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            Booking Baru
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-sm font-bold text-slate-700 hover:text-brand-600 hover:bg-slate-100 transition-all">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn-shimmer inline-flex items-center px-5 py-2.5 rounded-full text-sm font-extrabold text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-500 hover:to-emerald-400 shadow-glow-green transform hover:-translate-y-0.5 transition-all">
                            Daftar Akun
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Toggle -->
                <div class="flex items-center sm:hidden" x-data="{ mobileNav: false }">
                    <button @click="mobileNav = !mobileNav" class="p-2.5 rounded-xl text-slate-700 hover:bg-slate-100 border border-slate-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <!-- Mobile Menu Overlay -->
                    <div x-show="mobileNav" @click="mobileNav = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50"></div>
                    <div x-show="mobileNav" x-transition class="fixed top-0 right-0 w-4/5 max-w-sm h-full bg-white z-50 shadow-2xl p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-8">
                                <div class="flex items-center space-x-2">
                                    <x-application-logo class="w-8 h-8" />
                                    <span class="font-black text-lg">Maaafiqs</span>
                                </div>
                                <button @click="mobileNav = false" class="p-2 rounded-lg text-slate-400 hover:text-slate-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            <div class="space-y-3 font-bold text-slate-700">
                                <a href="#cek-jadwal" @click="mobileNav = false" class="block py-2 px-3 rounded-lg hover:bg-slate-50">Cek Jadwal</a>
                                <a href="#lapangan" @click="mobileNav = false" class="block py-2 px-3 rounded-lg hover:bg-slate-50">Lapangan & Tarif</a>
                                <a href="#fasilitas" @click="mobileNav = false" class="block py-2 px-3 rounded-lg hover:bg-slate-50">Fasilitas</a>
                                <a href="#galeri" @click="mobileNav = false" class="block py-2 px-3 rounded-lg hover:bg-slate-50">Galeri</a>
                                <a href="#faq" @click="mobileNav = false" class="block py-2 px-3 rounded-lg hover:bg-slate-50">FAQ</a>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-slate-100 space-y-3">
                            @auth
                                <a href="{{ route('dashboard') }}" class="block w-full text-center py-3 rounded-xl font-bold bg-slate-100 text-slate-800">Buka Dashboard</a>
                                <a href="{{ route('reservations.create') }}" class="block w-full text-center py-3 rounded-xl font-extrabold text-white bg-brand-600 shadow-md">Booking Sekarang</a>
                            @else
                                <a href="{{ route('login') }}" class="block w-full text-center py-3 rounded-xl font-bold bg-slate-100 text-slate-800">Masuk Akun</a>
                                <a href="{{ route('register') }}" class="block w-full text-center py-3 rounded-xl font-extrabold text-white bg-brand-600 shadow-md">Daftar Sekarang</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION: Premium Athletic Night Stadium -->
    <header class="relative bg-sports-mesh bg-pitch-grid overflow-hidden min-h-[90vh] flex items-center text-white py-16 sm:py-24">
        <!-- Stadium Floodlight Ambient Beams -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-32 w-[32rem] h-[32rem] bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Hero Copy -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <!-- Status Pill -->
                    <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-slate-800/80 border border-brand-500/40 backdrop-blur-md mb-6 shadow-glow-green">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-xs font-black uppercase tracking-widest text-emerald-300">
                            FIFA Certified Synthetic Turf • 24/7 Match Ready
                        </span>
                    </div>

                    <!-- Main Catchy Title -->
                    <h1 class="text-4xl sm:text-6xl xl:text-7xl font-black tracking-tight leading-[1.1] mb-6">
                        Main Bola Layaknya <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-green-400">
                            Bintang Profesional.
                        </span>
                    </h1>

                    <p class="text-base sm:text-xl text-slate-300 font-light leading-relaxed max-w-2xl mx-auto lg:mx-0 mb-8">
                        Fasilitas mini soccer paling prestisius dengan rumput sintetis standar internasional, sistem pencahayaan LED 1200 Lux tanpa silau, dan reservasi otomatis 24 jam.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 mb-10">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-full font-black text-slate-950 bg-brand-400 hover:bg-brand-300 shadow-glow-green transform hover:-translate-y-0.5 transition-all text-base">
                                    Buka Panel Admin
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @else
                                <a href="{{ route('reservations.create') }}" class="btn-shimmer w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-full font-black text-slate-950 bg-gradient-to-r from-emerald-400 to-brand-400 hover:from-emerald-300 hover:to-brand-300 shadow-glow-green transform hover:-translate-y-0.5 transition-all text-base">
                                    Pesan Lapangan Sekarang
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('reservations.create') }}" class="btn-shimmer w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-full font-black text-slate-950 bg-gradient-to-r from-emerald-400 to-brand-400 hover:from-emerald-300 hover:to-brand-300 shadow-glow-green transform hover:-translate-y-0.5 transition-all text-base">
                                Pesan Jadwal Sekarang
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @endauth
                        <a href="#cek-jadwal" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-full font-bold text-white bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700 backdrop-blur-md transition-all text-base">
                            <svg class="w-5 h-5 mr-2 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Cek Ketersediaan Jam
                        </a>
                    </div>

                    <!-- Highlight Badges -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 border-t border-slate-800/80 text-left">
                        <div>
                            <div class="text-2xl font-black text-white">4.9 ★</div>
                            <div class="text-xs text-slate-400 font-medium">500+ Review Positif</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-brand-400">1200 Lux</div>
                            <div class="text-xs text-slate-400 font-medium">LED Stadium Pro</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-white">100%</div>
                            <div class="text-xs text-slate-400 font-medium">FIFA Grade Monofilament</div>
                        </div>
                        <div>
                            <div class="text-2xl font-black text-brand-400">Instan</div>
                            <div class="text-xs text-slate-400 font-medium">Verifikasi Otomatis</div>
                        </div>
                    </div>
                </div>

                <!-- Right Hero Visual Card -->
                <div class="lg:col-span-5 relative">
                    <!-- Glow Behind Card -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-brand-500/30 to-emerald-400/30 rounded-3xl blur-2xl transform rotate-3 scale-95 pointer-events-none"></div>

                    <!-- Stadium Showcase Card -->
                    <div class="relative bg-slate-900/90 border border-slate-700/80 rounded-3xl p-4 sm:p-5 shadow-2xl backdrop-blur-xl overflow-hidden">
                        <div class="relative h-72 sm:h-80 rounded-2xl overflow-hidden mb-4">
                            <img src="{{ asset('images/hero_pitch_night.jpg') }}" 
                                 alt="Mini Soccer Stadium Night" 
                                 class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700" />
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-black bg-emerald-500 text-slate-950 shadow-md">
                                ARENA UTAMA
                            </span>
                            <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-emerald-300 font-bold uppercase tracking-wider">Maaafiqs Arena A</p>
                                    <p class="text-lg font-black text-white">Rumput Sintetis Monofilament</p>
                                </div>
                                <span class="text-xs font-black bg-slate-900/80 border border-slate-700 px-2.5 py-1 rounded-full text-white">
                                    7 vs 7 Players
                                </span>
                            </div>
                        </div>

                        <!-- Live Status Mini Bar -->
                        <div class="bg-slate-800/80 rounded-xl p-3 border border-slate-700/50 flex items-center justify-between text-xs">
                            <div class="flex items-center space-x-2">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                                </span>
                                <span class="font-bold text-slate-200">Sistem Booking Aktif</span>
                            </div>
                            <a href="#cek-jadwal" class="font-black text-brand-400 hover:text-brand-300 flex items-center">
                                Cek Jam Kosong &rarr;
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- SECTION: Cara Memesan (3 Langkah Mudah) -->
    <section class="py-20 bg-white border-b border-slate-100 relative" id="cara-pesan">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-brand-600 font-black text-xs uppercase tracking-widest bg-brand-50 px-3 py-1 rounded-full">
                    PRAKTIS & CEPAT
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                    Cara Mudah Memesan Lapangan
                </h2>
                <p class="text-slate-500 mt-3 text-base">
                    Hanya butuh 3 menit dari memilih jadwal hingga menerima tiket pertandingan resmi secara digital.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                <!-- Step 1 -->
                <div class="relative bg-slate-50 rounded-3xl p-8 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-brand-600 to-emerald-400 text-white flex items-center justify-center font-black text-2xl shadow-glow-green mb-6 group-hover:scale-110 transition-transform">
                        1
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-2">Pilih Lapangan & Jam</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Tentukan lapangan favorit Anda, pilih tanggal dan jam kosong yang tersedia. Sistem langsung mengunci jadwal Anda secara real-time.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="relative bg-slate-50 rounded-3xl p-8 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 to-cyan-400 text-white flex items-center justify-center font-black text-2xl shadow-md mb-6 group-hover:scale-110 transition-transform">
                        2
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-2">Transfer Pembayaran</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Transfer ke rekening resmi kami dan upload bukti transfer. Gunakan kode voucher promo jika Anda memilikinya untuk potongan harga.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative bg-slate-50 rounded-3xl p-8 border border-slate-200/80 hover:border-brand-300 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-400 text-slate-950 flex items-center justify-center font-black text-2xl shadow-md mb-6 group-hover:scale-110 transition-transform">
                        3
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-2">Siap Main di Lapangan!</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Dapatkan tiket PDF dengan barcode/QR. Tunjukkan kepada staf resepsionis arena saat tiba, dan nikmati pertandingan tim Anda!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: Real-time Schedule Checker -->
    <section class="py-20 bg-slate-50 border-b border-slate-200/80" id="cek-jadwal" x-data="scheduleChecker()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-brand-600 font-black text-xs uppercase tracking-widest bg-brand-100/60 px-3.5 py-1.5 rounded-full">
                    SISTEM REAL-TIME
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                    Cek Ketersediaan Jam Lapangan
                </h2>
                <p class="text-slate-500 mt-2 text-base">
                    Pilih lapangan dan tanggal di bawah untuk melihat slot jam yang masih tersedia secara akurat.
                </p>
            </div>

            <div class="max-w-4xl mx-auto bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-premium">
                <!-- Filter Controls -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pb-8 border-b border-slate-100">
                    <div>
                        <label for="check_field" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                            1. Pilih Lapangan Mini Soccer
                        </label>
                        <select id="check_field" x-model="selectedField" @change="resetSelection()" class="w-full rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-base font-bold text-slate-800 py-3.5 px-4 shadow-sm">
                            <option value="">-- Pilih Lapangan --</option>
                            @foreach($fields as $field)
                                <option value="{{ $field->id }}">{{ $field->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="check_date" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                            2. Pilih Tanggal Main
                        </label>
                        <input type="date" id="check_date" x-model="selectedDate" min="{{ date('Y-m-d') }}" @change="resetSelection()"
                               class="w-full rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-base font-bold text-slate-800 py-3.5 px-4 shadow-sm">
                    </div>
                </div>

                <!-- Legend & Quick Information -->
                <div class="flex flex-wrap items-center justify-between gap-4 py-4 mb-4 text-xs font-bold text-slate-500">
                    <div class="flex items-center space-x-5">
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-md bg-emerald-500 mr-2 shadow-sm"></span>
                            <span class="text-slate-800 font-bold">Tersedia</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-md bg-slate-200 mr-2"></span>
                            <span>Sudah Dipesan</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-3 h-3 rounded-md bg-brand-600 ring-2 ring-brand-300 mr-2"></span>
                            <span class="text-brand-700 font-black">Dipilih Anda</span>
                        </div>
                    </div>
                    <div class="text-slate-400">
                        Jam operasional: 08:00 - 24:00 WIB
                    </div>
                </div>

                <!-- Time Slots Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                    <template x-for="time in timeSlots" :key="time">
                        <button @click="selectTime(time)" :disabled="isBooked(time)"
                                class="rounded-2xl border-2 py-3 px-2 text-center font-bold transition-all duration-200 text-sm focus:outline-none flex flex-col items-center justify-center relative"
                                :class="{
                                    'bg-slate-100 text-slate-400 border-slate-200/60 cursor-not-allowed line-through opacity-60': isBooked(time),
                                    'bg-white text-slate-700 border-slate-200 hover:border-brand-400 hover:shadow-md': !isBooked(time) && selectedTime !== time,
                                    'bg-brand-600 text-white border-brand-600 shadow-glow-green -translate-y-0.5': selectedTime === time
                                }">
                            <span class="text-base font-black" x-text="time.substring(0,5)"></span>
                            <span class="text-[10px] mt-0.5 uppercase tracking-wider font-semibold opacity-75" x-text="getTimeTag(time)"></span>
                        </button>
                    </template>
                </div>

                <!-- Selected Slot Notification & Action -->
                <div class="mt-8 bg-gradient-to-r from-emerald-50 to-brand-50 p-6 rounded-2xl border border-brand-200 flex flex-col sm:flex-row items-center justify-between gap-4"
                     x-show="selectedTime" x-transition style="display: none;">
                    <div class="text-center sm:text-left">
                        <span class="text-[11px] font-black uppercase tracking-wider bg-brand-200/80 text-brand-900 px-2.5 py-0.5 rounded-full">
                            Jadwal Tersedia
                        </span>
                        <h4 class="text-lg font-black text-slate-900 mt-1">
                            Tanggal <span class="text-brand-700" x-text="formatDate(selectedDate)"></span>
                        </h4>
                        <p class="text-sm text-slate-600 font-medium">
                            Pukul <span class="font-extrabold text-slate-900" x-text="selectedTime.substring(0,5) + ' WIB'"></span>
                        </p>
                    </div>

                    <a :href="getBookingUrl()"
                       class="btn-shimmer inline-flex items-center justify-center px-8 py-3.5 rounded-full font-black text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-500 hover:to-emerald-400 shadow-glow-green transform hover:-translate-y-0.5 transition-all text-sm shrink-0">
                        Lanjut Pesan Jam Ini
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: Lapangan & Tarif Transparan -->
    <section class="py-20 bg-white border-b border-slate-100" id="lapangan">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-brand-600 font-black text-xs uppercase tracking-widest bg-brand-50 px-3 py-1 rounded-full">
                    ARENA & TARIF
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                    Pilihan Lapangan & Harga Terjangkau
                </h2>
                <p class="text-slate-500 mt-2 text-base">
                    Nikmati rumput standar FIFA dengan harga yang transparan tanpa biaya tersembunyi.
                </p>
            </div>

            <!-- Field Cards Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                @foreach($fields as $field)
                <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:border-brand-300 transition-all duration-300 flex flex-col">
                    <!-- Image Showcase -->
                    <div class="relative h-64 overflow-hidden bg-slate-800">
                        @php
                            $fieldImg = $field->image ? (str_starts_with($field->image, 'http') ? $field->image : asset('storage/' . $field->image)) : asset('images/hero_pitch_night.jpg');
                        @endphp
                        <img src="{{ $fieldImg }}" alt="{{ $field->name }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-black bg-brand-500 text-slate-950 shadow-md">
                            STANDAR FIFA
                        </span>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-2xl font-black text-white">{{ $field->name }}</h3>
                            <p class="text-xs text-slate-300 mt-0.5 line-clamp-1">{{ $field->description ?? 'Lapangan rumput sintetis standar kompetisi dengan sistem drainase modern.' }}</p>
                        </div>
                    </div>

                    <!-- Pricing Table Matrix -->
                    <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Tarif Sewa Lapangan Per Jam</div>
                            <div class="grid grid-cols-3 gap-3 mb-6">
                                <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100 text-center">
                                    <span class="text-[10px] font-bold text-slate-500 uppercase block mb-0.5">Siang (Weekday)</span>
                                    <span class="text-base font-black text-slate-800">Rp {{ number_format($field->weekday_day_price, 0, ',', '.') }}</span>
                                    <span class="text-[10px] text-slate-400 block mt-0.5">08:00 - 16:00</span>
                                </div>
                                <div class="bg-emerald-50/50 p-3.5 rounded-2xl border border-emerald-100 text-center">
                                    <span class="text-[10px] font-bold text-emerald-700 uppercase block mb-0.5">Malam (Weekday)</span>
                                    <span class="text-base font-black text-emerald-700">Rp {{ number_format($field->weekday_night_price, 0, ',', '.') }}</span>
                                    <span class="text-[10px] text-emerald-600/70 block mt-0.5">17:00 - 24:00</span>
                                </div>
                                <div class="bg-amber-50/50 p-3.5 rounded-2xl border border-amber-100 text-center">
                                    <span class="text-[10px] font-bold text-amber-700 uppercase block mb-0.5">Weekend</span>
                                    <span class="text-base font-black text-amber-700">Rp {{ number_format($field->weekend_price, 0, ',', '.') }}</span>
                                    <span class="text-[10px] text-amber-600/70 block mt-0.5">Sabtu & Minggu</span>
                                </div>
                            </div>

                            <!-- Amenity Tags -->
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">⚽ Gratis Rompi (2 Tim)</span>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">👟 Bola Standar FIFA</span>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">💧 Air Mineral</span>
                            </div>
                        </div>

                        <a href="{{ route('reservations.create', ['field_id' => $field->id]) }}" 
                           class="btn-shimmer w-full inline-flex items-center justify-center py-3.5 rounded-2xl font-black text-white bg-slate-900 hover:bg-brand-600 shadow-sm transition-colors text-sm">
                            Booking {{ $field->name }} Sekarang
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Event / Turnamen Special Highlight Card -->
            <div class="relative bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 rounded-3xl p-8 sm:p-12 text-white overflow-hidden shadow-2xl border border-slate-800">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-80 h-80 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                    <div class="max-w-2xl">
                        <span class="px-3 py-1 rounded-full text-xs font-black bg-brand-500 text-slate-950 uppercase tracking-widest inline-block mb-3">
                            TURNAMEN & EVENT KORPORAT
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-black mb-3 leading-tight">
                            Ingin Mengadakan Turnamen atau Acara Komunitas?
                        </h3>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed mb-6">
                            Kami menyediakan paket khusus acara, lengkap dengan wasit resmi PSSI berlisensi, papan skor digital, tribune penonton, fasilitas live streaming, dan ruang transit VIP.
                        </p>
                        <div class="flex flex-wrap gap-4 text-xs font-bold text-emerald-300">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-brand-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                Pemesanan Minimal H-3
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-brand-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                Durasi & Jadwal Fleksibel
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-brand-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                Tersedia Ruang Medis
                            </span>
                        </div>
                    </div>

                    <div class="shrink-0 w-full sm:w-auto">
                        <a href="{{ route('reservations.create', ['type' => 'event']) }}" 
                           class="btn-shimmer w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-full font-black text-slate-950 bg-gradient-to-r from-brand-400 to-emerald-300 hover:from-brand-300 hover:to-emerald-200 shadow-glow-green transform hover:-translate-y-0.5 transition-all text-sm">
                            Ajukan Booking Acara
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: Fasilitas Lengkap Arena -->
    <section class="py-20 bg-slate-50 border-b border-slate-200/80" id="fasilitas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-brand-600 font-black text-xs uppercase tracking-widest bg-brand-100/60 px-3.5 py-1.5 rounded-full">
                    STANDAR BINTANG LIMA
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                    Fasilitas Premium untuk Kenyamanan Anda
                </h2>
                <p class="text-slate-500 mt-2 text-base">
                    Semua fasilitas dirancang untuk memberikan pengalaman bermain terbaik layaknya pemain sepakbola profesional.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Facility 1 -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-1">Rumput Sintetis FIFA</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Monofilament serat ganda tebal 50mm yang empuk dan aman untuk persendian lutut pemain.</p>
                </div>

                <!-- Facility 2 -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-1">LED Floodlight 1200 Lux</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Pencahayaan stadion profesional tanpa titik buta, sempurna untuk pertandingan malam hari dan rekaman video.</p>
                </div>

                <!-- Facility 3 -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-1">Ruang Ganti & Shower</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Kamar mandi bersih dengan air hangat, loker penyimpanan barang pemain, dan cermin luas.</p>
                </div>

                <!-- Facility 4 -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 mb-1">Tribune & Kafe Lounge</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">Ruang tunggu yang sejuk dan nyaman dengan aneka kopi, snack, serta pemandangan langsung ke lapangan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: Galeri Foto Arena -->
    <section class="py-20 bg-white border-b border-slate-100" id="galeri">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-brand-600 font-black text-xs uppercase tracking-widest bg-brand-50 px-3 py-1 rounded-full">
                    KEMEGAHAN ARENA
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                    Galeri Suasana Lapangan Kami
                </h2>
                <p class="text-slate-500 mt-2 text-base">
                    Intip potret kemegahan stadion kami yang siap menemani aksi terbaik tim sepakbola Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Large Item -->
                <div class="md:col-span-2 md:row-span-2 relative group rounded-3xl overflow-hidden aspect-square md:aspect-auto h-full shadow-md">
                    <img src="{{ asset('images/hero_pitch_night.jpg') }}" 
                         alt="Lapangan Utama Malam" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-0 group-hover:opacity-90 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <span class="text-xs font-black text-emerald-400 uppercase">Arena 1</span>
                        <h4 class="text-xl font-black text-white">Lapangan Utama di Bawah Sorotan Lampu Malam</h4>
                    </div>
                </div>

                <!-- Grid Item 2 -->
                <div class="relative group rounded-3xl overflow-hidden aspect-square shadow-sm">
                    <img src="{{ asset('images/stadium_lighting.jpg') }}" 
                         alt="Sistem Pencahayaan" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-0 group-hover:opacity-90 transition-opacity duration-300 flex flex-col justify-end p-5">
                        <h4 class="text-base font-bold text-white">Lampu Stadion 1200 Lux</h4>
                    </div>
                </div>

                <!-- Grid Item 3 -->
                <div class="relative group rounded-3xl overflow-hidden aspect-square shadow-sm">
                    <img src="{{ asset('images/macro_turf_ball.jpg') }}" 
                         alt="Tekstur Rumput" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-0 group-hover:opacity-90 transition-opacity duration-300 flex flex-col justify-end p-5">
                        <h4 class="text-base font-bold text-white">Rumput Sintetis Standar FIFA</h4>
                    </div>
                </div>

                <!-- Wide Item 4 -->
                <div class="md:col-span-2 relative group rounded-3xl overflow-hidden aspect-[2/1] shadow-sm">
                    <img src="{{ asset('images/lounge_tribune.jpg') }}" 
                         alt="Tribune dan Kafe" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-0 group-hover:opacity-90 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <h4 class="text-lg font-bold text-white">Tribune Penonton & Ruang Kafe Bersih</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: Testimoni & Komunitas -->
    <section class="py-20 bg-slate-50 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-brand-600 font-black text-xs uppercase tracking-widest bg-brand-100/60 px-3.5 py-1.5 rounded-full">
                    KATA MEREKA
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                    Pengalaman Pemain di Maaafiqs
                </h2>
                <p class="text-slate-500 mt-2 text-base">
                    Ratusan tim dan komunitas sepakbola mempercayakan pertandingan mereka di arena kami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 mb-4">
                            ★★★★★
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 italic">
                            "Rumputnya luar biasa empuk, beda banget sama lapangan mini soccer biasa yang bikin lutut perih. Lampunya terang merata jadi pas main malam pandangan tetap jelas!"
                        </p>
                    </div>
                    <div class="flex items-center space-x-3 pt-4 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 font-black flex items-center justify-center">
                            A
                        </div>
                        <div>
                            <div class="font-extrabold text-sm text-slate-900">Andi Pratama</div>
                            <div class="text-xs text-slate-400">Kapten FC Garuda Muda</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 mb-4">
                            ★★★★★
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 italic">
                            "Proses reservasi website-nya sangat praktis! Tinggal cek jam kosong, bayar transfer, langsung beres. Nggak perlu chat admin nunggu dibalas lama."
                        </p>
                    </div>
                    <div class="flex items-center space-x-3 pt-4 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-black flex items-center justify-center">
                            R
                        </div>
                        <div>
                            <div class="font-extrabold text-sm text-slate-900">Rizky Ramadhan</div>
                            <div class="text-xs text-slate-400">Komunitas Mini Soccer Weekend</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-400 mb-4">
                            ★★★★★
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 italic">
                            "Bulan lalu kantor kami sewa untuk event turnamen internal. Fasilitasnya lengkap, parkir aman, dan ruang gantinya sangat higienis. Recommended banget!"
                        </p>
                    </div>
                    <div class="flex items-center space-x-3 pt-4 border-t border-slate-100">
                        <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-700 font-black flex items-center justify-center">
                            D
                        </div>
                        <div>
                            <div class="font-extrabold text-sm text-slate-900">Dimas Aditya</div>
                            <div class="text-xs text-slate-400">HR & Event Corporate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: FAQ Accordion -->
    <section class="py-20 bg-white border-b border-slate-100" id="faq" x-data="{ openFaq: null }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-brand-600 font-black text-xs uppercase tracking-widest bg-brand-50 px-3 py-1 rounded-full">
                    PERTANYAAN UMUM
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                    Frequently Asked Questions
                </h2>
            </div>

            <div class="space-y-4">
                <div class="bg-slate-50 rounded-2xl border border-slate-200/80 overflow-hidden">
                    <button @click="openFaq === 1 ? openFaq = null : openFaq = 1" class="w-full text-left px-6 py-4 font-bold text-slate-800 flex justify-between items-center">
                        <span>Apakah sudah disediakan rompi dan bola saat bermain?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': openFaq === 1}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openFaq === 1" x-transition class="px-6 pb-4 text-sm text-slate-600">
                        Ya, setiap sewa lapangan sudah mendapatkan pinjaman gratis 2 set rompi berbeda warna dan 2 buah bola sepak standar resmi FIFA.
                    </div>
                </div>

                <div class="bg-slate-50 rounded-2xl border border-slate-200/80 overflow-hidden">
                    <button @click="openFaq === 2 ? openFaq = null : openFaq = 2" class="w-full text-left px-6 py-4 font-bold text-slate-800 flex justify-between items-center">
                        <span>Bagaimana jika cuaca hujan deras?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': openFaq === 2}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openFaq === 2" x-transition class="px-6 pb-4 text-sm text-slate-600">
                        Lapangan kami dilengkapi sistem drainase modern tanpa genangan air. Namun jika terjadi badai ekstrem yang berisiko petir, jadwal dapat di-reschedule secara gratis sesuai kesepakatan.
                    </div>
                </div>

                <div class="bg-slate-50 rounded-2xl border border-slate-200/80 overflow-hidden">
                    <button @click="openFaq === 3 ? openFaq = null : openFaq = 3" class="w-full text-left px-6 py-4 font-bold text-slate-800 flex justify-between items-center">
                        <span>Berapa lama batas waktu pembayaran setelah reservasi?</span>
                        <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': openFaq === 3}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openFaq === 3" x-transition class="px-6 pb-4 text-sm text-slate-600">
                        Batas waktu pembayaran adalah 24 jam setelah Anda membuat booking di sistem. Jika lewat dari batas waktu, slot jam tersebut otomatis akan dibuka kembali untuk pemain lain.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: CTA Final -->
    <section class="py-20 bg-sports-mesh relative overflow-hidden text-white">
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <span class="px-3 py-1 rounded-full text-xs font-black bg-brand-500 text-slate-950 uppercase tracking-widest inline-block mb-4 shadow-glow-green">
                JADWAL CEPAT PENUH
            </span>
            <h2 class="text-3xl sm:text-5xl font-black mb-6 tracking-tight">
                Amankan Jam Main Tim Anda Sekarang!
            </h2>
            <p class="text-slate-300 text-base sm:text-lg max-w-2xl mx-auto mb-10 font-light">
                Slot jam malam dan akhir pekan merupakan jam paling favorit dan cepat terisi. Jangan sampai kehabisan jadwal pertandingan minggu ini.
            </p>
            <a href="{{ route('reservations.create') }}" 
               class="btn-shimmer inline-flex items-center justify-center px-10 py-5 rounded-full font-black text-slate-950 bg-gradient-to-r from-emerald-400 to-brand-400 hover:from-emerald-300 hover:to-brand-300 shadow-glow-green transform hover:scale-105 transition-all text-base sm:text-lg">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Booking Jadwal Langsung
            </a>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-950 text-slate-400 pt-16 pb-12 border-t border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10">
                            <x-application-logo class="w-full h-full drop-shadow-md" />
                        </div>
                        <span class="font-black text-xl text-white tracking-tight">Maaafiqs</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed mb-4">
                        Penyedia fasilitas sewa lapangan mini soccer premium dengan rumput sintetis standar internasional untuk pengalaman bermain tak terlupakan.
                    </p>
                    <div class="text-xs text-emerald-400 font-bold">
                        Buka Setiap Hari: 08:00 - 24:00 WIB
                    </div>
                </div>

                <!-- Col 2: Kontak -->
                <div>
                    <h4 class="text-sm font-black text-white uppercase tracking-wider mb-4">Kontak & Lokasi</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li class="flex items-start">
                            <span class="mr-2">📍</span>
                            <span>Jl. Stadion Olahraga No. 1, Jakarta Selatan</span>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2">📞</span>
                            <span>No. Telp: 0777 3333 4444</span>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2">✉️</span>
                            <span>info@maaafiqsminisoccer.com</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Navigasi Cepat -->
                <div>
                    <h4 class="text-sm font-black text-white uppercase tracking-wider mb-4">Menu Pintas</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#cek-jadwal" class="hover:text-emerald-400 transition-colors">Cek Ketersediaan</a></li>
                        <li><a href="#lapangan" class="hover:text-emerald-400 transition-colors">Daftar Lapangan & Harga</a></li>
                        <li><a href="#cara-pesan" class="hover:text-emerald-400 transition-colors">Panduan Pemesanan</a></li>
                        <li><a href="#fasilitas" class="hover:text-emerald-400 transition-colors">Fasilitas Arena</a></li>
                    </ul>
                </div>

                <!-- Col 4: Akun & Bantuan -->
                <div>
                    <h4 class="text-sm font-black text-white uppercase tracking-wider mb-4">Akun & Member</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('login') }}" class="hover:text-emerald-400 transition-colors">Masuk ke Akun</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-emerald-400 transition-colors">Daftar Member Baru</a></li>
                        <li><a href="{{ route('reservations.index') }}" class="hover:text-emerald-400 transition-colors">Riwayat Pertandingan</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-900 text-center text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between">
                <div>&copy; {{ date('Y') }} Maaafiqs Mini Soccer Arena. All rights reserved.</div>
                <div class="mt-2 sm:mt-0 text-slate-600">Didesain dengan standar antarmuka modern & sporty.</div>
            </div>
        </div>
    </footer>

    <!-- Alpine Script for Schedule Checker -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('scheduleChecker', () => ({
                selectedField: '',
                selectedDate: '{{ date("Y-m-d") }}',
                selectedTime: '',
                bookedSlots: @json($bookedSlots),
                timeSlots: [],

                init() {
                    this.generateTimeSlots();
                    const fields = @json($fields);
                    if (fields && fields.length > 0) {
                        this.selectedField = fields[0].id.toString();
                    }
                },

                generateTimeSlots() {
                    this.timeSlots = [];
                    // Jam operasional: 08:00 s.d 23:00 WIB
                    for(let i = 8; i <= 23; i++) {
                        let hour = i.toString().padStart(2, '0');
                        this.timeSlots.push(`${hour}:00:00`);
                    }
                },

                getTimeTag(timeStr) {
                    let h = parseInt(timeStr.substring(0,2));
                    if (h < 12) return 'Pagi';
                    if (h < 16) return 'Siang';
                    if (h < 18) return 'Sore';
                    return 'Malam';
                },

                isBooked(timeToCheck) {
                    if(!this.selectedDate || !this.selectedField) return true;
                    
                    let todayObj = new Date();
                    todayObj.setMinutes(todayObj.getMinutes() - todayObj.getTimezoneOffset());
                    let todayStr = todayObj.toISOString().split('T')[0];
                    
                    if (this.selectedDate === todayStr) {
                        let currentH = new Date().getHours();
                        let timeToCheckH = parseInt(timeToCheck.substring(0,2));
                        if (timeToCheckH <= currentH) {
                            return true;
                        }
                    }

                    for(let i = 0; i < this.bookedSlots.length; i++) {
                        let slot = this.bookedSlots[i];
                        if(slot.reservation_date === this.selectedDate && slot.field_id == this.selectedField) {
                            let slotStartH = parseInt(slot.start_time.substring(0,2));
                            let timeToCheckH = parseInt(timeToCheck.substring(0,2));
                            if(timeToCheckH >= slotStartH && timeToCheckH < (slotStartH + slot.duration)) {
                                return true;
                            }
                        }
                    }
                    return false;
                },

                selectTime(time) {
                    this.selectedTime = time;
                },

                resetSelection() {
                    this.selectedTime = '';
                },

                formatDate(dateStr) {
                    if(!dateStr) return '';
                    const d = new Date(dateStr);
                    return d.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                },

                getBookingUrl() {
                    @auth
                        return `{{ route('reservations.create') }}?field_id=${this.selectedField}&date=${this.selectedDate}&time=${this.selectedTime}`;
                    @else
                        return `{{ route('login') }}?redirect=${encodeURIComponent('{{ route("reservations.create") }}?field_id=' + this.selectedField + '&date=' + this.selectedDate + '&time=' + this.selectedTime)}`;
                    @endauth
                }
            }))
        })
    </script>
</body>
</html>
