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
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased selection:bg-green-500 selection:text-white bg-gray-50 flex flex-col md:flex-row min-h-screen transition-colors duration-300">
        <div class="min-h-screen flex">
            <!-- Left Side (Image) -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-green-600 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1518605368461-1e12a6fdb324?q=80&w=2070&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Stadium" />
                <div class="absolute inset-0 bg-gradient-to-t from-green-600/90 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-12 text-white z-10 w-full">
                    <h2 class="text-5xl font-extrabold mb-4 drop-shadow-lg">Maaafiqs Mini Soccer</h2>
                    <p class="text-xl text-green-100 font-light max-w-lg">Bergabunglah dengan ribuan pemain lainnya. Temukan lapangan terbaik untuk pertandingan tak terlupakan bersama tim Anda.</p>
                </div>
            </div>

            <!-- Right Side (Form) -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 relative">
                <div class="absolute top-8 left-8 lg:hidden">
                    <a href="/" class="flex items-center text-green-600 font-bold text-xl">
                        <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Maaafiqs Mini Soccer
                    </a>
                </div>
                
                <div class="w-full max-w-md bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 p-10 transform transition-all hover:-translate-y-1 hover:shadow-[0_8px_40px_rgb(34,197,94,0.12)]">
                    <div class="mb-8 text-center">
                        <a href="/">
                            <x-application-logo class="w-20 h-20 mx-auto fill-current text-green-600" />
                        </a>
                    </div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
