<nav x-data="{ open: false }" class="glass-header sticky top-0 z-50 transition-all duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                        <x-application-logo class="block h-10 w-auto fill-current text-green-600 group-hover:scale-110 transition-transform duration-300" />
                        <span class="font-extrabold text-xl tracking-tight text-gray-900 group-hover:text-green-600 transition-colors">Maaafiqs Mini Soccer</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-12 sm:flex">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition duration-150 ease-in-out {{ request()->routeIs('admin.reservations.*') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Kelola Reservasi
                        </a>
                        <a href="{{ route('admin.vouchers.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition duration-150 ease-in-out {{ request()->routeIs('admin.vouchers.*') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Kelola Promo
                        </a>
                        <a href="{{ route('admin.announcements.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition duration-150 ease-in-out {{ request()->routeIs('admin.announcements.*') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Kelola Pengumuman
                        </a>
                        <a href="{{ route('admin.fields.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition duration-150 ease-in-out {{ request()->routeIs('admin.fields.*') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Manajemen Lapangan
                        </a>
                        <a href="{{ route('admin.inventory.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition duration-150 ease-in-out {{ request()->routeIs('admin.inventory.*') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Inventaris Barang
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('reservations.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold leading-5 transition duration-150 ease-in-out {{ request()->routeIs('reservations.index') ? 'border-green-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Riwayat Reservasi
                        </a>
                        <div class="flex items-center ml-4">
                            <a href="{{ route('reservations.create') }}" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-bold rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200">
                                Booking Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- Notifications Dropdown -->
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="relative inline-flex items-center p-2 border border-transparent text-sm leading-4 font-bold rounded-full text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 mr-4 shadow-sm ring-1 ring-gray-900/5">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">{{ Auth::user()->unreadNotifications->count() }}</span>
                            @endif
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="px-4 py-2 border-b font-bold text-gray-700">Notifikasi</div>
                        <div class="max-h-64 overflow-y-auto">
                            @forelse(Auth::user()->notifications as $notification)
                                <a href="{{ $notification->data['url'] ?? '#' }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 {{ $notification->read_at ? 'opacity-75' : 'font-bold bg-green-50' }}">
                                    {{ $notification->data['message'] }}
                                    <div class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                                </a>
                                @php $notification->markAsRead(); @endphp
                            @empty
                                <div class="px-4 py-3 text-sm text-gray-500 text-center">Belum ada notifikasi.</div>
                            @endforelse
                        </div>
                    </x-slot>
                </x-dropdown>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm leading-4 font-bold rounded-full text-gray-700 bg-white/50 hover:bg-gray-50 hover:text-green-600 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center text-green-700 mr-2 border border-green-200">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="font-medium hover:text-green-600 hover:bg-green-50">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="font-medium text-red-600 hover:bg-red-50 hover:text-red-700">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 backdrop-blur-md border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')">
                    {{ __('Kelola Reservasi') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.inventory.index')" :active="request()->routeIs('admin.inventory.*')">
                    {{ __('Inventaris Barang') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.fields.index')" :active="request()->routeIs('admin.fields.*')">
                    {{ __('Manajemen Lapangan') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                    {{ __('Riwayat Reservasi') }}
                </x-responsive-nav-link>
                <div class="px-4 py-2">
                    <a href="{{ route('reservations.create') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-bold rounded-md text-white bg-green-600 hover:bg-green-700">
                        Booking Baru
                    </a>
                </div>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-red-600">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
