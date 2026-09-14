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
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="text-slate-900 antialiased selection:bg-brand-500 selection:text-white bg-slate-50 min-h-screen">
        <div class="min-h-screen relative overflow-x-hidden flex flex-col">
            <!-- Subtle Athletic Background Glow -->
            <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-gradient-to-b from-brand-100/40 via-emerald-50/20 to-transparent pointer-events-none -z-10 blur-3xl"></div>
            
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-20 z-30 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="relative z-10 flex-1">
                {{ $slot }}
            </main>

            <!-- Global Footer Note -->
            <footer class="mt-auto py-6 border-t border-slate-200 bg-white text-center text-xs text-slate-400">
                <div class="max-w-7xl mx-auto px-4">
                    &copy; {{ date('Y') }} <strong>Maaafiqs Mini Soccer Arena</strong>. All rights reserved.
                </div>
            </footer>
        </div>

        <!-- Global Toast Notification -->
        @if (session('success') || session('status') === 'profile-updated' || session('status') === 'password-updated')
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 4500)"
                 x-transition:enter="transform ease-out duration-300 transition"
                 x-transition:enter-start="translate-y-10 opacity-0 sm:translate-y-0 sm:translate-x-10 scale-95"
                 x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="fixed bottom-6 right-6 sm:bottom-8 sm:right-8 z-50 flex items-center bg-white border-2 border-brand-500/30 rounded-2xl shadow-premium overflow-hidden max-w-sm">
                 <div class="p-4 bg-brand-50 h-full flex items-center text-brand-600">
                     <div class="w-9 h-9 rounded-xl bg-brand-500 text-white flex items-center justify-center shadow-glow-green">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                     </div>
                 </div>
                 <div class="px-4 py-4 pr-10">
                     <p class="text-sm font-black text-slate-900 mb-0.5">Berhasil!</p>
                     <p class="text-xs text-slate-600 leading-snug">
                        {{ session('success') ?? 'Operasi berhasil diproses.' }}
                     </p>
                 </div>
                 <button @click="show = false" class="absolute top-3 right-3 text-slate-400 hover:text-slate-600 transition-colors p-1">
                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                 </button>
            </div>
        @endif

        @stack('scripts')
    </body>
</html>

