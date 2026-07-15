<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Maaafiqs Mini Soccer</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased text-gray-900 h-screen flex overflow-hidden bg-gray-50 transition-colors duration-300">
    
    <!-- Right: Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 overflow-y-auto">
        <div class="max-w-md w-full my-auto py-8">
            <div class="text-center mb-8">
                <a href="/" class="text-3xl font-bold text-green-600 inline-block mb-4">⚽ Maaafiqs Mini Soccer</a>
                <h2 class="text-3xl font-extrabold text-gray-900">Buat Akun Baru</h2>
                <p class="mt-2 text-sm text-gray-600">Daftar sekarang untuk mulai memesan jadwal main.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <div class="mt-1">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="appearance-none block w-full px-4 py-3 bg-white border border-gray-300 text-gray-900 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm transition">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <div class="mt-1">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="appearance-none block w-full px-4 py-3 bg-white border border-gray-300 text-gray-900 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm transition">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required autocomplete="new-password" class="appearance-none block w-full px-4 py-3 bg-white border border-gray-300 text-gray-900 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm transition">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                    <div class="mt-1">
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="appearance-none block w-full px-4 py-3 bg-white border border-gray-300 text-gray-900 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm transition">
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition transform hover:-translate-y-0.5">
                        Daftar Akun
                    </button>
                </div>
                
                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-600">Sudah memiliki akun? <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-500 transition">Masuk di sini</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Right: Image (for register we put image on right) -->
    <div class="hidden lg:flex w-1/2 bg-green-600 relative">
        <img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?q=80&w=2070&auto=format&fit=crop" alt="Mini soccer" class="absolute w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 bg-gradient-to-t from-green-600/90 to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-end p-12 text-white h-full">
            <h1 class="text-5xl font-extrabold mb-4">Mudah & Cepat!</h1>
            <p class="text-xl text-gray-200">Dapatkan akses instan ke sistem reservasi kami. Pilih jadwal terbaik untuk tim kesayanganmu.</p>
        </div>
    </div>
</body>
</html>
