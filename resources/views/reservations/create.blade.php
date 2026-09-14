<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <nav class="text-xs font-bold text-slate-400 mb-1 flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}" class="hover:text-brand-600">Dashboard</a>
                    <span>/</span>
                    <span class="text-slate-700">Booking Baru</span>
                </nav>
                <h2 class="font-black text-2xl text-slate-900 tracking-tight">
                    Reservasi Jadwal Lapangan
                </h2>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-brand-100 text-brand-700">
                ● SISTEM AKTIF 24 JAM
            </span>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen" x-data="reservationForm()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if($errors->any())
                <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-2xl shadow-sm">
                    <div class="flex">
                        <div class="shrink-0 text-rose-500">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-black text-rose-900">Perhatian:</h3>
                            <ul class="mt-1 text-xs text-rose-700 list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form x-ref="bookingForm" action="{{ route('reservations.store') }}" method="POST" @submit.prevent="showConfirmModal = true">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- LEFT COLUMN: Booking Steps -->
                    <div class="lg:col-span-8 space-y-6">
                        
                        <!-- Step 1: Jenis Reservasi & Lapangan -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                            <div class="flex items-center space-x-3 mb-6">
                                <span class="w-8 h-8 rounded-xl bg-brand-500 text-white flex items-center justify-center font-black text-sm shadow-glow-green">1</span>
                                <div>
                                    <h3 class="text-lg font-black text-slate-900">Pilih Jenis & Lapangan</h3>
                                    <p class="text-xs text-slate-500">Tentukan tipe pertandingan dan lapangan yang ingin digunakan.</p>
                                </div>
                            </div>

                            <!-- Radio Tipe -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="type" value="regular" x-model="type" class="peer sr-only">
                                    <div class="p-4 rounded-2xl border-2 text-center font-black text-sm transition-all duration-200
                                        bg-white text-slate-700 border-slate-200 hover:border-brand-300 peer-checked:bg-brand-50 peer-checked:text-brand-700 peer-checked:border-brand-500 peer-checked:shadow-sm">
                                        ⚽ Pertandingan Reguler
                                    </div>
                                </label>

                                <label class="cursor-pointer relative">
                                    <input type="radio" name="type" value="event" x-model="type" class="peer sr-only">
                                    <div class="p-4 rounded-2xl border-2 text-center font-black text-sm transition-all duration-200
                                        bg-white text-slate-700 border-slate-200 hover:border-brand-300 peer-checked:bg-brand-50 peer-checked:text-brand-700 peer-checked:border-brand-500 peer-checked:shadow-sm">
                                        🏆 Acara / Turnamen (Min. H-3)
                                    </div>
                                </label>
                            </div>

                            <!-- Event Name Input (If event) -->
                            <div x-show="type === 'event'" x-transition class="mb-6 p-4 bg-purple-50 rounded-2xl border border-purple-200" style="display: none;">
                                <label for="event_name" class="block text-xs font-black uppercase text-purple-900 mb-1.5">
                                    Nama Acara / Turnamen <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="event_name" id="event_name" x-model="eventName" 
                                       class="w-full rounded-xl border-purple-200 focus:border-purple-500 focus:ring-purple-500 text-sm font-bold text-slate-800"
                                       placeholder="Contoh: Turnamen Mini Soccer Cup 2026" :required="type === 'event'">
                            </div>

                            <!-- Field Cards -->
                            <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-3">
                                Pilihan Lapangan Mini Soccer:
                            </label>
                            @if($fields->isEmpty())
                                <div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-2xl p-6 text-center text-sm font-bold">
                                    Belum ada data lapangan yang aktif. Silakan hubungi admin.
                                </div>
                            @else
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($fields as $field)
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="field_id" value="{{ $field->id }}" x-model="fieldId" @change="onFieldChange" class="peer sr-only" required>
                                        <div class="rounded-2xl border-2 p-4 text-left transition-all duration-200 bg-white border-slate-200 hover:border-brand-300 peer-checked:border-brand-500 peer-checked:bg-brand-50/50 peer-checked:ring-2 peer-checked:ring-brand-200">
                                            <div class="flex justify-between items-start mb-2">
                                                <h4 class="font-black text-slate-900 text-base">{{ $field->name }}</h4>
                                                <span class="w-4 h-4 rounded-full border-2 border-slate-300 group-hover:border-brand-400 peer-checked:border-brand-500 peer-checked:bg-brand-500 flex items-center justify-center"></span>
                                            </div>
                                            <div class="space-y-1 text-xs text-slate-500">
                                                <div class="flex justify-between">
                                                    <span>Siang:</span>
                                                    <span class="font-black text-slate-800">Rp {{ number_format($field->weekday_day_price, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span>Malam:</span>
                                                    <span class="font-black text-emerald-700">Rp {{ number_format($field->weekday_night_price, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span>Weekend:</span>
                                                    <span class="font-black text-amber-700">Rp {{ number_format($field->weekend_price, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Step 2: Tanggal & Jadwal Kalender -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm" x-show="fieldId" x-transition>
                            <div class="flex items-center space-x-3 mb-6">
                                <span class="w-8 h-8 rounded-xl bg-brand-500 text-white flex items-center justify-center font-black text-sm shadow-glow-green">2</span>
                                <div>
                                    <h3 class="text-lg font-black text-slate-900">Pilih Tanggal Main</h3>
                                    <p class="text-xs text-slate-500">Pilih tanggal melalui kolom input atau langsung klik tanggal pada kalender.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                                <div class="md:col-span-5">
                                    <label for="reservation_date" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                                        Tanggal Pertandingan
                                    </label>
                                    <input type="date" name="reservation_date" id="reservation_date" 
                                           x-model="date" 
                                           @change="fetchBookedSlots"
                                           :min="minDateAttr"
                                           class="w-full rounded-2xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-base font-bold text-slate-800 py-3.5 px-4 shadow-sm" required>

                                    <div class="mt-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 text-xs text-slate-500 space-y-2">
                                        <div class="flex items-center font-bold text-slate-700">
                                            <svg class="w-4 h-4 mr-1.5 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Petunjuk Kalender
                                        </div>
                                        <p>Tanggal dengan agenda yang sudah terisi akan tampil di kalender. Klik tanggal manapun untuk memilihnya secara cepat.</p>
                                    </div>
                                </div>

                                <div class="md:col-span-7 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                                    <div id="calendar" class="bg-white p-3 rounded-xl shadow-sm border border-slate-100 text-xs min-h-[360px]"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Pilihan Jam & Durasi -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm" x-show="date && fieldId" x-transition style="display: none;">
                            <div class="flex items-center space-x-3 mb-6">
                                <span class="w-8 h-8 rounded-xl bg-brand-500 text-white flex items-center justify-center font-black text-sm shadow-glow-green">3</span>
                                <div>
                                    <h3 class="text-lg font-black text-slate-900">Pilih Jam Mulai & Durasi</h3>
                                    <p class="text-xs text-slate-500">Klik jam yang tersedia di bawah ini (08:00 s.d 23:00 WIB).</p>
                                </div>
                            </div>

                            <!-- Time Slots Grid -->
                            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2.5 mb-8">
                                <template x-for="time in timeSlots" :key="time">
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="start_time" :value="time" x-model="selectedTime" class="peer sr-only" :disabled="isBooked(time)">
                                        <div class="rounded-2xl border-2 py-2.5 px-1 text-center font-black text-xs sm:text-sm transition-all duration-200 shadow-sm"
                                             :class="{
                                                'bg-slate-100 text-slate-300 border-slate-200/50 cursor-not-allowed line-through opacity-60': isBooked(time),
                                                'bg-white text-slate-700 border-slate-200 hover:border-brand-400 hover:shadow-sm peer-checked:bg-brand-600 peer-checked:text-white peer-checked:border-brand-600 peer-checked:shadow-glow-green peer-checked:-translate-y-0.5': !isBooked(time)
                                             }">
                                            <span x-text="time.substring(0,5)"></span>
                                        </div>
                                    </label>
                                </template>
                            </div>

                            <!-- Durasi & Voucher Section (When time selected) -->
                            <div x-show="selectedTime" x-transition class="pt-6 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                                        Durasi Bermain
                                    </label>
                                    <div class="flex flex-wrap gap-2">
                                        <template x-for="i in maxDuration()" :key="i">
                                            <label class="cursor-pointer relative">
                                                <input type="radio" name="duration" :value="i" x-model.number="duration" class="peer sr-only">
                                                <div class="rounded-xl border-2 py-2 px-4 text-center text-xs font-black transition-all duration-200
                                                     bg-white text-slate-700 border-slate-200 hover:border-brand-300 peer-checked:bg-brand-50 peer-checked:text-brand-700 peer-checked:border-brand-500">
                                                    <span x-text="i + ' Jam'"></span>
                                                </div>
                                            </label>
                                        </template>
                                    </div>
                                    <p class="text-[11px] font-bold text-amber-600 mt-2 bg-amber-50 p-2 rounded-xl border border-amber-200" x-show="maxDuration() < 12">
                                        Durasi dibatasi oleh jadwal reservasi pemain lain berikutnya.
                                    </p>
                                </div>

                                <div>
                                    <label for="voucher_code" class="block text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                                        Kode Promo / Voucher
                                    </label>
                                    <div class="flex gap-2">
                                        <input type="text" name="voucher_code" id="voucher_code" x-model="voucherCode" placeholder="Masukkan kode promo" 
                                               class="w-full rounded-xl border-slate-200 focus:border-brand-500 focus:ring-brand-500 text-xs font-bold uppercase py-2.5 px-3">
                                        <button type="button" @click="checkVoucher" 
                                                class="px-4 py-2.5 rounded-xl font-black text-xs bg-slate-900 hover:bg-slate-800 text-white transition-colors">
                                            Gunakan
                                        </button>
                                    </div>
                                    <p class="text-xs mt-2 font-bold" :class="voucherMessageClass" x-show="voucherMessage" x-text="voucherMessage"></p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT COLUMN: Sticky Order Summary -->
                    <div class="lg:col-span-4 sticky top-28 space-y-6">
                        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-premium">
                            <h3 class="text-base font-black text-slate-900 pb-3 border-b border-slate-100 flex items-center justify-between">
                                <span>Ringkasan Booking</span>
                                <span class="w-2.5 h-2.5 rounded-full bg-brand-500 animate-pulse"></span>
                            </h3>

                            <div class="py-4 space-y-3 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Tipe Booking</span>
                                    <span class="font-bold text-slate-800 uppercase" x-text="type"></span>
                                </div>
                                <div class="flex justify-between" x-show="type === 'event' && eventName">
                                    <span class="text-slate-400">Nama Acara</span>
                                    <span class="font-bold text-slate-800" x-text="eventName"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Lapangan</span>
                                    <span class="font-black text-slate-900" x-text="getSelectedFieldName()"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Tanggal Main</span>
                                    <span class="font-bold text-slate-800" x-text="formatDate(date) || '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Waktu Main</span>
                                    <span class="font-bold text-slate-800" x-text="selectedTime ? (selectedTime.substring(0,5) + ' WIB (' + duration + ' Jam)') : '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Tarif Per Jam</span>
                                    <span class="font-bold text-slate-800" x-text="'Rp ' + basePrice.toLocaleString('id-ID')"></span>
                                </div>
                                <div class="flex justify-between text-brand-600 font-bold" x-show="voucherData" style="display: none;">
                                    <span>Diskon Promo</span>
                                    <span x-text="'- Rp ' + discountAmount.toLocaleString('id-ID')"></span>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-100">
                                <div class="flex justify-between items-baseline mb-6">
                                    <span class="text-xs font-bold text-slate-500">Total Tagihan</span>
                                    <span class="text-2xl font-black text-brand-700" x-text="'Rp ' + totalTagihan.toLocaleString('id-ID')"></span>
                                </div>

                                <button type="submit" :disabled="!fieldId || !date || !selectedTime"
                                        class="btn-shimmer w-full py-4 rounded-2xl font-black text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-500 hover:to-emerald-400 shadow-glow-green transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none transition-all text-sm">
                                    Lanjut Konfirmasi Pesanan
                                </button>
                                <p class="text-[11px] text-center text-slate-400 mt-3">
                                    Tiket dan batas pembayaran 24 jam akan diterbitkan setelah konfirmasi.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Confirmation Modal -->
                <div x-show="showConfirmModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                        <div x-show="showConfirmModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm" @click="showConfirmModal = false"></div>

                        <div x-show="showConfirmModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" 
                             class="relative bg-white rounded-3xl p-6 sm:p-8 text-left shadow-2xl max-w-md w-full z-10 border border-slate-100">
                            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>

                            <h3 class="text-xl font-black text-slate-900 mb-2">Konfirmasi Pemesanan</h3>
                            <p class="text-xs text-slate-500 leading-relaxed mb-6">
                                Pastikan rincian pesanan Anda sudah tepat. Setelah submit, Anda memiliki waktu 24 jam untuk melakukan pembayaran.
                            </p>

                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-2 text-xs mb-6">
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Lapangan:</span>
                                    <span class="font-black text-slate-800" x-text="getSelectedFieldName()"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Jadwal:</span>
                                    <span class="font-bold text-slate-800" x-text="date + ', ' + selectedTime.substring(0,5) + ' WIB'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Durasi:</span>
                                    <span class="font-bold text-slate-800" x-text="duration + ' Jam'"></span>
                                </div>
                                <div class="flex justify-between pt-2 border-t border-slate-200 text-sm">
                                    <span class="font-black text-slate-900">Total Biaya:</span>
                                    <span class="font-black text-brand-600" x-text="'Rp ' + totalTagihan.toLocaleString('id-ID')"></span>
                                </div>
                            </div>

                            <div class="flex space-x-3">
                                <button type="button" @click="showConfirmModal = false" class="flex-1 py-3 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50">
                                    Periksa Lagi
                                </button>
                                <button type="button" @click="$refs.bookingForm.submit()" class="flex-1 py-3 rounded-xl text-xs font-black text-white bg-brand-600 hover:bg-brand-500 shadow-md">
                                    Ya, Booking Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
        const fieldsData = @json($fields);
        let calendar = null;

        document.addEventListener('alpine:init', () => {
            Alpine.data('reservationForm', () => ({
                type: 'regular',
                eventName: '',
                fieldId: '',
                date: '',
                selectedTime: '',
                duration: 1,
                bookedSlots: [],
                timeSlots: [],
                voucherCode: '',
                voucherData: null,
                voucherMessage: '',
                voucherMessageClass: '',
                showConfirmModal: false,
                
                init() {
                    this.generateTimeSlots();
                    
                    const params = new URLSearchParams(window.location.search);
                    if (params.has('field_id')) {
                        this.fieldId = params.get('field_id');
                    }
                    if (params.has('date')) {
                        this.date = params.get('date');
                    }
                    if (params.has('time')) {
                        this.selectedTime = params.get('time');
                    }
                    if (params.has('type')) {
                        this.type = params.get('type');
                    }
                    
                    let calendarEl = document.getElementById('calendar');
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next',
                            center: 'title',
                            right: 'today'
                        },
                        height: 'auto',
                        validRange: {
                            start: this.minDateAttr
                        },
                        dateClick: (info) => {
                            if (this.fieldId) {
                                let clickedDate = info.dateStr;
                                if (clickedDate >= this.minDateAttr) {
                                    this.date = clickedDate;
                                    this.fetchBookedSlots();
                                } else {
                                    alert(this.type === 'event' ? 'Pemesanan Acara/Turnamen wajib minimal H-3.' : 'Tanggal yang dipilih tidak valid.');
                                }
                            } else {
                                alert('Pilih lapangan terlebih dahulu.');
                            }
                        }
                    });
                    calendar.render();

                    if (this.fieldId) {
                        this.onFieldChange();
                    }

                    this.$watch('type', value => {
                        calendar.setOption('validRange', { start: this.minDateAttr });
                        if (this.date && this.date < this.minDateAttr) {
                            this.date = '';
                            this.selectedTime = '';
                        }
                    });
                },

                getSelectedFieldName() {
                    if(!this.fieldId) return '-';
                    let f = fieldsData.find(item => item.id == this.fieldId);
                    return f ? f.name : '-';
                },

                formatDate(dateStr) {
                    if(!dateStr) return '';
                    const d = new Date(dateStr);
                    return d.toLocaleDateString('id-ID', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
                },

                onFieldChange() {
                    if (this.fieldId) {
                        calendar.removeAllEventSources();
                        calendar.addEventSource({
                            url: '{{ route("api.available.slots") }}',
                            extraParams: { field_id: this.fieldId }
                        });
                        if (this.date) {
                            this.fetchBookedSlots();
                        }
                    }
                },
                
                async fetchBookedSlots() {
                    if (!this.fieldId || !this.date) return;
                    this.selectedTime = '';
                    this.bookedSlots = [];
                    
                    try {
                        let endDate = new Date(this.date);
                        endDate.setDate(endDate.getDate() + 1);
                        const response = await fetch(`{{ route("api.available.slots") }}?field_id=${this.fieldId}&start=${this.date}&end=${endDate.toISOString().split('T')[0]}`);
                        const events = await response.json();
                        
                        this.bookedSlots = events.map(ev => {
                            let startDate = new Date(ev.start);
                            let endDateObj = new Date(ev.end);
                            return {
                                reservation_date: ev.start.substring(0,10),
                                start_time: startDate.toTimeString().substring(0,8),
                                duration: (endDateObj - startDate) / (1000 * 60 * 60),
                                status: 'accepted'
                            };
                        });
                    } catch (e) {
                        console.error('Failed to fetch slots:', e);
                    }
                },
                
                get minDateAttr() {
                    let d = new Date();
                    d.setMinutes(d.getMinutes() - d.getTimezoneOffset()); 
                    if (this.type === 'event') {
                        d.setDate(d.getDate() + 3);
                    }
                    return d.toISOString().split('T')[0];
                },
                
                generateTimeSlots() {
                    this.timeSlots = [];
                    for(let i = 8; i <= 23; i++) {
                        let hour = i.toString().padStart(2, '0');
                        this.timeSlots.push(`${hour}:00:00`);
                    }
                },
                
                isBooked(timeToCheck) {
                    if(!this.date || !this.fieldId) return false;
                    
                    let todayObj = new Date();
                    todayObj.setMinutes(todayObj.getMinutes() - todayObj.getTimezoneOffset());
                    let todayStr = todayObj.toISOString().split('T')[0];
                    
                    if (this.date === todayStr) {
                        let currentH = new Date().getHours();
                        let timeToCheckH = parseInt(timeToCheck.substring(0,2));
                        if (timeToCheckH <= currentH) return true;
                    }
                    
                    for(let i=0; i < this.bookedSlots.length; i++) {
                        let slot = this.bookedSlots[i];
                        if(slot.reservation_date === this.date) {
                            let slotStartH = parseInt(slot.start_time.substring(0,2));
                            let timeToCheckH = parseInt(timeToCheck.substring(0,2));
                            if(timeToCheckH >= slotStartH && timeToCheckH < (slotStartH + slot.duration)) {
                                return true;
                            }
                        }
                    }
                    return false;
                },
                
                maxDuration() {
                    if (!this.selectedTime) return 12;
                    let selectedH = parseInt(this.selectedTime.substring(0, 2));
                    let maxAllowed = 12;
                    
                    for(let i=0; i < this.bookedSlots.length; i++) {
                        let slot = this.bookedSlots[i];
                        if(slot.reservation_date === this.date) {
                            let slotStartH = parseInt(slot.start_time.substring(0,2));
                            if (slotStartH > selectedH) {
                                let diff = slotStartH - selectedH;
                                if (diff > 0 && diff < maxAllowed) {
                                    maxAllowed = diff;
                                }
                            }
                        }
                    }
                    
                    let hoursUntilClose = 24 - selectedH;
                    if (hoursUntilClose < maxAllowed) {
                        maxAllowed = hoursUntilClose;
                    }
                    
                    if (this.duration > maxAllowed) {
                        this.duration = maxAllowed;
                    }

                    return maxAllowed;
                },
                
                async checkVoucher() {
                    if(!this.voucherCode) {
                        this.voucherData = null;
                        this.voucherMessage = '';
                        return;
                    }
                    this.voucherMessage = 'Mengecek voucher...';
                    this.voucherMessageClass = 'text-slate-500';
                    try {
                        const response = await fetch('{{ route("api.check.voucher") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ code: this.voucherCode })
                        });
                        const data = await response.json();
                        if(data.valid) {
                            this.voucherData = data;
                            this.voucherMessage = 'Promo berhasil diterapkan!';
                            this.voucherMessageClass = 'text-brand-600';
                        } else {
                            this.voucherData = null;
                            this.voucherMessage = 'Kode voucher tidak valid atau sudah kadaluarsa.';
                            this.voucherMessageClass = 'text-rose-600';
                        }
                    } catch(e) {
                        this.voucherMessage = 'Gagal mengecek kode voucher.';
                        this.voucherMessageClass = 'text-rose-600';
                    }
                },
                
                get basePrice() {
                    if (!this.fieldId) return 0;
                    let field = fieldsData.find(f => f.id == this.fieldId);
                    if (!field) return 0;
                    
                    if (!this.date || !this.selectedTime) return field.weekday_day_price;
                    
                    let d = new Date(this.date);
                    let dayOfWeek = d.getDay();
                    let isWeekend = (dayOfWeek === 0 || dayOfWeek === 6);
                    
                    let selectedH = parseInt(this.selectedTime.substring(0, 2));
                    let isNight = selectedH >= 18;
                    
                    if (isWeekend) return field.weekend_price;
                    return isNight ? field.weekday_night_price : field.weekday_day_price;
                },

                get totalTagihan() {
                    let total = this.duration * this.basePrice;
                    if(this.voucherData) {
                        if(this.voucherData.type === 'percent') {
                            total -= (total * this.voucherData.discount_amount) / 100;
                        } else {
                            total -= this.voucherData.discount_amount;
                        }
                    }
                    return Math.max(0, total);
                },
                
                get discountAmount() {
                    let total = this.duration * this.basePrice;
                    if(this.voucherData) {
                        if(this.voucherData.type === 'percent') {
                            return (total * this.voucherData.discount_amount) / 100;
                        } else {
                            return this.voucherData.discount_amount;
                        }
                    }
                    return 0;
                }
            }))
        })
    </script>
    <style>
        .fc .fc-toolbar-title { font-size: 1rem; font-weight: 800; color: #1e293b; }
        .fc .fc-button { padding: 0.25rem 0.5rem; font-size: 0.8rem; border-radius: 0.5rem !important; }
        .fc .fc-button-primary { background-color: #059669; border-color: #059669; }
        .fc .fc-button-primary:hover { background-color: #047857; border-color: #047857; }
        .fc-theme-standard td, .fc-theme-standard th { border-color: #f1f5f9; }
    </style>
    @endpush
</x-app-layout>
