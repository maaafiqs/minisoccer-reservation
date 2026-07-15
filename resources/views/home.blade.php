<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maaafiqs Mini Soccer - Sewa Lapangan Mini Soccer Premium</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); transition: background-color 0.3s ease; }
        html.dark .glass-nav { background: rgba(17, 24, 39, 0.9); }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 selection:bg-green-500 selection:text-white transition-colors duration-300">
    
    <!-- Navigation -->
    <nav class="glass-nav border-b border-gray-100 sticky top-0 z-50 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400 tracking-tight hover:scale-105 transition-transform">
                        ⚽ Maaafiqs Mini Soccer
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-6">
                    <a href="#cek-jadwal" class="text-gray-600 hover:text-green-600 font-semibold transition-colors">Cek Jadwal</a>
                    <a href="#fasilitas" class="text-gray-600 hover:text-green-600 font-semibold transition-colors">Fasilitas</a>
                    <a href="#harga" class="text-gray-600 hover:text-green-600 font-semibold transition-colors">Harga</a>
                    <a href="#galeri" class="text-gray-600 hover:text-green-600 font-semibold transition-colors">Galeri</a>
                    
                    <div class="h-6 w-px bg-gray-300 mx-2"></div>
                    
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-600 font-bold transition-colors">Dashboard Admin</a>
                            <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-green-600 font-medium transition-colors">Profil</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-green-600 font-bold transition-colors">Dashboard Saya</a>
                            <a href="{{ route('reservations.index') }}" class="text-gray-600 hover:text-green-600 font-medium transition-colors">Riwayat</a>
                            <a href="{{ route('reservations.create') }}" class="bg-gradient-to-r from-green-500 to-green-600 text-white hover:from-green-600 hover:to-green-700 font-bold px-6 py-2.5 rounded-full shadow-[0_4px_15px_rgba(34,197,94,0.3)] transform transition-all duration-300 hover:-translate-y-0.5">Booking Baru</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 font-bold transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-green-600 text-white hover:bg-green-700 font-bold px-6 py-2.5 rounded-full shadow-lg transform transition-all duration-300 hover:-translate-y-0.5">Daftar Akun</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @if(isset($announcements) && $announcements->count() > 0)
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-md">
            <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-0 flex-1 flex items-center">
                        <span class="flex p-2 rounded-lg bg-white/20">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                        </span>
                        <marquee class="ml-3 font-medium text-white truncate text-lg">
                            @foreach($announcements as $announcement)
                                <span class="mx-8"><strong>{{ $announcement->title }}:</strong> {{ $announcement->content }}</span>
                            @endforeach
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Hero Section -->
        <div class="relative bg-green-600 overflow-hidden min-h-[85vh] flex items-center group">
            <img src="https://images.unsplash.com/photo-1518605368461-1ee7c5320d30?q=80&w=2070&auto=format&fit=crop" alt="Stadion mini soccer malam hari" class="absolute w-full h-full object-cover opacity-50 transition-transform duration-[10s] group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-r from-green-600/90 via-green-500/70 to-transparent"></div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center z-10 w-full">
                <div class="max-w-3xl">
                    <div class="inline-block px-4 py-1.5 rounded-full bg-green-500/20 border border-green-500/30 backdrop-blur-sm text-green-400 font-semibold text-sm mb-6 animate-pulse">
                        🔥 Tersedia Jam Malam Hari Ini!
                    </div>
                    <h1 class="text-5xl sm:text-7xl font-black text-white tracking-tight mb-6 leading-tight">
                        Main Bola Layaknya <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-300">Pemain Profesional.</span>
                    </h1>
                    <p class="text-lg sm:text-2xl text-gray-300 mb-10 font-light leading-relaxed max-w-2xl">
                        Fasilitas lapangan rumput sintetis standar FIFA, sistem pencahayaan stadion kelas atas, dan atmosfir pertandingan yang sesungguhnya.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if(Auth::check() && Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center bg-white text-gray-900 hover:bg-gray-100 font-extrabold text-lg px-8 py-4 rounded-full shadow-xl transform transition-all duration-300 hover:scale-105">
                                Buka Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('reservations.create') }}" class="inline-flex items-center justify-center bg-white hover:bg-gray-100 text-green-700 font-extrabold text-lg px-10 py-4 rounded-full shadow-[0_0_40px_rgba(255,255,255,0.4)] transform transition-all duration-300 hover:scale-105">
                                Pesan Jadwal Sekarang
                                <svg class="w-6 h-6 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            <a href="#fasilitas" class="inline-flex items-center justify-center bg-white/10 hover:bg-white/20 text-white backdrop-blur-md border border-white/20 font-bold text-lg px-8 py-4 rounded-full transition-all duration-300">
                                Lihat Fasilitas
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Shape Divider -->
            <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10 text-gray-50">
                <svg class="relative block w-full h-12 sm:h-24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.85,132.59,201.39,119.5,243.68,111.66,284.18,90.41,321.39,56.44Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <!-- How to Book Section -->
        <div class="py-20 bg-gray-50" id="cara-pesan">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-green-600 font-bold tracking-wide uppercase text-sm mb-2">Sangat Mudah</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Cara Memesan Lapangan</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-gray-100 text-center relative hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-20 h-20 mx-auto bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-gray-900">1. Pilih Jadwal</h4>
                        <p class="text-gray-500">Buka menu Booking, lalu pilih tanggal dan jam kosong yang tersedia. Sistem kami aktif 24 jam.</p>
                        <div class="hidden md:block absolute top-1/2 right-0 transform translate-x-1/2 -translate-y-1/2 text-gray-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-gray-100 text-center relative hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-20 h-20 mx-auto bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-gray-900">2. Lakukan Pembayaran</h4>
                        <p class="text-gray-500">Selesaikan pembayaran sesuai tarif dan unggah bukti transfer. Admin kami akan segera memverifikasinya.</p>
                        <div class="hidden md:block absolute top-1/2 right-0 transform translate-x-1/2 -translate-y-1/2 text-gray-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-gray-100 text-center relative hover:-translate-y-2 transition-transform duration-300">
                        <div class="w-20 h-20 mx-auto bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold mb-3 text-gray-900">3. Siap Bermain</h4>
                        <p class="text-gray-500">Cetak Bukti PDF atau tunjukkan QRCode ke resepsionis kami. Lapangan siap digunakan!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule Checker Section -->
        <div class="py-20 bg-white border-b border-gray-100" id="cek-jadwal" x-data="scheduleChecker()">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-green-600 font-bold tracking-wide uppercase text-sm mb-2">Real-time</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Cek Ketersediaan Lapangan</h3>
                    <p class="text-gray-500 mt-2 max-w-xl mx-auto">Silakan pilih tanggal main di bawah ini untuk melihat jam operasional yang masih kosong secara langsung.</p>
                </div>

                <div class="max-w-4xl mx-auto bg-gray-50 rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-md">
                    <!-- Date Picker & Field Selector -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6 mb-8 pb-8 border-b border-gray-200">
                        <div class="w-full flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <label for="check_field" class="block text-sm font-bold text-gray-800 mb-2">Pilih Lapangan</label>
                                <select id="check_field" x-model="selectedField" @change="resetSelection()" class="block w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 shadow-sm transition-colors text-lg py-3 px-4">
                                    <option value="">-- Pilih Lapangan --</option>
                                    @foreach($fields as $field)
                                        <option value="{{ $field->id }}">{{ $field->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1">
                                <label for="check_date" class="block text-sm font-bold text-gray-800 mb-2">Pilih Tanggal Main</label>
                                <input type="date" id="check_date" x-model="selectedDate" min="{{ date('Y-m-d') }}"
                                       class="block w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 shadow-sm transition-colors text-lg py-3 px-4"
                                       @change="resetSelection()">
                            </div>
                        </div>
                        <div class="w-full sm:w-auto text-center sm:text-right shrink-0">
                            <span class="text-sm font-semibold text-gray-400 uppercase tracking-wider block mb-1">Status Keterangan</span>
                            <div class="flex items-center justify-center sm:justify-end space-x-4">
                                <span class="flex items-center text-sm font-bold text-green-700">
                                    <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span> Tersedia
                                </span>
                                <span class="flex items-center text-sm font-bold text-gray-400">
                                    <span class="w-3 h-3 rounded-full bg-gray-300 mr-2"></span> Dipesan
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Time Slots Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                        <template x-for="time in timeSlots" :key="time">
                            <button @click="selectTime(time)" :disabled="isBooked(time)"
                                    class="rounded-2xl border-2 py-4 px-2 text-center text-lg font-bold transition-all duration-200 shadow-sm focus:outline-none"
                                    :class="{
                                        'bg-gray-100 text-gray-400 border-transparent cursor-not-allowed line-through opacity-70': isBooked(time),
                                        'bg-white text-gray-700 border-gray-200 hover:border-green-300 hover:shadow-md': !isBooked(time) && selectedTime !== time,
                                        'bg-green-500 text-white border-green-500 shadow-[0_8px_20px_rgba(34,197,94,0.3)] -translate-y-1': selectedTime === time
                                    }">
                                <span x-text="time.substring(0,5)"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Selected Slot Alert / Action -->
                    <div class="mt-10 bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl border border-green-200 text-center sm:text-left flex flex-col sm:flex-row justify-between items-center gap-6"
                         x-show="selectedTime" x-transition style="display: none;">
                        <div>
                            <h4 class="font-bold text-green-800 text-lg">Jadwal Terpilih Tersedia!</h4>
                            <p class="text-green-700">Tanggal: <span class="font-bold" x-text="formatDate(selectedDate)"></span>, Jam: <span class="font-bold" x-text="selectedTime.substring(0,5) + ' WIB'"></span></p>
                        </div>
                        <div>
                            <a :href="getBookingUrl()"
                               class="inline-flex items-center justify-center px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-full shadow-[0_8px_20px_rgba(34,197,94,0.2)] transition-all duration-300 transform hover:-translate-y-0.5 text-base">
                                Pesan Sekarang
                                <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Section -->
        <div class="py-20 bg-white" id="harga">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-green-600 font-bold tracking-wide uppercase text-sm mb-2">Tarif Transparan</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">Harga Fleksibel Sesuai Kebutuhan</h3>
                    <p class="text-lg text-gray-500 leading-relaxed max-w-2xl mx-auto">
                        Nikmati fasilitas bintang lima dengan harga yang transparan. Kami menawarkan tarif khusus berdasarkan lapangan dan waktu bermain (Siang, Malam, & Akhir Pekan).
                    </p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                    @foreach($fields as $field)
                    <div class="bg-gradient-to-br from-green-50 to-emerald-100 p-6 sm:p-8 rounded-3xl border border-green-200 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-40 blur-2xl"></div>
                        <h4 class="text-2xl font-bold text-green-900 mb-4">{{ $field->name }}</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6 relative z-10">
                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-green-50 text-center">
                                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Siang (Weekday)</div>
                                <div class="text-lg font-black text-green-700">Rp {{ number_format($field->weekday_day_price, 0, ',', '.') }}</div>
                            </div>
                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-green-50 text-center">
                                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Malam (Weekday)</div>
                                <div class="text-lg font-black text-green-700">Rp {{ number_format($field->weekday_night_price, 0, ',', '.') }}</div>
                            </div>
                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-green-50 text-center">
                                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Akhir Pekan</div>
                                <div class="text-lg font-black text-green-700">Rp {{ number_format($field->weekend_price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <a href="{{ route('reservations.create') }}" class="inline-block px-6 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-bold transition-colors shadow-md text-sm relative z-10">Booking {{ $field->name }}</a>
                    </div>
                    @endforeach
                </div>

                <!-- Event Info Box -->
                <div class="bg-gray-900 p-6 sm:p-8 rounded-3xl text-white shadow-xl relative overflow-hidden max-w-4xl mx-auto">
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 rounded-full bg-white opacity-5 blur-2xl"></div>
                    <div class="flex flex-col sm:flex-row items-center">
                        <div class="bg-white/10 p-4 rounded-full sm:mr-6 mb-4 sm:mb-0 shrink-0">
                            <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="relative z-10 text-center sm:text-left">
                            <h4 class="text-2xl font-bold mb-2">Bisa Untuk Acara / Turnamen!</h4>
                            <p class="text-gray-300 leading-relaxed mb-4">
                                Sewa lapangan untuk kebutuhan kompetisi, turnamen, atau acara korporat Anda. Nikmati kemudahan memesan dengan fitur <strong>Booking Acara/Event</strong>.
                            </p>
                            <ul class="flex flex-col sm:flex-row justify-center sm:justify-start gap-4 space-y-0">
                                <li class="flex items-center text-sm font-medium text-white justify-center">
                                    <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Pemesanan Wajib Minimal H-3
                                </li>
                                <li class="flex items-center text-sm font-medium text-white justify-center">
                                    <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Harga Sesuai Ketentuan Lapangan
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Facilities Section -->
        <div class="py-20 bg-gray-50 border-t border-gray-100" id="fasilitas">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-green-600 font-bold tracking-wide uppercase text-sm mb-2">Fasilitas Lengkap</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">Standar Premium untuk Anda</h3>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-green-50 rounded-xl shadow-sm flex items-center justify-center text-green-600 mb-4 mx-auto md:mx-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2 text-center md:text-left">Rumput Sintetis Pro</h4>
                        <p class="text-gray-500 text-sm text-center md:text-left">Rumput grade FIFA berkualitas tinggi yang lembut dan aman untuk lutut.</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-green-50 rounded-xl shadow-sm flex items-center justify-center text-green-600 mb-4 mx-auto md:mx-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2 text-center md:text-left">Pencahayaan LED</h4>
                        <p class="text-gray-500 text-sm text-center md:text-left">Main jam berapapun tetap terang benderang seperti main di siang hari.</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-green-50 rounded-xl shadow-sm flex items-center justify-center text-green-600 mb-4 mx-auto md:mx-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2 text-center md:text-left">Sistem Voucher</h4>
                        <p class="text-gray-500 text-sm text-center md:text-left">Tersedia banyak diskon untuk member langganan tetap mingguan.</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-green-50 rounded-xl shadow-sm flex items-center justify-center text-green-600 mb-4 mx-auto md:mx-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2 text-center md:text-left">Tribune & Kafe</h4>
                        <p class="text-gray-500 text-sm text-center md:text-left">Ruang tunggu luas, estetik, dan nyaman untuk keluarga / penonton.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery Grid Section -->
        <div class="py-20 bg-gray-50 text-gray-900" id="galeri">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-5xl font-black mb-4">Intip Kemegahan Arena Kami</h2>
                    <p class="text-gray-600 text-lg max-w-2xl mx-auto">Kami tidak berkompromi soal kualitas. Semua fasilitas dibangun untuk kepuasan total pengunjung.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2 md:row-span-2 relative group rounded-3xl overflow-hidden aspect-square md:aspect-auto h-full">
                        <img src="https://images.unsplash.com/photo-1518605368461-1ee7c5320d30?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Lapangan Utama">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-8">
                            <h3 class="text-2xl font-bold">Lapangan Utama (Malam)</h3>
                        </div>
                    </div>
                    
                    <div class="relative group rounded-3xl overflow-hidden aspect-square">
                        <img src="https://images.unsplash.com/photo-1551280857-2b9ebf262c1c?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Sistem Cahaya">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-lg font-bold">Pencahayaan Maksimal</h3>
                        </div>
                    </div>
                    
                    <div class="relative group rounded-3xl overflow-hidden aspect-square">
                        <img src="https://images.unsplash.com/photo-1534067783941-51c9c23ecefd?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Detail Rumput">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <h3 class="text-lg font-bold">Tekstur Rumput Sintetis</h3>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2 relative group rounded-3xl overflow-hidden aspect-[2/1]">
                        <img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Ruang Ganti">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-8">
                            <h3 class="text-xl font-bold">Lorong & Ruang Tunggu</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-20 bg-green-500 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
            <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
                <h2 class="text-4xl md:text-5xl font-black text-white mb-6">Siap Merumput Hari Ini?</h2>
                <p class="text-green-100 text-xl mb-10">Jadwal cepat penuh, terutama di akhir pekan. Amankan jam main tim Anda sekarang sebelum kehabisan.</p>
                <a href="{{ route('reservations.create') }}" class="inline-block bg-white hover:bg-gray-100 text-green-700 font-bold text-xl px-12 py-5 rounded-full shadow-2xl transform transition-transform hover:scale-105">
                    Booking Jadwal Langsung
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-white pt-16 pb-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <div>
                    <a href="#" class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400 mb-4 block">
                        Maaafiqs Mini Soccer
                    </a>
                    <p class="text-gray-600 leading-relaxed">
                        Penyedia layanan sewa lapangan mini soccer terbaik dengan fasilitas standar internasional untuk pengalaman bermain yang tak terlupakan.
                    </p>
                </div>
                <div>
                    <h4 class="text-gray-900 font-bold text-lg mb-4">Kontak Kami</h4>
                    <ul class="space-y-2 text-gray-600">
                        <li>📍 Jl. Olahraga No.1, Jakarta Selatan</li>
                        <li>📞 0812-3456-7890</li>
                        <li>✉️ cs@maaafiqsminisoccer.com</li>
                        <li>🕒 Buka Setiap Hari (08:00 - 24:00)</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-gray-900 font-bold text-lg mb-4">Menu Pintas</h4>
                    <ul class="space-y-2">
                        <li><a href="#fasilitas" class="text-gray-600 hover:text-green-600 transition-colors">Fasilitas & Harga</a></li>
                        <li><a href="#cara-pesan" class="text-gray-600 hover:text-green-600 transition-colors">Cara Memesan</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 transition-colors">Login Akun</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-green-600 transition-colors">Daftar Akun Baru</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-8 border-t border-gray-200 text-gray-500 text-sm">
                &copy; {{ date('Y') }} Maaafiqs Mini Soccer. Dibuat dengan antusiasme tinggi.
            </div>
        </div>
    </footer>
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
                    // Jam operasional dari 08:00 sampai 23:00 WIB
                    for(let i = 8; i <= 23; i++) {
                        let hour = i.toString().padStart(2, '0');
                        this.timeSlots.push(`${hour}:00:00`);
                    }
                },

                isBooked(timeToCheck) {
                    if(!this.selectedDate || !this.selectedField) return true;
                    
                    // Check if date is today and time is in the past
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

                    for(let i=0; i < this.bookedSlots.length; i++) {
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
