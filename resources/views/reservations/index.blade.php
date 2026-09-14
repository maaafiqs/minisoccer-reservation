<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs font-bold text-slate-400 mb-1 flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}" class="hover:text-brand-600">Dashboard</a>
                    <span>/</span>
                    <span class="text-slate-700">Riwayat Reservasi</span>
                </nav>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Riwayat Reservasi Lapangan
                </h2>
            </div>
            <a href="{{ route('reservations.create') }}" class="btn-shimmer inline-flex items-center px-5 py-2.5 rounded-full text-sm font-extrabold text-white bg-gradient-to-r from-brand-600 to-emerald-500 shadow-glow-green hover:shadow-glow-emerald transform hover:-translate-y-0.5 transition-all">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Buat Booking Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen" x-data="{ activeFilter: 'all' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-2xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-xl bg-emerald-100 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-emerald-900">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Filter Tabs -->
            <div class="flex flex-wrap gap-2 border-b border-slate-200 pb-3 text-xs font-bold">
                <button @click="activeFilter = 'all'" 
                        :class="activeFilter === 'all' ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-4 py-2 rounded-full transition-all">
                    Semua ({{ $reservations->count() }})
                </button>
                <button @click="activeFilter = 'pending'" 
                        :class="activeFilter === 'pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-4 py-2 rounded-full transition-all">
                    Menunggu Pembayaran ({{ $reservations->where('status', 'pending')->count() }})
                </button>
                <button @click="activeFilter = 'accepted'" 
                        :class="activeFilter === 'accepted' ? 'bg-brand-600 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-4 py-2 rounded-full transition-all">
                    Terkonfirmasi ({{ $reservations->whereIn('status', ['accepted', 'paid'])->count() }})
                </button>
                <button @click="activeFilter = 'cancelled'" 
                        :class="activeFilter === 'cancelled' ? 'bg-rose-600 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'"
                        class="px-4 py-2 rounded-full transition-all">
                    Dibatalkan ({{ $reservations->where('status', 'cancelled')->count() }})
                </button>
            </div>

            @if($reservations->isEmpty())
                <div class="bg-white rounded-3xl p-12 border border-slate-200 text-center shadow-sm max-w-md mx-auto">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-base font-black text-slate-900 mb-1">Belum Ada Riwayat Reservasi</h3>
                    <p class="text-xs text-slate-500 mb-6">Anda belum pernah melakukan reservasi lapangan di Maaafiqs Mini Soccer.</p>
                    <a href="{{ route('reservations.create') }}" class="btn-shimmer inline-flex items-center px-6 py-3 rounded-full text-xs font-black text-white bg-gradient-to-r from-brand-600 to-emerald-500 shadow-glow-green">
                        + Buat Booking Sekarang
                    </a>
                </div>
            @else
                <!-- Desktop Table View -->
                <div class="hidden md:block bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-black uppercase tracking-wider text-slate-400">
                                    <th class="px-6 py-4">No. Reservasi</th>
                                    <th class="px-6 py-4">Lapangan</th>
                                    <th class="px-6 py-4">Jadwal Main</th>
                                    <th class="px-6 py-4">Durasi</th>
                                    <th class="px-6 py-4">Total Biaya</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                                @foreach($reservations as $res)
                                <tr class="hover:bg-slate-50/60 transition-colors" 
                                    x-show="activeFilter === 'all' || 
                                           (activeFilter === 'pending' && '{{ $res->status }}' === 'pending') || 
                                           (activeFilter === 'accepted' && ('{{ $res->status }}' === 'accepted' || '{{ $res->status }}' === 'paid')) || 
                                           (activeFilter === 'cancelled' && '{{ $res->status }}' === 'cancelled')">
                                    
                                    <td class="px-6 py-4">
                                        <div class="font-black text-slate-900">#{{ $res->reservation_number ?? '-' }}</div>
                                        @if($res->type === 'event')
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] font-black bg-purple-100 text-purple-800">
                                                Acara: {{ $res->event_name }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 font-bold text-slate-900">
                                        {{ $res->field->name ?? 'Lapangan Mini Soccer' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }}</div>
                                        <div class="text-[11px] text-slate-400">{{ is_string($res->start_time) ? substr($res->start_time, 0, 5) : $res->start_time->format('H:i') }} WIB</div>
                                    </td>

                                    <td class="px-6 py-4 font-bold">
                                        {{ $res->duration }} Jam
                                    </td>

                                    <td class="px-6 py-4 font-black text-slate-900">
                                        Rp {{ number_format($res->total_price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($res->status === 'pending')
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-amber-100 text-amber-800">
                                                Menunggu Bayar
                                            </span>
                                            <div class="text-[10px] font-mono font-bold text-rose-600 mt-1"
                                                 x-data="{ 
                                                    deadline: new Date('{{ \Carbon\Carbon::parse($res->created_at)->addHours(24)->toIso8601String() }}').getTime(),
                                                    timeLeft: '...',
                                                    init() {
                                                        setInterval(() => {
                                                            let distance = this.deadline - new Date().getTime();
                                                            if(distance < 0) { this.timeLeft = 'KADALUARSA'; return; }
                                                            let h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                            let m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                            this.timeLeft = h + 'j ' + m + 'm';
                                                        }, 1000);
                                                    }
                                                 }">
                                                Sisa: <span x-text="timeLeft"></span>
                                            </div>
                                        @elseif($res->status === 'paid')
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800">
                                                Lunas (Menunggu Konfirmasi)
                                            </span>
                                        @elseif($res->status === 'accepted')
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-blue-100 text-blue-800">
                                                Diterima
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black bg-rose-100 text-rose-800">
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        @if($res->status === 'pending')
                                            <a href="{{ route('reservations.pay.view', $res) }}" class="btn-shimmer inline-flex items-center px-4 py-2 rounded-xl text-xs font-black text-white bg-amber-500 hover:bg-amber-600 shadow-sm transition-all">
                                                Bayar Sekarang
                                            </a>
                                        @elseif($res->status === 'accepted')
                                            <a href="{{ route('reservations.print', $res) }}" target="_blank" class="inline-flex items-center px-3.5 py-1.5 rounded-xl text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition-colors">
                                                <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                                Cetak E-Tiket
                                            </a>
                                        @elseif($res->status === 'paid')
                                            <span class="text-[11px] text-slate-400 italic">Verifikasi Admin</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mobile Responsive Cards View -->
                <div class="md:hidden space-y-4">
                    @foreach($reservations as $res)
                        <div class="bg-white rounded-3xl p-5 border border-slate-200 shadow-sm space-y-3"
                             x-show="activeFilter === 'all' || 
                                    (activeFilter === 'pending' && '{{ $res->status }}' === 'pending') || 
                                    (activeFilter === 'accepted' && ('{{ $res->status }}' === 'accepted' || '{{ $res->status }}' === 'paid')) || 
                                    (activeFilter === 'cancelled' && '{{ $res->status }}' === 'cancelled')">
                            
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="text-xs font-mono font-bold text-slate-400">#{{ $res->reservation_number }}</span>
                                    <h4 class="font-black text-slate-900 text-base">{{ $res->field->name ?? 'Lapangan' }}</h4>
                                </div>
                                <div>
                                    @if($res->status === 'pending')
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-amber-100 text-amber-800">Pending</span>
                                    @elseif($res->status === 'paid')
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800">Lunas</span>
                                    @elseif($res->status === 'accepted')
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-blue-100 text-blue-800">Diterima</span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-rose-100 text-rose-800">Batal</span>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100 text-xs space-y-1">
                                <div class="flex justify-between text-slate-600">
                                    <span>Jadwal:</span>
                                    <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }}, {{ is_string($res->start_time) ? substr($res->start_time, 0, 5) : $res->start_time->format('H:i') }} WIB</span>
                                </div>
                                <div class="flex justify-between text-slate-600">
                                    <span>Durasi:</span>
                                    <span class="font-bold text-slate-800">{{ $res->duration }} Jam</span>
                                </div>
                                <div class="flex justify-between text-slate-600 pt-1 border-t border-slate-200">
                                    <span>Total Biaya:</span>
                                    <span class="font-black text-brand-700">Rp {{ number_format($res->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="pt-1">
                                @if($res->status === 'pending')
                                    <a href="{{ route('reservations.pay.view', $res) }}" class="btn-shimmer w-full py-2.5 rounded-xl text-xs font-black text-white bg-amber-500 hover:bg-amber-600 shadow-sm flex items-center justify-center">
                                        Bayar Sekarang
                                    </a>
                                @elseif($res->status === 'accepted')
                                    <a href="{{ route('reservations.print', $res) }}" target="_blank" class="w-full py-2.5 rounded-xl text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                        Cetak E-Tiket PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
