<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Pengaturan Profil') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-3xl border border-gray-100 transition-all hover:shadow-[0_8px_40px_rgb(34,197,94,0.12)]">
                <div class="bg-gradient-to-r from-green-500 to-green-600 h-24 sm:h-32"></div>
                <div class="px-4 sm:px-10 pb-10">
                    <div class="relative flex justify-between items-end -mt-12 sm:-mt-16 mb-8">
                        <div class="h-24 w-24 sm:h-32 sm:w-32 rounded-full bg-white p-2 shadow-lg">
                            <div class="h-full w-full rounded-full bg-green-100 flex items-center justify-center text-green-700 text-4xl sm:text-5xl font-bold border-2 border-green-200">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-3xl border border-gray-100 p-6 sm:p-10 transition-all hover:shadow-[0_8px_40px_rgb(34,197,94,0.12)]">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-3xl border border-red-100 p-6 sm:p-10 transition-all hover:shadow-[0_8px_40px_rgb(239,68,68,0.12)] relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-red-600"></div>
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
