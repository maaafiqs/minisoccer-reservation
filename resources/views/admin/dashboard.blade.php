<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs font-bold text-slate-400 mb-1 flex items-center space-x-2">
                    <span>Admin</span>
                    <span>/</span>
                    <span class="text-slate-700">Dashboard Statistik</span>
                </nav>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Statistik & Analisis Bisnis
                </h2>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.reservations.index') }}" class="btn-shimmer inline-flex items-center px-5 py-2.5 rounded-full text-xs font-black text-white bg-slate-900 hover:bg-brand-600 shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Kelola Semua Reservasi
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Metric KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Total Revenue -->
                <div class="bg-gradient-to-br from-brand-600 to-emerald-700 rounded-3xl p-6 sm:p-8 text-white shadow-premium relative overflow-hidden transform hover:-translate-y-1 transition-all">
                    <div class="absolute top-0 right-0 -mr-6 -mt-6 w-32 h-32 bg-white/10 rounded-full blur-xl"></div>
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs font-black uppercase tracking-wider text-emerald-200">Total Omset Pendapatan</span>
                        <div class="p-2.5 rounded-2xl bg-white/15 backdrop-blur-md">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="text-3xl sm:text-4xl font-black mb-2 tracking-tight">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </div>
                    <p class="text-xs text-emerald-100 font-medium">Dari reservasi terverifikasi (lunas/diterima)</p>
                </div>

                <!-- Card 2: Total Reservations -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm hover:shadow-md hover:border-blue-300 transform hover:-translate-y-1 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs font-black uppercase tracking-wider text-slate-400">Total Reservasi Masuk</span>
                        <div class="p-2.5 rounded-2xl bg-blue-50 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="text-3xl sm:text-4xl font-black text-slate-900 mb-2 tracking-tight">
                        {{ $totalReservations }} <span class="text-sm font-bold text-slate-400">Jadwal</span>
                    </div>
                    <p class="text-xs text-slate-500">Semua reservasi reguler & event</p>
                </div>

                <!-- Card 3: Total Users -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm hover:shadow-md hover:border-purple-300 transform hover:-translate-y-1 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs font-black uppercase tracking-wider text-slate-400">Pemain Terdaftar</span>
                        <div class="p-2.5 rounded-2xl bg-purple-50 text-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                    <div class="text-3xl sm:text-4xl font-black text-slate-900 mb-2 tracking-tight">
                        {{ $totalUsers }} <span class="text-sm font-bold text-slate-400">Member</span>
                    </div>
                    <p class="text-xs text-slate-500">Komunitas pengguna aktif di sistem</p>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-black text-slate-900">Tren Pemesanan (7 Hari Terakhir)</h3>
                        <p class="text-xs text-slate-500">Distribusi jumlah reservasi per hari antara Reguler vs Acara/Event.</p>
                    </div>
                </div>
                <div class="relative h-80 w-full">
                    <canvas id="reservationsChart"></canvas>
                </div>
            </div>

            <!-- Recent Transactions Table -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-base font-black text-slate-900">Transaksi Pemesanan Terbaru</h3>
                        <p class="text-xs text-slate-500">5 pemesanan terakhir yang masuk ke sistem.</p>
                    </div>
                    <a href="{{ route('admin.reservations.index') }}" class="text-xs font-black text-brand-600 hover:text-brand-700 bg-brand-50 px-3.5 py-1.5 rounded-full transition-colors">
                        Lihat Semua &rarr;
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[11px] font-black uppercase tracking-wider text-slate-400 bg-slate-50/60 border-b border-slate-100">
                                <th class="px-6 py-4">Pemesan</th>
                                <th class="px-6 py-4">Jadwal Main</th>
                                <th class="px-6 py-4">Total Tarif</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                            @forelse($recentTransactions as $res)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-black text-xs flex items-center justify-center shrink-0">
                                            {{ strtoupper(substr($res->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-900">{{ $res->user->name }}</div>
                                            <div class="text-[11px] font-mono text-slate-400">#{{ $res->reservation_number }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }}</div>
                                    <div class="text-[11px] text-slate-400">{{ substr($res->start_time, 0, 5) }} WIB ({{ $res->duration }} Jam)</div>
                                </td>

                                <td class="px-6 py-4 font-black text-slate-900">
                                    Rp {{ number_format($res->total_price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($res->status === 'pending')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-amber-100 text-amber-800">
                                            Menunggu Bayar
                                        </span>
                                    @elseif($res->status === 'paid')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800">
                                            Dibayar (Cek Resi)
                                        </span>
                                    @elseif(in_array($res->status, ['accepted', 'diterima', 'selesai', 'completed']))
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-blue-100 text-blue-800">
                                            Diterima
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-rose-100 text-rose-800">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.reservations.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700">
                                        Kelola &rarr;
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-xs text-slate-400">Belum ada transaksi masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('reservationsChart');
            if(!ctx) return;
            
            const labels = @json($chartLabels ?? []);
            const dataRegular = @json($chartDataRegular ?? []);
            const dataEvent = @json($chartDataEvent ?? []);
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Reguler',
                            data: dataRegular,
                            backgroundColor: '#10b981',
                            borderRadius: 8,
                            borderSkipped: false
                        },
                        {
                            label: 'Acara / Turnamen',
                            data: dataEvent,
                            backgroundColor: '#8b5cf6',
                            borderRadius: 8,
                            borderSkipped: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: { family: 'Outfit', weight: 'bold', size: 12 },
                                boxWidth: 12,
                                borderRadius: 4,
                                useBorderRadius: true
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0, font: { family: 'Outfit', size: 11 } },
                            grid: { color: '#f1f5f9' }
                        },
                        x: {
                            ticks: { font: { family: 'Outfit', size: 11, weight: 'bold' } },
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
