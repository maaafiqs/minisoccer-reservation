<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Promo (Voucher)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Voucher Baru</h3>
                <form method="POST" action="{{ route('admin.vouchers.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <x-input-label for="code" value="Kode Promo" />
                            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full uppercase" required />
                        </div>
                        <div>
                            <x-input-label for="type" value="Tipe Diskon" />
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="nominal">Nominal (Rp)</option>
                                <option value="percent">Persentase (%)</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="discount_amount" value="Besar Diskon" />
                            <x-text-input id="discount_amount" name="discount_amount" type="number" class="mt-1 block w-full" required />
                        </div>
                        <div class="flex items-end">
                            <x-primary-button class="w-full justify-center h-11">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Voucher</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diskon</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($vouchers as $voucher)
                            <tr>
                                <td class="px-6 py-4 font-bold">{{ $voucher->code }}</td>
                                <td class="px-6 py-4">{{ ucfirst($voucher->type) }}</td>
                                <td class="px-6 py-4">
                                    {{ $voucher->type == 'percent' ? floatval($voucher->discount_amount) . '%' : 'Rp ' . number_format($voucher->discount_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" onsubmit="return confirm('Hapus voucher ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
