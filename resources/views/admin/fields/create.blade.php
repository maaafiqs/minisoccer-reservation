<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Lapangan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.fields.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <x-input-label for="name" value="Nama Lapangan" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi (Opsional)" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="weekday_day_price" value="Harga Siang (Senin-Jumat)" />
                                <x-text-input id="weekday_day_price" name="weekday_day_price" type="number" class="mt-1 block w-full" :value="old('weekday_day_price')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('weekday_day_price')" />
                            </div>
                            <div>
                                <x-input-label for="weekday_night_price" value="Harga Malam (Senin-Jumat)" />
                                <x-text-input id="weekday_night_price" name="weekday_night_price" type="number" class="mt-1 block w-full" :value="old('weekday_night_price')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('weekday_night_price')" />
                            </div>
                            <div>
                                <x-input-label for="weekend_price" value="Harga Weekend (Sabtu-Minggu)" />
                                <x-text-input id="weekend_price" name="weekend_price" type="number" class="mt-1 block w-full" :value="old('weekend_price')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('weekend_price')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="image" value="Gambar Lapangan (Opsional)" />
                            <input id="image" name="image" type="file" class="mt-1 block w-full" accept="image/*" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div class="block mt-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Lapangan Aktif</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-4">
                            <a href="{{ route('admin.fields.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
