<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Dashboard Pemain') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen transition-colors duration-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(isset($announcements) && $announcements->count() > 0)
                <div class="mb-6 space-y-4">
                    @foreach($announcements as $announcement)
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-xl shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-md font-extrabold text-blue-900">{{ $announcement->title }}</h3>
                                    <div class="mt-1 text-sm text-blue-800 font-medium">
                                        <p>{{ $announcement->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Welcome Banner -->
            <div class="relative bg-green-600 rounded-3xl shadow-2xl overflow-hidden mb-10 transform transition-all duration-500 hover:shadow-[0_20px_50px_rgba(34,197,94,0.3)]">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1556816214-cb30b4278453?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-30" alt="Stadium" />
                    <div class="absolute inset-0 bg-gradient-to-r from-green-600 via-green-500/80 to-transparent"></div>
                </div>
                <div class="relative px-8 py-12 md:p-16 flex flex-col md:flex-row items-center justify-between z-10">
                    <div>
                        <span class="inline-block py-1 px-3 rounded-full bg-green-500/20 text-green-400 font-bold text-xs uppercase tracking-widest mb-3 border border-green-500/30">Member Area</span>
                        <h3 class="text-4xl md:text-5xl font-extrabold text-white mb-2 tracking-tight">Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-300">{{ explode(' ', Auth::user()->name)[0] }}!</span> ⚽</h3>
                        <p class="text-gray-300 text-lg max-w-xl">Pantau riwayat permainanmu dan segera pesan lapangan untuk pertandingan berikutnya bersama tim terbaikmu.</p>
                    </div>
                    <div class="mt-8 md:mt-0">
                        <a href="{{ route('reservations.create') }}" class="group relative inline-flex items-center justify-center px-8 py-4 font-bold text-green-700 transition-all duration-200 bg-white font-pj rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 hover:bg-gray-100 hover:scale-105 hover:shadow-[0_0_20px_rgba(255,255,255,0.4)]">
                            <svg class="w-6 h-6 mr-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Buat Reservasi Baru
                        </a>
                    </div>
                </div>
            </div>
            
            <h4 class="text-xl font-bold text-gray-900 mb-4 px-2">Statistik Permainan</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                
                <!-- Card 1 -->
                <div class="group bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 relative">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-emerald-600 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-green-50 rounded-2xl p-4 text-green-600 ring-1 ring-green-100 group-hover:bg-green-500 group-hover:text-white transition-colors duration-300">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Total Pertandingan</span>
                        </div>
                        <div class="mt-4 flex items-baseline text-6xl font-extrabold text-gray-900">
                            {{ $totalReservations }}
                            <span class="ml-2 text-xl font-medium text-gray-500">kali main</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-8 py-5 border-t border-gray-100">
                        <a href="{{ route('reservations.index') }}" class="text-sm font-bold text-green-600 hover:text-green-800 flex items-center justify-between transition-colors">
                            <span>Lihat riwayat lengkap</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 relative">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-400 to-orange-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-amber-50 rounded-2xl p-4 text-amber-500 ring-1 ring-amber-100 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Tagihan / Pending</span>
                        </div>
                        <div class="mt-4 flex items-baseline text-6xl font-extrabold {{ $pendingReservations > 0 ? 'text-amber-500' : 'text-gray-900' }}">
                            {{ $pendingReservations }}
                            <span class="ml-2 text-xl font-medium text-gray-500">menunggu konfirmasi</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-8 py-5 border-t border-gray-100">
                        @if($pendingReservations > 0)
                        <a href="{{ route('reservations.index') }}" class="text-sm font-bold text-amber-600 hover:text-amber-800 flex items-center justify-between transition-colors">
                            <span class="flex items-center"><span class="relative flex h-3 w-3 mr-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span></span> Selesaikan Pembayaran</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        @else
                        <span class="text-sm font-bold text-gray-400 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Semua lunas & terkonfirmasi
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 relative">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-600 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-blue-50 rounded-2xl p-4 text-blue-600 ring-1 ring-blue-100 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Diterima</span>
                        </div>
                        <div class="mt-4 flex items-baseline text-6xl font-extrabold text-blue-600">
                            {{ $acceptedReservations }}
                            <span class="ml-2 text-xl font-medium text-gray-500">siap dimainkan</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-8 py-5 border-t border-gray-100">
                        <a href="{{ route('reservations.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center justify-between transition-colors">
                            <span>Lihat jadwal main</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
</x-app-layout>
