<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('reservations.index') }}" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Pembayaran Reservasi
                </h2>
                <p class="text-xs text-slate-500">Selesaikan pembayaran untuk mengonfirmasi jadwal main tim Anda.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen" x-data="{ copiedBca: false, copiedBni: false }">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Payment Deadline Alert Banner -->
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-3xl p-6 text-white shadow-xl flex flex-col sm:flex-row items-center justify-between gap-4 relative overflow-hidden"
                 x-data="{ 
                    deadline: new Date('{{ \Carbon\Carbon::parse($reservation->created_at)->addHours(24)->toIso8601String() }}').getTime(),
                    timeLeft: 'Menghitung...',
                    init() {
                        setInterval(() => {
                            let distance = this.deadline - new Date().getTime();
                            if(distance < 0) { this.timeLeft = 'KADALUARSA'; return; }
                            let h = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                            let m = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                            let s = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                            this.timeLeft = h + ' : ' + m + ' : ' + s;
                        }, 1000);
                    }
                 }">
                <div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase bg-white/20 tracking-wider">
                        BATAS WAKTU 24 JAM
                    </span>
                    <h3 class="text-lg font-black mt-1">Sisa Waktu Pembayaran</h3>
                    <p class="text-xs text-amber-100">Batas akhir: {{ \Carbon\Carbon::parse($reservation->created_at)->addHours(24)->format('d M Y, H:i') }} WIB</p>
                </div>
                <div class="bg-slate-950/40 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20 font-mono text-2xl sm:text-3xl font-black tracking-widest text-yellow-300">
                    <span x-text="timeLeft"></span>
                </div>
            </div>

            <!-- Invoice Summary Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-premium">
                
                <div class="flex justify-between items-center pb-6 border-b border-slate-100">
                    <div>
                        <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Nomor Booking</span>
                        <div class="text-xl font-black text-slate-900 font-mono">#{{ $reservation->reservation_number }}</div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Tagihan</span>
                        <div class="text-2xl sm:text-3xl font-black text-brand-700">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</div>
                    </div>
                </div>

                <!-- Match Details -->
                <div class="py-4 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs border-b border-slate-100">
                    <div>
                        <span class="text-slate-400 block">Lapangan</span>
                        <span class="font-extrabold text-slate-800">{{ $reservation->field->name ?? 'Lapangan' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Tanggal Main</span>
                        <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Jam & Durasi</span>
                        <span class="font-bold text-slate-800">{{ is_string($reservation->start_time) ? substr($reservation->start_time, 0, 5) : $reservation->start_time->format('H:i') }} WIB ({{ $reservation->duration }} Jam)</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Status Pembayaran</span>
                        <span class="inline-block font-black text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full mt-0.5">Menunggu Bukti</span>
                    </div>
                </div>

                <!-- Bank Accounts for Transfer -->
                <div class="pt-6">
                    <h4 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-4">
                        Transfer ke Rekening Resmi Maaafiqs:
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <!-- BCA Card -->
                        <div class="p-5 rounded-2xl border-2 border-slate-200 bg-slate-50/60 hover:border-blue-300 transition-colors relative">
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-black bg-blue-600 text-white">BCA</span>
                                <span class="text-[10px] text-slate-400 font-bold uppercase">Bank Transfer</span>
                            </div>
                            <div class="font-mono text-xl font-black text-slate-900 tracking-wider mb-1">
                                1234 5678 90
                            </div>
                            <p class="text-xs text-slate-500 mb-4">a.n. PT Maaafiqs Mini Soccer</p>
                            <button type="button" @click="navigator.clipboard.writeText('1234567890'); copiedBca = true; setTimeout(() => copiedBca = false, 2000)"
                                    class="w-full py-2 rounded-xl text-xs font-bold border transition-colors flex items-center justify-center"
                                    :class="copiedBca ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100'">
                                <span x-text="copiedBca ? '✓ Berhasil Disalin!' : 'Salin Nomor Rekening'"></span>
                            </button>
                        </div>

                        <!-- BNI Card -->
                        <div class="p-5 rounded-2xl border-2 border-slate-200 bg-slate-50/60 hover:border-orange-300 transition-colors relative">
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-black bg-orange-600 text-white">BNI</span>
                                <span class="text-[10px] text-slate-400 font-bold uppercase">Bank Transfer</span>
                            </div>
                            <div class="font-mono text-xl font-black text-slate-900 tracking-wider mb-1">
                                0987 6543 21
                            </div>
                            <p class="text-xs text-slate-500 mb-4">a.n. PT Maaafiqs Mini Soccer</p>
                            <button type="button" @click="navigator.clipboard.writeText('0987654321'); copiedBni = true; setTimeout(() => copiedBni = false, 2000)"
                                    class="w-full py-2 rounded-xl text-xs font-bold border transition-colors flex items-center justify-center"
                                    :class="copiedBni ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100'">
                                <span x-text="copiedBni ? '✓ Berhasil Disalin!' : 'Salin Nomor Rekening'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Upload Proof Form -->
                    <form action="{{ route('reservations.pay', $reservation) }}" method="POST" enctype="multipart/form-data" x-data="{ fileName: '', filePreview: '' }">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                                Unggah Bukti Transfer / Resi Pembayaran <span class="text-rose-500">*</span>
                            </label>

                            <div class="p-6 border-2 border-dashed border-slate-300 rounded-3xl text-center hover:border-brand-500 bg-slate-50/50 transition-colors">
                                <div x-show="!filePreview">
                                    <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700 mb-1">Klik untuk memilih file resi transfer</p>
                                    <p class="text-[11px] text-slate-400 mb-3">Format JPG, PNG, atau JPEG (Maks. 2MB)</p>
                                    <label for="payment_proof" class="cursor-pointer inline-flex items-center px-4 py-2 rounded-xl text-xs font-black text-white bg-slate-900 hover:bg-slate-800 shadow-sm">
                                        Pilih Gambar
                                        <input id="payment_proof" name="payment_proof" type="file" class="sr-only" accept="image/*" 
                                               @change="fileName = $refs.file.files[0].name; const reader = new FileReader(); reader.onload = (e) => filePreview = e.target.result; reader.readAsDataURL($refs.file.files[0])" 
                                               x-ref="file" required>
                                    </label>
                                </div>

                                <div x-show="filePreview" style="display: none;" class="space-y-3">
                                    <img :src="filePreview" class="mx-auto h-52 object-contain rounded-2xl shadow-sm border border-slate-200">
                                    <p class="text-xs font-bold text-slate-700" x-text="fileName"></p>
                                    <button type="button" @click="filePreview = ''; fileName = ''; $refs.file.value = ''" 
                                            class="text-xs text-rose-600 hover:text-rose-700 font-bold underline">
                                        Ganti Gambar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                            <a href="{{ route('reservations.index') }}" class="px-6 py-3 rounded-full text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">
                                Nanti Saja
                            </a>
                            <button type="submit" class="btn-shimmer inline-flex items-center px-8 py-3.5 rounded-full font-black text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-500 hover:to-emerald-400 shadow-glow-green text-xs">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Kirim Bukti Transfer
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
