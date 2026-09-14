<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="text-xs font-bold text-slate-400 mb-1 flex items-center space-x-2">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600">Admin</a>
                    <span>/</span>
                    <span class="text-slate-700">Kelola Reservasi</span>
                </nav>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Daftar Manajemen Reservasi
                </h2>
            </div>
            <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3.5 py-1.5 rounded-full">
                Total: {{ $reservations->total() }} Data
            </span>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen" x-data="{ selectedRes: null, showModal: false, filterStatus: 'all' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-2xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-xl bg-emerald-100 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-black text-emerald-900">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Quick Filter Tabs -->
            <div class="flex flex-wrap gap-2 text-xs font-bold">
                <button @click="filterStatus = 'all'" :class="filterStatus === 'all' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 rounded-full transition-all">
                    Semua
                </button>
                <button @click="filterStatus = 'pending'" :class="filterStatus === 'pending' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 rounded-full transition-all">
                    🟡 Pending
                </button>
                <button @click="filterStatus = 'paid'" :class="filterStatus === 'paid' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 rounded-full transition-all">
                    🔵 Sudah Bayar (Perlu Verifikasi)
                </button>
                <button @click="filterStatus = 'accepted'" :class="filterStatus === 'accepted' ? 'bg-brand-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 rounded-full transition-all">
                    🟢 Diterima
                </button>
                <button @click="filterStatus = 'cancelled'" :class="filterStatus === 'cancelled' ? 'bg-rose-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50'" class="px-4 py-2 rounded-full transition-all">
                    🔴 Batal
                </button>
            </div>

            <!-- Table Container -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[11px] font-black uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                                <th class="px-6 py-4">No. Booking</th>
                                <th class="px-6 py-4">Pemesan</th>
                                <th class="px-6 py-4">Jadwal Main</th>
                                <th class="px-6 py-4">Durasi</th>
                                <th class="px-6 py-4">Promo</th>
                                <th class="px-6 py-4">Total Biaya</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                            @forelse($reservations as $res)
                            <tr class="hover:bg-slate-50/60 transition-colors"
                                x-show="filterStatus === 'all' || filterStatus === '{{ $res->status }}'">
                                <td class="px-6 py-4">
                                    <span class="font-mono font-bold text-slate-900">#{{ $res->reservation_number ?? '-' }}</span>
                                    @if($res->type === 'event')
                                        <div class="mt-1">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-purple-100 text-purple-800">
                                                Acara: {{ $res->event_name }}
                                            </span>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900">{{ $res->user->name }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $res->user->email }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900">{{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }}</div>
                                    <div class="text-[11px] text-slate-400">{{ is_string($res->start_time) ? substr($res->start_time, 0, 5) : $res->start_time->format('H:i') }} WIB</div>
                                </td>

                                <td class="px-6 py-4 font-bold">
                                    {{ $res->duration }} Jam
                                </td>

                                <td class="px-6 py-4">
                                    @if($res->voucher)
                                        <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-mono font-bold text-[10px]">
                                            {{ $res->voucher->code }}
                                        </span>
                                    @else
                                        <span class="text-slate-300">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 font-black text-slate-900">
                                    Rp {{ number_format($res->total_price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    @if($res->status === 'pending')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-amber-100 text-amber-800">
                                            Pending
                                        </span>
                                    @elseif($res->status === 'paid')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-blue-100 text-blue-800">
                                            Sudah Bayar
                                        </span>
                                    @elseif($res->status === 'accepted')
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800">
                                            Diterima
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-rose-100 text-rose-800">
                                            Batal
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <button type="button" @click="selectedRes = JSON.parse($el.dataset.res); showModal = true" data-res="{{ json_encode($res) }}" 
                                                class="px-3.5 py-1.5 rounded-xl text-xs font-black text-white bg-slate-900 hover:bg-brand-600 shadow-sm transition-colors">
                                            Kelola
                                        </button>
                                        
                                        <form action="{{ route('admin.reservations.destroy', $res) }}" method="POST" onsubmit="return confirm('Hapus riwayat reservasi ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus Data">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-xs text-slate-400">Belum ada data reservasi masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-100">
                    {{ $reservations->links() }}
                </div>
            </div>

            <!-- Modal Kelola & Verifikasi Bukti -->
            <template x-teleport="body">
                <div x-show="showModal" class="fixed inset-0 flex items-center justify-center p-4 sm:p-6" style="z-index: 9999; display: none;">
                    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" @click="showModal = false"></div>
                    
                    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" 
                         class="bg-white rounded-3xl text-left shadow-2xl w-full max-w-2xl flex flex-col max-h-[90vh] relative z-10 overflow-hidden border border-slate-200">
                        
                        <!-- Modal Header -->
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                            <div>
                                <h3 class="text-lg font-black text-slate-900">Kelola Reservasi</h3>
                                <p class="text-xs text-slate-400 font-mono" x-text="selectedRes ? '#' + selectedRes.reservation_number : ''"></p>
                            </div>
                            <button type="button" @click="showModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="p-6 overflow-y-auto flex-1 space-y-6">
                            <template x-if="selectedRes">
                                <div class="space-y-6">
                                    <!-- Customer Info -->
                                    <div class="grid grid-cols-2 gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 text-xs">
                                        <div>
                                            <span class="text-slate-400 block mb-0.5">Nama Pemesan</span>
                                            <span class="font-black text-slate-900 text-sm" x-text="selectedRes.user.name"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-400 block mb-0.5">Email</span>
                                            <span class="font-bold text-slate-700" x-text="selectedRes.user.email"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-400 block mb-0.5">Jadwal Main</span>
                                            <span class="font-bold text-slate-900" x-text="selectedRes.reservation_date + ' (' + selectedRes.start_time.substring(0,5) + ' WIB)'"></span>
                                        </div>
                                        <div>
                                            <span class="text-slate-400 block mb-0.5">Total Tagihan</span>
                                            <span class="font-black text-brand-700 text-sm" x-text="'Rp ' + parseInt(selectedRes.total_price).toLocaleString('id-ID')"></span>
                                        </div>
                                    </div>

                                    <!-- Proof of Payment Image -->
                                    <div x-show="selectedRes.payment_proof" class="space-y-2">
                                        <span class="text-xs font-black uppercase tracking-wider text-slate-400">Bukti Pembayaran Customer:</span>
                                        <div class="bg-slate-900 p-3 rounded-2xl text-center">
                                            <a :href="'/storage/' + selectedRes.payment_proof" target="_blank" class="block group relative">
                                                <img :src="'/storage/' + selectedRes.payment_proof" class="max-h-72 object-contain rounded-xl mx-auto group-hover:opacity-90 transition-opacity">
                                                <span class="inline-block mt-2 text-xs font-bold text-emerald-400 group-hover:underline">Buka Ukuran Penuh &nearr;</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div x-show="!selectedRes.payment_proof" class="p-4 bg-amber-50 rounded-2xl border border-amber-200 text-xs text-amber-800 font-bold">
                                        Customer belum mengunggah bukti pembayaran.
                                    </div>

                                    <!-- Status Update Action -->
                                    <form :action="'/admin/reservations/' + selectedRes.id + '/status'" method="POST" class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-3">
                                        @csrf
                                        @method('PATCH')
                                        <label class="block text-xs font-black uppercase tracking-wider text-slate-600">Perbarui Status Pemesanan</label>
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <select name="status" class="w-full rounded-xl border-slate-200 text-xs font-bold text-slate-800 py-3" :value="selectedRes.status">
                                                <option value="pending">🟡 Pending (Menunggu Pembayaran)</option>
                                                <option value="paid">🔵 Lunas (Sudah Bayar, Menunggu Cek)</option>
                                                <option value="accepted">🟢 Diterima (Terkonfirmasi & Siap Main)</option>
                                                <option value="cancelled">🔴 Batal (Ditolak / Kedaluwarsa)</option>
                                            </select>
                                            <button type="submit" class="btn-shimmer px-6 py-3 rounded-xl font-black text-xs text-white bg-brand-600 hover:bg-brand-500 shadow-md shrink-0">
                                                Simpan Status
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                            <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-200/60 transition-colors">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>
</x-app-layout>
