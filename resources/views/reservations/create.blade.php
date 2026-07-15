<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Booking Jadwal Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen" x-data="reservationForm()">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-3xl border border-gray-100">
                <div class="p-8 sm:p-12 text-gray-900">
                    
                    @if($errors->any())
                        <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Mohon perbaiki kesalahan berikut:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-col lg:flex-row gap-10">
                        
                        <!-- Calendar View Section -->
                        <div class="w-full lg:w-5/12 order-2 lg:order-1 bg-gray-50 p-6 rounded-3xl border border-gray-200 shadow-inner">
                            <div class="mb-4">
                                <h3 class="text-xl font-extrabold text-gray-800">Kalender Ketersediaan</h3>
                                <p class="text-sm text-gray-500">Pilih lapangan untuk melihat jadwal yang sudah terisi. (Klik tanggal pada kalender untuk memilih tanggal main).</p>
                            </div>
                            <!-- FullCalendar Container -->
                            <div id="calendar" class="bg-white p-3 rounded-2xl shadow-sm border border-gray-100 min-h-[400px]"></div>
                        </div>

                        <!-- Form Section -->
                        <div class="w-full lg:w-7/12 order-1 lg:order-2">
                            <form x-ref="bookingForm" action="{{ route('reservations.store') }}" method="POST" class="space-y-8" @submit.prevent="showConfirmModal = true">
                                @csrf
                                
                                <!-- 1. Pilihan Jenis Reservasi -->
                                <div class="relative">
                                    <div class="flex items-center space-x-3 mb-4">
                                        <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center font-bold">1</div>
                                        <label class="text-lg font-bold text-gray-800">Pilih Jenis Reservasi</label>
                                    </div>
                                    <div class="flex flex-wrap gap-4">
                                        <label class="cursor-pointer relative flex-1">
                                            <input type="radio" name="type" value="regular" x-model="type" class="peer sr-only">
                                            <div class="rounded-2xl border-2 py-3 px-4 text-center font-bold transition-all duration-200 shadow-sm
                                                bg-white text-gray-700 border-gray-200 hover:border-green-300 peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-500 peer-checked:shadow-[0_4px_15px_rgba(34,197,94,0.3)] peer-checked:-translate-y-0.5">
                                                Reguler
                                            </div>
                                        </label>
                                        <label class="cursor-pointer relative flex-1">
                                            <input type="radio" name="type" value="event" x-model="type" class="peer sr-only">
                                            <div class="rounded-2xl border-2 py-3 px-4 text-center font-bold transition-all duration-200 shadow-sm
                                                bg-white text-gray-700 border-gray-200 hover:border-green-300 peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-500 peer-checked:shadow-[0_4px_15px_rgba(34,197,94,0.3)] peer-checked:-translate-y-0.5">
                                                Acara / Event
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Nama Acara -->
                                <div x-show="type === 'event'" x-transition class="mt-6" style="display: none;">
                                    <label for="event_name" class="block text-base font-bold text-gray-800 mb-2">Nama Acara / Turnamen <span class="text-red-500">*</span></label>
                                    <input type="text" name="event_name" id="event_name" x-model="eventName" class="block w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 shadow-sm transition-colors text-base py-3 px-4" placeholder="Misal: Turnamen Antar RW" :required="type === 'event'">
                                </div>

                                <!-- 2. Pilih Lapangan -->
                                <div class="relative mt-8 pt-8 border-t border-gray-100">
                                    <div class="flex items-center space-x-3 mb-4">
                                        <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center font-bold">2</div>
                                        <label class="text-lg font-bold text-gray-800">Pilih Lapangan</label>
                                    </div>
                                    @if($fields->isEmpty())
                                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-xl p-4 text-center">
                                            <svg class="w-6 h-6 mx-auto mb-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            <p class="font-bold">Mohon Maaf!</p>
                                            <p class="text-sm">Saat ini belum ada data lapangan yang tersedia untuk disewa. Silakan hubungi admin.</p>
                                        </div>
                                    @else
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @foreach($fields as $field)
                                            <label class="cursor-pointer relative">
                                                <input type="radio" name="field_id" value="{{ $field->id }}" x-model="fieldId" @change="onFieldChange" class="peer sr-only" required>
                                                <div class="rounded-2xl border-2 p-4 text-left font-bold transition-all duration-200 shadow-sm
                                                    bg-white text-gray-700 border-gray-200 hover:border-green-300 peer-checked:border-green-500 peer-checked:ring-2 peer-checked:ring-green-200 peer-checked:bg-green-50">
                                                    <div class="text-lg text-gray-900">{{ $field->name }}</div>
                                                    <div class="text-sm font-normal mt-1 text-gray-500">Siang: Rp {{ number_format($field->weekday_day_price, 0, ',', '.') }}/jam</div>
                                                    <div class="text-sm font-normal text-gray-500">Malam: Rp {{ number_format($field->weekday_night_price, 0, ',', '.') }}/jam</div>
                                                    <div class="text-sm font-normal text-gray-500">Wknd: Rp {{ number_format($field->weekend_price, 0, ',', '.') }}/jam</div>
                                                </div>
                                            </label>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- 3. Pilihan Tanggal -->
                                <div class="relative mt-8 pt-8 border-t border-gray-100" x-show="fieldId" x-transition>
                                    <div class="flex items-center space-x-3 mb-4">
                                        <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center font-bold">3</div>
                                        <label for="reservation_date" class="text-lg font-bold text-gray-800">Pilih Tanggal Main</label>
                                    </div>
                                    <input type="date" name="reservation_date" id="reservation_date" 
                                        x-model="date" 
                                        @change="fetchBookedSlots"
                                        :min="minDateAttr"
                                        class="mt-1 block w-full sm:w-1/2 rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 shadow-sm transition-colors text-lg py-3 px-4" required>
                                </div>

                                <!-- 4. Pilihan Jam (Muncul Setelah Pilih Tanggal) -->
                                <div x-show="date && fieldId" x-transition style="display: none;">
                                    <div class="flex items-center space-x-3 mb-4 mt-8 pt-8 border-t border-gray-100">
                                        <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center font-bold">4</div>
                                        <label class="text-lg font-bold text-gray-800">Pilih Jam Mulai <span class="text-sm font-normal text-gray-500 ml-2">(08:00 - 24:00 WIB)</span></label>
                                    </div>
                                    
                                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-2 sm:gap-3">
                                        <template x-for="time in timeSlots" :key="time">
                                            <label class="cursor-pointer relative group">
                                                <input type="radio" name="start_time" :value="time" x-model="selectedTime" class="peer sr-only" :disabled="isBooked(time)">
                                                <div class="rounded-xl border-2 py-2 px-1 text-center text-sm sm:text-base font-bold transition-all duration-200 shadow-sm"
                                                     :class="{
                                                        'bg-gray-100 text-gray-400 border-transparent cursor-not-allowed line-through opacity-70': isBooked(time),
                                                        'bg-white text-gray-700 border-gray-200 hover:border-green-300 hover:shadow-md peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-500 peer-checked:shadow-[0_4px_15px_rgba(34,197,94,0.3)] peer-checked:-translate-y-0.5': !isBooked(time)
                                                     }">
                                                    <span x-text="time.substring(0,5)"></span>
                                                </div>
                                            </label>
                                        </template>
                                    </div>
                                </div>

                                <!-- 5. Pilihan Durasi & Voucher (Muncul Setelah Pilih Jam) -->
                                <div x-show="selectedTime" x-transition style="display: none;">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8 pt-8 border-t border-gray-100">
                                        
                                        <div>
                                            <div class="flex items-center space-x-3 mb-4">
                                                <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center font-bold">5</div>
                                                <label class="text-lg font-bold text-gray-800">Durasi Bermain</label>
                                            </div>
                                            <div class="flex flex-wrap gap-2">
                                                <template x-for="i in maxDuration()" :key="i">
                                                    <label class="cursor-pointer relative">
                                                        <input type="radio" name="duration" :value="i" x-model.number="duration" class="peer sr-only">
                                                        <div class="rounded-xl border-2 py-2 px-4 text-center text-sm font-bold transition-all duration-200"
                                                             :class="{
                                                                'bg-white text-gray-700 border-gray-200 hover:border-green-300 peer-checked:bg-green-100 peer-checked:text-green-700 peer-checked:border-green-500': true
                                                             }">
                                                            <span x-text="i + ' Jam'"></span>
                                                        </div>
                                                    </label>
                                                </template>
                                            </div>
                                            <p class="text-xs font-medium text-amber-600 mt-3 bg-amber-50 p-2 rounded-lg inline-block border border-amber-200" x-show="maxDuration() < 12">
                                                <svg class="w-3 h-3 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                Durasi dibatasi jadwal lain.
                                            </p>
                                        </div>

                                        <div>
                                            <div class="flex items-center space-x-3 mb-4">
                                                <div class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center font-bold">6</div>
                                                <label for="voucher_code" class="text-lg font-bold text-gray-800">Kode Promo <span class="text-sm font-normal text-gray-500 ml-1">(Opsional)</span></label>
                                            </div>
                                            <div class="flex gap-2">
                                                <input type="text" name="voucher_code" id="voucher_code" x-model="voucherCode" placeholder="Kode diskon" class="block w-full rounded-2xl border-gray-200 focus:border-green-500 focus:ring-green-500 shadow-sm transition-colors text-base py-2 px-3 uppercase">
                                                <button type="button" @click="checkVoucher" class="bg-gray-800 text-white px-4 rounded-2xl font-bold hover:bg-gray-700 whitespace-nowrap transition-colors">Cek</button>
                                            </div>
                                            <p class="text-sm mt-2 font-medium" :class="voucherMessageClass" x-show="voucherMessage" x-text="voucherMessage"></p>
                                        </div>
                                        
                                    </div>

                                    <!-- Summary Box -->
                                    <div class="mt-8 bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-3xl border border-green-200">
                                        <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                                            <div class="w-full sm:w-1/2">
                                                <h4 class="font-bold text-green-800 text-lg mb-2 border-b border-green-200 pb-2">Rincian Tagihan</h4>
                                                <div class="flex justify-between text-green-700 mb-1 text-sm">
                                                    <span x-text="'Tarif Dasar (Rp ' + basePrice.toLocaleString('id-ID') + ' x ' + duration + ' Jam)'"></span>
                                                    <span x-text="'Rp ' + (duration * basePrice).toLocaleString('id-ID')"></span>
                                                </div>
                                                <div x-show="voucherData" class="flex justify-between text-green-600 font-bold mb-1 text-sm" style="display: none;">
                                                    <span>Diskon Promo</span>
                                                    <span x-text="'- Rp ' + discountAmount.toLocaleString('id-ID')"></span>
                                                </div>
                                                <div class="flex justify-between text-green-900 font-extrabold text-xl mt-3 pt-2 border-t border-green-200">
                                                    <span>Total Bayar</span>
                                                    <span x-text="'Rp ' + totalTagihan.toLocaleString('id-ID')"></span>
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-auto">
                                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-full shadow-[0_4px_15px_rgba(34,197,94,0.3)] transition-all duration-300 transform hover:-translate-y-1">
                                                    Konfirmasi
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Custom Confirm Modal -->
                    <div x-show="showConfirmModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="showConfirmModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showConfirmModal = false">
                                <div class="absolute inset-0 bg-gray-900 opacity-75 backdrop-blur-sm"></div>
                            </div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                            <div x-show="showConfirmModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-6 pt-6 pb-6">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-16 w-16 rounded-full bg-green-100 sm:mx-0 sm:h-12 sm:w-12 border border-green-200">
                                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="mt-4 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-xl leading-6 font-extrabold text-gray-900">
                                                Konfirmasi Pesanan
                                            </h3>
                                            <div class="mt-3">
                                                <p class="text-gray-600">
                                                    Apakah anda ingin melanjutkan pesanan ini? Pastikan data <strong>lapangan, tanggal, jam, dan durasi</strong> sudah benar.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse border-t border-gray-100">
                                    <button type="button" @click="$refs.bookingForm.submit()" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-md px-6 py-3 bg-green-600 text-base font-bold text-white hover:bg-green-700 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200 hover:-translate-y-0.5">
                                        Ya, Lanjutkan
                                    </button>
                                    <button type="button" @click="showConfirmModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-3 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200">
                                        Cek Lagi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
                    
                    // Parse URL parameters for quick booking from home
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
                    
                    // Initialize Calendar
                    let calendarEl = document.getElementById('calendar');
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        themeSystem: 'standard',
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
                                    if (this.type === 'event') {
                                        alert('Khusus Acara/Turnamen, lapangan harus dipesan minimal H-3 sebelum bermain.');
                                    } else {
                                        alert('Tanggal yang dipilih tidak valid atau sudah lewat.');
                                    }
                                }
                            } else {
                                alert('Pilih lapangan terlebih dahulu.');
                            }
                        }
                    });
                    calendar.render();

                    // If field_id was present in URL, fetch its data initially
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

                onFieldChange() {
                    if (this.fieldId) {
                        // Refetch calendar events
                        calendar.removeAllEventSources();
                        calendar.addEventSource({
                            url: '{{ route("api.available.slots") }}',
                            extraParams: {
                                field_id: this.fieldId
                            }
                        });
                        
                        if (this.date) {
                            this.fetchBookedSlots();
                        }
                    }
                },
                
                async fetchBookedSlots() {
                    if (!this.fieldId || !this.date) return;
                    
                    this.selectedTime = ''; // reset time
                    this.bookedSlots = [];
                    
                    try {
                        let endDate = new Date(this.date);
                        endDate.setDate(endDate.getDate() + 1); // Get next day for range
                        
                        const response = await fetch(`{{ route("api.available.slots") }}?field_id=${this.fieldId}&start=${this.date}&end=${endDate.toISOString().split('T')[0]}`);
                        const events = await response.json();
                        
                        // Parse events into bookedSlots array
                        this.bookedSlots = events.map(ev => {
                            let startDate = new Date(ev.start);
                            let endDateObj = new Date(ev.end);
                            let start_time = startDate.toTimeString().substring(0,8);
                            let duration = (endDateObj - startDate) / (1000 * 60 * 60);
                            return {
                                reservation_date: ev.start.substring(0,10),
                                start_time: start_time,
                                duration: duration,
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
                    
                    // Check if date is today and time is in the past
                    let todayObj = new Date();
                    todayObj.setMinutes(todayObj.getMinutes() - todayObj.getTimezoneOffset());
                    let todayStr = todayObj.toISOString().split('T')[0];
                    
                    if (this.date === todayStr) {
                        let currentH = new Date().getHours();
                        let timeToCheckH = parseInt(timeToCheck.substring(0,2));
                        if (timeToCheckH <= currentH) {
                            return true;
                        }
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
                    this.voucherMessageClass = 'text-gray-500';
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
                            this.voucherMessageClass = 'text-green-600';
                        } else {
                            this.voucherData = null;
                            this.voucherMessage = 'Kode tidak valid / tidak aktif.';
                            this.voucherMessageClass = 'text-red-600';
                        }
                    } catch(e) {
                        console.error(e);
                        this.voucherMessage = 'Gagal mengecek kode voucher.';
                        this.voucherMessageClass = 'text-red-600';
                    }
                },
                
                get basePrice() {
                    if (!this.fieldId) return 0;
                    let field = fieldsData.find(f => f.id == this.fieldId);
                    if (!field) return 0;
                    
                    // Logic to determine price based on date and time
                    if (!this.date || !this.selectedTime) return field.weekday_day_price; // default
                    
                    let d = new Date(this.date);
                    let dayOfWeek = d.getDay(); // 0 is Sunday, 6 is Saturday
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
        /* Small fixes for FullCalendar UI in this layout */
        .fc .fc-toolbar-title { font-size: 1.1rem; font-weight: bold; }
        .fc .fc-button { padding: 0.2rem 0.5rem; font-size: 0.9rem; }
    </style>
    @endpush
</x-app-layout>
