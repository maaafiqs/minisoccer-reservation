<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Dashboard Pemain
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola reservasi pertandingan dan pantau jadwal main tim Anda.</p>
            </div>
            <a href="{{ route('reservations.create') }}" class="btn-shimmer inline-flex items-center justify-center px-5 py-2.5 rounded-full text-sm font-extrabold text-white bg-gradient-to-r from-brand-600 to-emerald-500 shadow-glow-green hover:shadow-glow-emerald transform hover:-translate-y-0.5 transition-all">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Booking Lapangan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            @if(isset($announcements) && $announcements->count() > 0)
                <div class="space-y-3">
                    @foreach($announcements as $announcement)
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 rounded-r-2xl shadow-sm flex items-start space-x-3">
                            <div class="p-2 rounded-xl bg-blue-100 text-blue-600 shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-black text-blue-950">{{ $announcement->title }}</h3>
                                <p class="text-xs text-blue-800 mt-0.5 leading-relaxed">{{ $announcement->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Welcome Banner -->
            @php
                $hour = (int) date('H');
                $greeting = $hour < 11 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 18 ? 'Selamat Sore' : 'Selamat Malam'));
            @endphp
            <div class="relative bg-sports-mesh rounded-3xl shadow-premium overflow-hidden text-white border border-slate-800">
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="relative p-8 sm:p-12 flex flex-col md:flex-row md:items-center justify-between gap-8 z-10">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-slate-800/80 border border-brand-500/40 text-[11px] font-black uppercase tracking-wider text-emerald-300 mb-4">
                            <span class="w-2 h-2 rounded-full bg-brand-400 animate-pulse"></span>
                            <span>MEMBER PLATINUM</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-black tracking-tight mb-3">
                            {{ $greeting }}, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-brand-300">{{ Auth::user()->name }}</span>! ⚽
                        </h1>
                        <p class="text-sm sm:text-base text-slate-300 font-light leading-relaxed">
                            Siap adu strategi dan fisik bersama tim terbaikmu hari ini? Pilih jadwal terbaik dan amankan lapangan sebelum kehabisan.
                        </p>
                    </div>
                    <div class="shrink-0 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('reservations.create') }}" class="btn-shimmer inline-flex items-center justify-center px-6 py-3.5 rounded-full font-black text-slate-950 bg-gradient-to-r from-emerald-400 to-brand-400 hover:from-emerald-300 hover:to-brand-300 shadow-glow-green transform hover:-translate-y-0.5 transition-all text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            Pesan Jadwal Baru
                        </a>
                        <a href="{{ route('reservations.index') }}" class="inline-flex items-center justify-center px-6 py-3.5 rounded-full font-bold text-white bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700 text-sm transition-all">
                            Riwayat Booking
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div>
                <h3 class="text-sm font-black uppercase tracking-wider text-slate-400 mb-4 px-1">
                    Ringkasan Statistik Saya
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Total Pertandingan -->
                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md hover:border-brand-300 transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            </div>
                            <span class="text-[11px] font-black uppercase tracking-wider text-slate-400">Total Main</span>
                        </div>
                        <div class="flex items-baseline space-x-2">
                            <span class="text-4xl font-black text-slate-900">{{ $totalReservations }}</span>
                            <span class="text-xs font-bold text-slate-400">Pertandingan</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center text-xs">
                            <span class="text-slate-500">Semua reservasi terdata</span>
                            <a href="{{ route('reservations.index') }}" class="font-black text-brand-600 hover:text-brand-700">Lihat &rarr;</a>
                        </div>
                    </div>

                    <!-- Pending / Menunggu Pembayaran -->
                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md hover:border-amber-300 transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-[11px] font-black uppercase tracking-wider text-slate-400">Menunggu Bayar</span>
                        </div>
                        <div class="flex items-baseline space-x-2">
                            <span class="text-4xl font-black {{ $pendingReservations > 0 ? 'text-amber-500' : 'text-slate-900' }}">
                                {{ $pendingReservations }}
                            </span>
                            <span class="text-xs font-bold text-slate-400">Tagihan Aktif</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center text-xs">
                            @if($pendingReservations > 0)
                                <span class="text-amber-600 font-bold flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-amber-500 mr-1.5 animate-ping"></span>
                                    Perlu diselesaikan
                                </span>
                                <a href="{{ route('reservations.index') }}" class="font-black text-amber-600 hover:text-amber-700">Bayar Sekarang &rarr;</a>
                            @else
                                <span class="text-emerald-600 font-bold">Semua tagihan lunas</span>
                                <span class="text-slate-300">✓</span>
                            @endif
                        </div>
                    </div>

                    <!-- Jadwal Terkonfirmasi -->
                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-md hover:border-blue-300 transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-[11px] font-black uppercase tracking-wider text-slate-400">Siap Main</span>
                        </div>
                        <div class="flex items-baseline space-x-2">
                            <span class="text-4xl font-black text-blue-600">{{ $acceptedReservations }}</span>
                            <span class="text-xs font-bold text-slate-400">Jadwal Diterima</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-100 flex justify-between items-center text-xs">
                            <span class="text-slate-500">Telah diverifikasi admin</span>
                            <a href="{{ route('reservations.index') }}" class="font-black text-blue-600 hover:text-blue-700">Cek Tiket &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Spotlight: Upcoming Match / Next Booking -->
            @php
                $upcomingMatch = Auth::user()->reservations()
                    ->whereIn('status', ['accepted', 'paid'])
                    ->where('reservation_date', '>=', now()->toDateString())
                    ->orderBy('reservation_date')
                    ->orderBy('start_time')
                    ->first();
            @endphp

            <div>
                <h3 class="text-sm font-black uppercase tracking-wider text-slate-400 mb-4 px-1">
                    Jadwal Pertandingan Terdekat
                </h3>
                
                @if($upcomingMatch)
                    <div class="bg-gradient-to-br from-slate-900 to-slate-950 rounded-3xl p-6 sm:p-8 text-white border border-slate-800 shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mr-12 -mt-12 w-64 h-64 bg-brand-500/15 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-emerald-500 text-slate-950 shadow-sm">
                                        MATCH DAY READY
                                    </span>
                                    <span class="text-xs text-slate-400 font-mono">
                                        No. {{ $upcomingMatch->reservation_number }}
                                    </span>
                                </div>
                                <h4 class="text-2xl font-black text-white">
                                    {{ $upcomingMatch->field->name ?? 'Lapangan Mini Soccer' }}
                                </h4>
                                <div class="flex flex-wrap items-center gap-4 text-xs text-slate-300 pt-1">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ \Carbon\Carbon::parse($upcomingMatch->reservation_date)->format('l, d F Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ is_string($upcomingMatch->start_time) ? substr($upcomingMatch->start_time, 0, 5) : $upcomingMatch->start_time->format('H:i') }} WIB ({{ $upcomingMatch->duration }} Jam)
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                @if($upcomingMatch->status === 'accepted')
                                    <a href="{{ route('reservations.print', $upcomingMatch) }}" target="_blank" class="btn-shimmer inline-flex items-center justify-center px-6 py-3 rounded-full font-black text-slate-950 bg-gradient-to-r from-emerald-400 to-brand-400 hover:from-emerald-300 shadow-glow-green text-xs">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                        Cetak E-Tiket PDF
                                    </a>
                                @endif
                                <a href="{{ route('reservations.index') }}" class="px-5 py-3 rounded-full font-bold text-white bg-slate-800 hover:bg-slate-700 text-xs transition-colors">
                                    Detail Reservasi
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-3xl p-8 border border-slate-200 text-center shadow-sm">
                        <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h4 class="text-base font-black text-slate-800">Belum Ada Jadwal Main Mendatang</h4>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 mb-5">
                            Ayo jadwalkan pertandingan tim Anda sekarang untuk mendapatkan slot jam terbaik di akhir pekan!
                        </p>
                        <a href="{{ route('reservations.create') }}" class="btn-shimmer inline-flex items-center px-6 py-3 rounded-full font-extrabold text-white bg-gradient-to-r from-brand-600 to-emerald-500 shadow-glow-green text-xs">
                            + Pesan Lapangan Sekarang
                        </a>
                    </div>
                @endif
            </div>

            <!-- Quick Recent Reservations -->
            @php
                $recentBookings = Auth::user()->reservations()->with('field')->latest()->take(3)->get();
            @endphp
            <div>
                <div class="flex items-center justify-between mb-4 px-1">
                    <h3 class="text-sm font-black uppercase tracking-wider text-slate-400">
                        Aktivitas Booking Terkini
                    </h3>
                    <a href="{{ route('reservations.index') }}" class="text-xs font-black text-brand-600 hover:text-brand-700">
                        Lihat Semua Riwayat &rarr;
                    </a>
                </div>

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    @forelse($recentBookings as $res)
                        <div class="p-5 sm:p-6 border-b border-slate-100 last:border-0 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/50 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center shrink-0 font-black text-sm">
                                    ⚽
                                </div>
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <span class="font-extrabold text-sm text-slate-900">{{ $res->field->name ?? 'Lapangan' }}</span>
                                        <span class="text-xs font-mono text-slate-400">#{{ $res->reservation_number }}</span>
                                    </div>
                                    <div class="text-xs text-slate-500 mt-0.5">
                                        {{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }} • {{ is_string($res->start_time) ? substr($res->start_time, 0, 5) : $res->start_time->format('H:i') }} WIB ({{ $res->duration }} Jam)
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between sm:justify-end space-x-4">
                                <div class="text-right">
                                    <div class="text-xs text-slate-400">Total Tarif</div>
                                    <div class="text-sm font-black text-slate-900">Rp {{ number_format($res->total_price, 0, ',', '.') }}</div>
                                </div>

                                <div>
                                    @if($res->status === 'pending')
                                        <span class="px-3 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-800">
                                            Pending
                                        </span>
                                    @elseif($res->status === 'paid')
                                        <span class="px-3 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-800">
                                            Lunas
                                        </span>
                                    @elseif($res->status === 'accepted')
                                        <span class="px-3 py-1 rounded-full text-xs font-black bg-blue-100 text-blue-800">
                                            Diterima
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-black bg-rose-100 text-rose-800">
                                            Batal
                                        </span>
                                    @endif
                                </div>

                                @if($res->status === 'pending')
                                    <a href="{{ route('reservations.pay.view', $res) }}" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-amber-500 hover:bg-amber-600 shadow-sm transition-colors">
                                        Bayar
                                    </a>
                                @elseif($res->status === 'accepted')
                                    <a href="{{ route('reservations.print', $res) }}" target="_blank" class="p-2 rounded-xl text-slate-600 hover:text-brand-600 hover:bg-brand-50 border border-slate-200 transition-colors" title="Cetak PDF">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-xs text-slate-400">
                            Belum ada aktivitas reservasi yang dilakukan.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
