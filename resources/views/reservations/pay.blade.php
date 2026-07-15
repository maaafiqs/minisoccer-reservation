<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center">
            <svg class="w-7 h-7 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            {{ __('Pembayaran Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl transform transition-all duration-300 hover:shadow-2xl">
                <div class="p-8">
                    
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-extrabold text-gray-900 mb-2">Selesaikan Pembayaran Anda</h3>
                        <p class="text-gray-500">Nomor Reservasi: <span class="font-bold text-gray-800">{{ $reservation->reservation_number }}</span></p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-100 shadow-inner">
                        <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-4">
                            <span class="text-gray-600">Total Tagihan</span>
                            <span class="text-3xl font-bold text-green-600">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-4">
                            <span class="text-gray-600">Batas Waktu Pembayaran</span>
                            <div class="text-right">
                                <span class="text-lg font-bold text-red-600 block">{{ \Carbon\Carbon::parse($reservation->created_at)->addHours(24)->format('d M Y, H:i') }} WIB</span>
                                <span class="text-sm font-mono font-bold bg-red-100 text-red-800 px-2 py-1 rounded"
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
                                                this.timeLeft = h + ':' + m + ':' + s;
                                            }, 1000);
                                        }
                                     }" x-text="timeLeft"></span>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <h4 class="font-semibold text-gray-700">Transfer ke Rekening Berikut:</h4>
                            
                            <div class="flex items-center p-4 bg-white border border-blue-100 rounded-lg shadow-sm">
                                <div class="bg-blue-100 text-blue-800 font-bold p-3 rounded-lg mr-4">BCA</div>
                                <div>
                                    <p class="font-mono text-xl tracking-wider text-gray-800">1234 5678 90</p>
                                    <p class="text-sm text-gray-500">a.n. Maaafiqs Mini Soccer</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-white border border-orange-100 rounded-lg shadow-sm">
                                <div class="bg-orange-100 text-orange-800 font-bold p-3 rounded-lg mr-4">BNI</div>
                                <div>
                                    <p class="font-mono text-xl tracking-wider text-gray-800">0987 6543 21</p>
                                    <p class="text-sm text-gray-500">a.n. Maaafiqs Mini Soccer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md animate-pulse">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('reservations.pay', $reservation) }}" method="POST" enctype="multipart/form-data" x-data="{ fileName: '', filePreview: '' }">
                        @csrf
                        
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Transfer</label>
                            
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-green-500 transition-colors duration-300 relative bg-gray-50">
                                <div class="space-y-1 text-center" x-show="!filePreview">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="payment_proof" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none px-2 py-1 shadow-sm border border-gray-200">
                                            <span>Pilih File Gambar</span>
                                            <input id="payment_proof" name="payment_proof" type="file" class="sr-only" accept="image/*" 
                                                @change="fileName = $refs.file.files[0].name; const reader = new FileReader(); reader.onload = (e) => filePreview = e.target.result; reader.readAsDataURL($refs.file.files[0])" x-ref="file" required>
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">PNG, JPG, JPEG hingga 2MB</p>
                                </div>
                                
                                <div x-show="filePreview" class="text-center w-full" style="display: none;">
                                    <img :src="filePreview" class="mx-auto h-48 object-contain rounded mb-3 shadow-sm border border-gray-200">
                                    <p class="text-sm font-medium text-gray-700 mb-2" x-text="fileName"></p>
                                    <button type="button" @click="filePreview = ''; fileName = ''; $refs.file.value = ''" class="text-sm text-red-500 hover:text-red-700 font-medium">Ganti Gambar</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('reservations.index') }}" class="px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-all duration-300">
                                Nanti Saja
                            </a>
                            <button type="submit" class="px-8 py-3 border border-transparent shadow-lg text-base font-medium rounded-full text-white bg-green-600 hover:bg-green-700 focus:outline-none transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
