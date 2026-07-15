<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Maaafiqs Mini Soccer</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 h-screen flex overflow-hidden transition-colors duration-300">
    <!-- Left: Image -->
    <div class="hidden lg:flex w-1/2 bg-green-600 relative">
        <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=1935&auto=format&fit=crop" alt="Mini soccer" class="absolute w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 bg-gradient-to-t from-green-600/90 to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-end p-12 text-white h-full">
            <h1 class="text-5xl font-extrabold mb-4">Maaafiqs Mini Soccer</h1>
            <p class="text-xl text-gray-200">Bergabunglah dengan ratusan pemain lainnya dan rasakan sensasi bermain di lapangan berkualitas premium.</p>
        </div>
    </div>

    <!-- Right: Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 p-8">
        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <a href="/" class="text-3xl font-bold text-green-600 inline-block mb-4 lg:hidden">⚽ Maaafiqs Mini Soccer</a>
                <h2 class="text-3xl font-extrabold text-gray-900">Selamat Datang Kembali!</h2>
                <p class="mt-2 text-sm text-gray-600">Silakan masuk ke akun Anda untuk melakukan reservasi.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6 bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                    <div class="mt-1 relative">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="appearance-none block w-full px-4 py-3 bg-white border border-gray-300 text-gray-900 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <div class="mt-1 relative">
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="appearance-none block w-full px-4 py-3 bg-white border border-gray-300 text-gray-900 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat Saya</label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-green-600 hover:text-green-500 transition">Lupa sandi?</a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition transform hover:-translate-y-0.5">
                        Masuk Sekarang
                    </button>
                </div>
                
                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-500 transition">Daftar di sini</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
