<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ selectedRes: null, showModal: false }">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Reservasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemesan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jadwal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Voucher</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($reservations as $res)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">
                                        {{ $res->reservation_number ?? '-' }}
                                        @if($res->type === 'event')
                                            <div class="mt-1">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200 shadow-sm">
                                                    Acara: {{ $res->event_name }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $res->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $res->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ is_string($res->start_time) ? substr($res->start_time, 0, 5) : $res->start_time->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $res->duration }} Jam</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $res->voucher ? $res->voucher->code : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Rp {{ number_format($res->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($res->status === 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        @elseif($res->status === 'paid')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                                        @elseif($res->status === 'accepted')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Reservasi Diterima</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Batal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex flex-col space-y-2">
                                            <button type="button" @click="selectedRes = JSON.parse($el.dataset.res); showModal = true" data-res="{{ json_encode($res) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded text-xs shadow-sm font-bold transition transform hover:scale-105">Kelola Reservasi</button>
                                            
                                            <form action="{{ route('admin.reservations.destroy', $res) }}" method="POST" class="inline-block w-full" onsubmit="return confirm('Hapus riwayat reservasi ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full text-center bg-white border border-red-200 text-red-600 hover:bg-red-50 hover:text-red-900 px-3 py-1.5 rounded text-xs transition shadow-sm font-bold">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada data reservasi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $reservations->links() }}
                    </div>
                </div>

                <!-- Modal Kelola Reservasi (Flex Layout) -->
                <template x-teleport="body">
                    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center p-4 sm:p-6" style="z-index: 9999; display: none;">
                    <!-- Background overlay -->
                    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" @click="showModal = false"></div>
                    
                    <!-- Modal Panel -->
                    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-2xl text-left shadow-2xl transform transition-all w-full max-w-2xl flex flex-col max-h-[85vh] relative z-10 overflow-hidden">
                        
                        <!-- Header (Sticky) -->
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center rounded-t-2xl bg-white shrink-0">
                            <h3 class="text-xl font-black text-gray-900">Detail Reservasi</h3>
                            <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-500 transition-colors focus:outline-none">
                                <span class="sr-only">Tutup</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Body (Scrollable) -->
                        <div class="p-6 overflow-y-auto flex-1">
                            <template x-if="selectedRes">
                                <div class="grid grid-cols-2 gap-6">
                                    <!-- Detail Pemesan -->
                                    <div class="col-span-2 sm:col-span-1 bg-gray-50 rounded-xl p-4 border border-gray-100">
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Nama Pemesan</p>
                                        <p class="font-bold text-gray-900 text-lg" x-text="selectedRes.user.name"></p>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1 bg-gray-50 rounded-xl p-4 border border-gray-100">
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Email Pemesan</p>
                                        <p class="font-medium text-gray-900 text-base break-all" x-text="selectedRes.user.email"></p>
                                    </div>

                                    <!-- Keterangan Acara (Tampil jika type == event) -->
                                    <template x-if="selectedRes.type === 'event'">
                                        <div class="col-span-2 bg-purple-50 rounded-xl p-4 border border-purple-100 flex items-center shadow-sm">
                                            <div class="mr-4 bg-purple-200 p-3 rounded-full text-purple-700">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-purple-600 uppercase tracking-wider mb-1">Pemesanan Khusus Acara / Turnamen</p>
                                                <p class="font-black text-purple-900 text-xl" x-text="selectedRes.event_name"></p>
                                            </div>
                                        </div>
                                    </template>
                                    <div class="col-span-2 sm:col-span-1">
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Tanggal & Jam</p>
                                        <p class="font-bold text-green-700 bg-green-50 inline-block px-3 py-1 rounded-lg border border-green-100" x-text="new Date(selectedRes.reservation_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'}) + ' | ' + selectedRes.start_time.substring(0,5) + ' WIB'"></p>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Total Tagihan <span x-show="selectedRes.voucher_id" class="ml-2 text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">Pakai Voucher</span></p>
                                        <p class="font-black text-gray-900 text-xl" x-text="'Rp ' + parseInt(selectedRes.total_price).toLocaleString('id-ID')"></p>
                                        <p class="text-sm text-gray-500 font-medium mt-1" x-text="'(Durasi: ' + selectedRes.duration + ' Jam)'"></p>
                                    </div>
                                    
                                    <!-- Payment Proof Image -->
                                    <div class="col-span-2 mt-2" x-show="selectedRes.payment_proof">
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Bukti Pembayaran</p>
                                        <div class="bg-gray-100 rounded-xl p-2 border border-gray-200 flex justify-center">
                                            <a :href="'/storage/' + selectedRes.payment_proof" target="_blank" class="block relative group cursor-pointer w-full text-center">
                                                <img :src="'/storage/' + selectedRes.payment_proof" class="max-h-64 object-contain rounded-lg transition-opacity group-hover:opacity-90 mx-auto">
                                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/30 rounded-lg">
                                                    <span class="bg-white text-gray-900 font-bold text-sm px-4 py-2 rounded-full shadow-lg">Buka Gambar Penuh</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- Form Update Status -->
                                    <div class="col-span-2 mt-4 pt-6 border-t border-gray-100">
                                        <form :action="'/admin/reservations/' + selectedRes.id + '/status'" method="POST" class="bg-indigo-50 rounded-xl p-5 border border-indigo-100">
                                            @csrf
                                            @method('PATCH')
                                            <label class="block text-sm font-black text-indigo-900 mb-3 uppercase tracking-wider">Ubah Status Reservasi</label>
                                            <div class="flex flex-col sm:flex-row gap-3">
                                                <select name="status" class="block w-full bg-white border-gray-300 text-gray-900 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-medium py-3" :value="selectedRes.status">
                                                    <option value="pending">🟡 Pending (Menunggu Pembayaran)</option>
                                                    <option value="paid">🔵 Lunas (Sudah Bayar, Menunggu Cek)</option>
                                                    <option value="accepted">🟢 Terima Reservasi (Terkonfirmasi)</option>
                                                    <option value="cancelled">🔴 Batal (Ditolak / Kedaluwarsa)</option>
                                                </select>
                                                <button type="submit" class="w-full sm:w-auto bg-indigo-600 text-white px-6 py-3 rounded-xl shadow-md hover:bg-indigo-700 font-bold whitespace-nowrap transition-all duration-200 transform hover:-translate-y-0.5">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Footer (Sticky) -->
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end rounded-b-2xl shrink-0">
                            <button type="button" @click="showModal = false" class="w-full sm:w-auto inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-2.5 bg-white text-base font-bold text-gray-700 hover:bg-gray-100 focus:outline-none transition-colors">Tutup Jendela</button>
                        </div>
                        
                    </div>
                </div>
                </template>

            </div>
        </div>
    </div>
</x-app-layout>
