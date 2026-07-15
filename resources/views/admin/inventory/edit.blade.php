<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Edit Barang: ' . $item->name) }}
            </h2>
            <a href="{{ route('admin.inventory.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen" x-data="inventoryForm()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8">
                
                @if($errors->any())
                    <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Mohon perbaiki kesalahan berikut:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.inventory.update', $item) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Item Code -->
                        <div>
                            <label for="item_code" class="block text-sm font-bold text-gray-700 mb-1">Nomor Barang (Kode) <span class="text-red-500">*</span></label>
                            <input type="text" name="item_code" id="item_code" value="{{ old('item_code', $item->item_code) }}" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="inventory_category_id" class="block text-sm font-bold text-gray-700 mb-1">Kategori Barang <span class="text-red-500">*</span></label>
                            <div class="flex gap-2">
                                <select name="inventory_category_id" id="inventory_category_id" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required x-model="selectedCategory">
                                    <option value="" disabled>Pilih Kategori...</option>
                                    <template x-for="cat in categories" :key="cat.id">
                                        <option :value="cat.id" x-text="cat.name" :selected="cat.id == selectedCategory"></option>
                                    </template>
                                </select>
                                <button type="button" @click="showCategoryModal = true" class="mt-1 px-4 py-2 bg-gray-100 border border-gray-300 rounded-xl hover:bg-gray-200 text-gray-700 font-bold transition-colors shadow-sm" title="Tambah Kategori Baru">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nama Barang <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                        </div>

                        <!-- Brand -->
                        <div>
                            <label for="brand" class="block text-sm font-bold text-gray-700 mb-1">Merk (Opsional)</label>
                            <input type="text" name="brand" id="brand" value="{{ old('brand', $item->brand) }}" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Quantity -->
                        <div>
                            <label for="quantity" class="block text-sm font-bold text-gray-700 mb-1">Jumlah <span class="text-red-500">*</span></label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $item->quantity) }}" min="0" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Status Barang <span class="text-red-500">*</span></label>
                            <div class="mt-2 flex space-x-6">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="status" value="baik" class="form-radio text-green-500 focus:ring-green-500 h-5 w-5" {{ old('status', $item->status) === 'baik' ? 'checked' : '' }}>
                                    <span class="ml-2 font-medium text-gray-700">Kondisi Baik</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="status" value="rusak" class="form-radio text-red-500 focus:ring-red-500 h-5 w-5" {{ old('status', $item->status) === 'rusak' ? 'checked' : '' }}>
                                    <span class="ml-2 font-medium text-gray-700">Kondisi Rusak</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-1">Keterangan Tambahan</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">{{ old('description', $item->description) }}</textarea>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition-all duration-300">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Category Modal -->
        <div x-show="showCategoryModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showCategoryModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showCategoryModal = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showCategoryModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form @submit.prevent="submitCategory" class="px-6 py-6">
                        <div class="sm:flex sm:items-start mb-6">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-xl leading-6 font-bold text-gray-900 mb-4" id="modal-title">
                                    Tambah Kategori Baru
                                </h3>
                                <div>
                                    <label for="new_category_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                                    <input type="text" id="new_category_name" x-model="newCategoryName" class="block w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required autofocus>
                                    <p x-show="categoryError" x-text="categoryError" class="mt-2 text-sm text-red-600" style="display: none;"></p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 -mx-6 -mb-6 px-6 py-4 sm:flex sm:flex-row-reverse border-t border-gray-100">
                            <button type="submit" :disabled="isSubmittingCategory" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-2.5 bg-green-600 text-base font-bold text-white hover:bg-green-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                                <span x-show="!isSubmittingCategory">Simpan</span>
                                <span x-show="isSubmittingCategory">Menyimpan...</span>
                            </button>
                            <button type="button" @click="showCategoryModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('inventoryForm', () => ({
                categories: @json($categories),
                selectedCategory: "{{ old('inventory_category_id', $item->inventory_category_id) }}",
                showCategoryModal: false,
                newCategoryName: '',
                isSubmittingCategory: false,
                categoryError: '',

                async submitCategory() {
                    this.isSubmittingCategory = true;
                    this.categoryError = '';
                    
                    try {
                        const response = await fetch('{{ route("admin.inventory-categories.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ name: this.newCategoryName })
                        });
                        
                        const data = await response.json();
                        
                        if(response.ok) {
                            // Add new category to the list
                            this.categories.push(data.category);
                            
                            // Sort categories alphabetically
                            this.categories.sort((a, b) => a.name.localeCompare(b.name));
                            
                            // Select the newly added category
                            this.selectedCategory = data.category.id;
                            
                            // Close modal and reset
                            this.showCategoryModal = false;
                            this.newCategoryName = '';
                        } else {
                            this.categoryError = data.message || 'Kategori sudah ada atau terjadi kesalahan.';
                        }
                    } catch (error) {
                        this.categoryError = 'Terjadi kesalahan koneksi.';
                    } finally {
                        this.isSubmittingCategory = false;
                    }
                }
            }));
        });
    </script>
    @endpush
</x-app-layout>
