<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight flex items-center">
                <svg class="w-7 h-7 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                {{ __('Inventaris Barang') }}
            </h2>
            <div class="flex items-center">
                <a href="{{ route('admin.inventory.print', request()->query()) }}" target="_blank" class="bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 font-bold py-2 px-5 rounded-full shadow-sm transition-all duration-300 transform hover:-translate-y-0.5 flex items-center mr-3">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Laporan
                </a>
                <a href="{{ route('admin.inventory.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                    + Tambah Barang
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm" x-data="{ show: true }" x-show="show" x-transition>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-green-600 hover:text-green-800 focus:outline-none">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Statistics Chart Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Bar Chart -->
                <div class="lg:col-span-2 bg-white p-6 rounded-3xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Kuantitas Barang per Kategori</h3>
                    <p class="text-xs text-gray-500 mb-6">Distribusi jumlah total barang pada setiap kategori inventaris.</p>
                    <div class="relative h-64 w-full">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
                
                <!-- Doughnut Chart -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-center relative overflow-hidden">
                    <h3 class="text-lg font-bold text-gray-800 mb-1 text-center">Status Kondisi</h3>
                    <p class="text-xs text-gray-500 mb-4 text-center">Rasio barang layak pakai vs rusak.</p>
                    <div class="relative h-48 w-full mb-4">
                        <canvas id="conditionChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Filter & Search Form -->
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mb-6">
                <form action="{{ route('admin.inventory.index') }}" method="GET" class="space-y-4">
                    <!-- Search Input Row -->
                    <div>
                        <label for="search" class="sr-only">Cari</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                x-data
                                @input.debounce.500ms="$el.closest('form').submit()"
                                @if(request()->has('search')) autofocus onfocus="this.setSelectionRange(this.value.length, this.value.length);" @endif
                                class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-2xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-base" 
                                placeholder="Ketik kode, nama, atau merk barang... (otomatis mencari)">
                        </div>
                    </div>

                    <!-- Filter Row -->
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-between border-t border-gray-100 pt-4">
                        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                            <!-- Category Filter -->
                            <div class="w-full sm:w-56">
                                <select name="category" class="block w-full py-2.5 px-4 border border-gray-300 bg-white rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm text-gray-700 font-medium">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div class="w-full sm:w-56">
                                <select name="status" class="block w-full py-2.5 px-4 border border-gray-300 bg-white rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm text-gray-700 font-medium">
                                    <option value="">Semua Status</option>
                                    <option value="baik" {{ request('status') === 'baik' ? 'selected' : '' }}>Kondisi Baik</option>
                                    <option value="rusak" {{ request('status') === 'rusak' ? 'selected' : '' }}>Kondisi Rusak</option>
                                </select>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-3 w-full md:w-auto mt-2 md:mt-0">
                            <button type="submit" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-2.5 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                Terapkan Filter
                            </button>
                            @if(request()->anyFilled(['search', 'category', 'status']))
                                <a href="{{ route('admin.inventory.index') }}" class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-2.5 border border-gray-300 rounded-xl shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                                <th class="p-4 font-bold">No. Barang</th>
                                <th class="p-4 font-bold">Nama Barang / Merk</th>
                                <th class="p-4 font-bold">Kategori</th>
                                <th class="p-4 font-bold text-center">Jumlah</th>
                                <th class="p-4 font-bold text-center">Status</th>
                                <th class="p-4 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($items as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4">
                                        <span class="font-mono text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ $item->item_code }}</span>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-gray-900 text-base">{{ $item->name }}</div>
                                        <div class="text-gray-500 text-xs mt-0.5">{{ $item->brand ?? '-' }}</div>
                                    </td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $item->category->name }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center font-bold text-gray-900 text-lg">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="p-4 text-center">
                                        @if($item->status === 'baik')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                                <span class="w-2 h-2 rounded-full bg-green-500 mr-1.5"></span> Baik
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                                <span class="w-2 h-2 rounded-full bg-red-500 mr-1.5"></span> Rusak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right space-x-2 whitespace-nowrap">
                                        <a href="{{ route('admin.inventory.edit', $item) }}" class="inline-flex items-center justify-center px-3 py-1.5 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-colors">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.inventory.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 bg-white border border-red-200 rounded-lg shadow-sm text-sm font-medium text-red-600 hover:bg-red-50 hover:border-red-300 focus:outline-none transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-gray-500">
                                        Belum ada barang di inventaris.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($items->hasPages())
                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category Bar Chart
            const ctxCat = document.getElementById('categoryChart');
            if(ctxCat) {
                new Chart(ctxCat, {
                    type: 'bar',
                    data: {
                        labels: @json($chartCategoryLabels ?? []),
                        datasets: [{
                            label: 'Jumlah Barang',
                            data: @json($chartCategoryData ?? []),
                            backgroundColor: '#22c55e',
                            borderRadius: 6,
                            borderSkipped: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(17, 24, 39, 0.9)',
                                titleFont: { family: "'Outfit', sans-serif", size: 14 },
                                bodyFont: { family: "'Outfit', sans-serif", size: 13 },
                                padding: 12,
                                cornerRadius: 8
                            }
                        },
                        scales: {
                            x: { grid: { display: false } },
                            y: { beginAtZero: true, ticks: { stepSize: 1 } }
                        }
                    }
                });
            }

            // Condition Doughnut Chart
            const ctxCond = document.getElementById('conditionChart');
            if(ctxCond) {
                new Chart(ctxCond, {
                    type: 'doughnut',
                    data: {
                        labels: ['Kondisi Baik', 'Kondisi Rusak'],
                        datasets: [{
                            data: [{{ $totalBaik ?? 0 }}, {{ $totalRusak ?? 0 }}],
                            backgroundColor: ['#22c55e', '#ef4444'],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    padding: 20,
                                    font: { family: "'Outfit', sans-serif", weight: '600', size: 12 }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(17, 24, 39, 0.9)',
                                titleFont: { family: "'Outfit', sans-serif", size: 14 },
                                bodyFont: { family: "'Outfit', sans-serif", size: 13 },
                                padding: 12,
                                cornerRadius: 8
                            }
                        },
                        cutout: '75%'
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
