<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Dashboard Statistik Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistic Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card 1: Revenue -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-3xl p-6 shadow-lg shadow-green-500/30 text-white relative overflow-hidden transform transition-all duration-300 hover:-translate-y-1">
                    <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 rounded-full bg-white opacity-10"></div>
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-green-100 font-medium text-sm mb-1">Total Pendapatan</div>
                            <div class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-2xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Reservations -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 relative overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-gray-500 font-medium text-sm mb-1">Total Reservasi Masuk</div>
                            <div class="text-3xl font-bold text-gray-900">{{ $totalReservations }} <span class="text-sm font-normal text-gray-400">Jadwal</span></div>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-2xl text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Users -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 relative overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-gray-500 font-medium text-sm mb-1">Total Pengguna Terdaftar</div>
                            <div class="text-3xl font-bold text-gray-900">{{ $totalUsers }} <span class="text-sm font-normal text-gray-400">Member</span></div>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-2xl text-purple-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-3xl mb-8">
                <div class="p-8 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Statistik Reservasi (7 Hari Terakhir)</h3>
                        <p class="text-sm text-gray-500">Jumlah pemesanan per hari, dikelompokkan berdasarkan jenis reservasi (Reguler vs Acara/Event).</p>
                    </div>
                    <div class="relative h-72 w-full">
                        <canvas id="reservationsChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions Table -->
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-3xl">
                <div class="p-8 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Transaksi Terbaru</h3>
                            <p class="text-sm text-gray-500">5 pemesanan terakhir yang masuk ke sistem.</p>
                        </div>
                        <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center text-green-600 hover:text-green-700 bg-green-50 hover:bg-green-100 px-4 py-2 rounded-full text-sm font-semibold transition-colors">
                            Lihat Semua <span class="ml-1">&rarr;</span>
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-sm font-semibold text-gray-500 border-b border-gray-100 bg-gray-50/50">
                                    <th class="px-6 py-4 rounded-tl-2xl">Pemesan</th>
                                    <th class="px-6 py-4">Jadwal Main</th>
                                    <th class="px-6 py-4">Total Tarif</th>
                                    <th class="px-6 py-4 rounded-tr-2xl">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentTransactions as $res)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-gray-200 to-gray-300 flex items-center justify-center text-gray-600 font-bold mr-3">
                                                {{ substr($res->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-900">{{ $res->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $res->reservation_number }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($res->reservation_date)->translatedFormat('d M Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ substr($res->start_time, 0, 5) }} WIB ({{ $res->duration }} Jam)</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-gray-900">Rp {{ number_format($res->total_price, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($res->status === 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                                <span class="w-2 h-2 rounded-full bg-amber-500 mr-2"></span> Menunggu Bayar
                                            </span>
                                        @elseif($res->status === 'paid')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                                <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span> Dibayar (Perlu Cek)
                                            </span>
                                        @elseif(in_array($res->status, ['accepted', 'diterima', 'selesai', 'completed']))
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                                <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span> Diterima
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                                <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span> Dibatalkan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        Belum ada reservasi masuk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
                            backgroundColor: '#22c55e',
                            borderRadius: 6,
                            borderSkipped: false
                        },
                        {
                            label: 'Acara / Turnamen',
                            data: dataEvent,
                            backgroundColor: '#a855f7',
                            borderRadius: 6,
                            borderSkipped: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            grid: { display: false }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'end',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8,
                                padding: 20,
                                font: {
                                    family: "'Outfit', sans-serif",
                                    weight: '600',
                                    size: 13
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleFont: { family: "'Outfit', sans-serif", size: 14 },
                            bodyFont: { family: "'Outfit', sans-serif", size: 13 },
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
