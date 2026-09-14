<nav x-data="{ open: false }" class="glass-nav sticky top-0 z-50 transition-all duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="relative w-11 h-11 transition-transform duration-300 group-hover:scale-105">
                            <x-application-logo class="w-full h-full drop-shadow-md" />
                        </div>
                        <div class="flex flex-col">
                            <span class="font-black text-xl tracking-tight text-slate-900 group-hover:text-brand-600 transition-colors">
                                Maaafiqs
                            </span>
                            <span class="text-[10px] tracking-widest uppercase font-bold text-brand-600 -mt-1">
                                Mini Soccer Arena
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex md:items-center md:space-x-1 lg:space-x-2">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-3.5 py-2 rounded-full text-sm font-bold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-brand-500 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            <svg class="w-4 h-4 mr-1.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-full text-sm font-bold transition-all duration-200 {{ request()->routeIs('admin.reservations.*') ? 'bg-brand-500 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            <svg class="w-4 h-4 mr-1.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Reservasi
                        </a>
                        <a href="{{ route('admin.fields.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-full text-sm font-bold transition-all duration-200 {{ request()->routeIs('admin.fields.*') ? 'bg-brand-500 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Lapangan
                        </a>
                        <a href="{{ route('admin.vouchers.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-full text-sm font-bold transition-all duration-200 {{ request()->routeIs('admin.vouchers.*') ? 'bg-brand-500 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Promo
                        </a>
                        <a href="{{ route('admin.announcements.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-full text-sm font-bold transition-all duration-200 {{ request()->routeIs('admin.announcements.*') ? 'bg-brand-500 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Pengumuman
                        </a>
                        <a href="{{ route('admin.inventory.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-full text-sm font-bold transition-all duration-200 {{ request()->routeIs('admin.inventory.*') ? 'bg-brand-500 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Inventaris
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-brand-500 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            <svg class="w-4 h-4 mr-1.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('reservations.index') }}" class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold transition-all duration-200 {{ request()->routeIs('reservations.index') ? 'bg-brand-500 text-white shadow-sm' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            <svg class="w-4 h-4 mr-1.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Riwayat Booking
                        </a>
                        <div class="pl-2">
                            <a href="{{ route('reservations.create') }}" class="btn-shimmer inline-flex items-center px-5 py-2.5 rounded-full text-sm font-extrabold text-white bg-gradient-to-r from-brand-600 to-emerald-500 hover:from-brand-500 hover:to-emerald-400 shadow-glow-green transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                Booking Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Settings & Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-3">
                <!-- Notifications Dropdown -->
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="relative inline-flex items-center p-2.5 rounded-full text-slate-500 bg-white hover:text-brand-600 hover:bg-brand-50 focus:outline-none transition-all duration-200 border border-slate-200 shadow-sm">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center w-5 h-5 text-[10px] font-black text-white bg-rose-500 rounded-full ring-2 ring-white">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                            <span class="font-extrabold text-sm text-slate-800">Notifikasi</span>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="text-xs bg-brand-50 text-brand-700 px-2 py-0.5 rounded-full font-bold">{{ Auth::user()->unreadNotifications->count() }} baru</span>
                            @endif
                        </div>
                        <div class="max-h-72 overflow-y-auto divide-y divide-slate-100">
                            @forelse(Auth::user()->notifications as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}" class="block px-4 py-3 text-xs text-slate-700 hover:bg-slate-50 transition-colors {{ $notification->read_at ? 'opacity-75' : 'font-bold bg-brand-50/40' }}">
                                    <p class="leading-relaxed">{{ $notification->data['message'] }}</p>
                                    <div class="text-[11px] text-slate-400 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </a>
                                @php $notification->markAsRead(); @endphp
                            @empty
                                <div class="px-4 py-6 text-xs text-slate-400 text-center">Tidak ada notifikasi saat ini.</div>
                            @endforelse
                        </div>
                    </x-slot>
                </x-dropdown>

                <!-- Profile Menu -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-slate-200 text-sm font-bold rounded-full text-slate-700 bg-white hover:bg-slate-50 hover:border-brand-300 focus:outline-none transition-all duration-200 shadow-sm">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-brand-600 to-emerald-400 text-white font-black text-xs flex items-center justify-center mr-2 shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="max-w-[120px] truncate text-slate-800">{{ Auth::user()->name }}</span>
                            <span class="ml-2 px-2 py-0.5 text-[10px] font-black rounded-full uppercase tracking-wider {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-brand-100 text-brand-700' }}">
                                {{ Auth::user()->role }}
                            </span>
                            <svg class="ml-1.5 h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <p class="text-xs text-slate-400 font-medium">Masuk sebagai</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center font-medium hover:text-brand-600 hover:bg-brand-50">
                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <a href="{{ route('home') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition-colors">
                            <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Halaman Utama
                        </a>

                        <div class="border-t border-slate-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                {{ __('Keluar (Log Out)') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-600 hover:text-brand-600 hover:bg-brand-50 focus:outline-none transition duration-150 ease-in-out border border-slate-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white/95 backdrop-blur-xl border-t border-slate-200 shadow-xl transition-all duration-300">
        <div class="pt-3 pb-4 px-4 space-y-1.5">
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Dashboard Statistik') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')">
                    {{ __('Kelola Reservasi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.fields.index')" :active="request()->routeIs('admin.fields.*')">
                    {{ __('Manajemen Lapangan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.vouchers.index')" :active="request()->routeIs('admin.vouchers.*')">
                    {{ __('Kelola Promo') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.announcements.index')" :active="request()->routeIs('admin.announcements.*')">
                    {{ __('Kelola Pengumuman') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.inventory.index')" :active="request()->routeIs('admin.inventory.*')">
                    {{ __('Inventaris Barang') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                    {{ __('Riwayat Reservasi') }}
                </x-responsive-nav-link>
                <div class="pt-2">
                    <a href="{{ route('reservations.create') }}" class="w-full inline-flex justify-center items-center px-4 py-3 rounded-xl text-sm font-extrabold text-white bg-gradient-to-r from-brand-600 to-emerald-500 shadow-md">
                        + Booking Baru
                    </a>
                </div>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-slate-200 px-4 bg-slate-50/50">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-brand-600 to-emerald-400 text-white font-black text-sm flex items-center justify-center shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-extrabold text-base text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-slate-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('home')">
                    {{ __('Halaman Utama Publik') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-600 font-bold">
                        {{ __('Keluar (Log Out)') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

