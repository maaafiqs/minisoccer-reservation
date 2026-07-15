<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">



        <title>{{ config('app.name', 'Maaafiqs Mini Soccer') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass-header { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); transition: background-color 0.3s ease, border-color 0.3s ease; }
            html.dark .glass-header { background: rgba(17, 24, 39, 0.85); border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        </style>
    </head>
    <body class="text-gray-900 antialiased selection:bg-green-500 selection:text-white bg-[#f8fafc] transition-colors duration-300">
        <div class="min-h-screen relative overflow-x-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-green-50/50 to-transparent pointer-events-none -z-10"></div>
            
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="glass-header sticky top-0 z-30 shadow-[0_4px_30px_rgba(0,0,0,0.03)]">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="relative z-10 animate-[fadeIn_0.5s_ease-out]">
                {{ $slot }}
            </main>
        </div>
        <!-- Global Toast Notification -->
        @if (session('success') || session('status') === 'profile-updated' || session('status') === 'password-updated')
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 4000)"
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-y-10 opacity-0 sm:translate-y-0 sm:translate-x-10"
                 x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed bottom-5 right-5 sm:bottom-10 sm:right-10 z-50 flex items-center bg-white border-l-4 border-green-500 rounded-xl shadow-[0_10px_40px_rgba(34,197,94,0.15)] overflow-hidden max-w-sm">
                 <div class="p-4 bg-green-50 h-full flex items-center">
                     <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                 </div>
                 <div class="px-4 py-4 pr-10">
                     <p class="text-base font-bold text-gray-900 mb-0.5">Sukses!</p>
                     <p class="text-sm text-gray-600 leading-tight">
                        {{ session('success') ?? 'Data profil Anda berhasil diperbarui.' }}
                     </p>
                 </div>
                 <button @click="show = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition-colors">
                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                 </button>
            </div>
        @endif

        @stack('scripts')
    </body>
</html>
