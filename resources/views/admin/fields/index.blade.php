<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Lapangan') }}
            </h2>
            <a href="{{ route('admin.fields.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Tambah Lapangan</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Lapangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Siang</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Malam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Weekend</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($fields as $field)
                            <tr>
                                <td class="px-6 py-4 font-bold">{{ $field->name }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($field->weekday_day_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($field->weekday_night_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($field->weekend_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    @if($field->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex space-x-3">
                                    <a href="{{ route('admin.fields.edit', $field) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.fields.destroy', $field) }}" method="POST" onsubmit="return confirm('Hapus lapangan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if($fields->isEmpty())
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data lapangan.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
