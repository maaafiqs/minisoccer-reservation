<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Daftar Reservasi Anda</h3>
                        <a href="{{ route('reservations.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                            + Buat Reservasi
                        </a>
                    </div>

                    @if($reservations->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            Belum ada riwayat reservasi.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Reservasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($reservations as $res)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-semibold text-gray-700">{{ $res->reservation_number ?? '-' }}</div>
                                                @if($res->type === 'event')
                                                    <div class="mt-1">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200 shadow-sm">
                                                            Acara: {{ $res->event_name }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ is_string($res->start_time) ? substr($res->start_time, 0, 5) : $res->start_time->format('H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $res->duration }} Jam</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($res->total_price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($res->status === 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Pembayaran</span>
                                                    <div class="text-xs font-mono font-bold text-red-600 mt-1" 
                                                         x-data="{ 
                                                            deadline: new Date('{{ \Carbon\Carbon::parse($res->created_at)->addHours(24)->toIso8601String() }}').getTime(),
                                                            timeLeft: 'Menghitung...',
                                                            init() {
                                                                setInterval(() => {
                                                                    let distance = this.deadline - new Date().getTime();
                                                                    if(distance < 0) { this.timeLeft = 'EXPIRED'; return; }
                                                                    let h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                    let m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                                    let s = Math.floor((distance % (1000 * 60)) / 1000);
                                                                    this.timeLeft = h + 'j ' + m + 'm ' + s + 'd';
                                                                }, 1000);
                                                            }
                                                         }">
                                                         Batas: <span x-text="timeLeft"></span>
                                                    </div>
                                                @elseif($res->status === 'paid')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                                                @elseif($res->status === 'accepted')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Reservasi Diterima</span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex">
                                                @if($res->status === 'pending')
                                                    <a href="{{ route('reservations.pay.view', $res) }}" class="text-white bg-green-600 hover:bg-green-700 px-3 py-1.5 rounded shadow-md text-xs font-medium transition-transform transform hover:scale-105">
                                                        Bayar Sekarang
                                                    </a>
                                                @elseif($res->status === 'accepted')
                                                    <a href="{{ route('reservations.print', $res) }}" target="_blank" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded shadow-md text-xs font-medium transition-transform transform hover:scale-105 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                                        Cetak Bukti PDF
                                                    </a>
                                                @elseif($res->status === 'paid')
                                                    <span class="text-xs text-gray-500 italic">Menunggu Konfirmasi</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
