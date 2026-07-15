<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengumuman') }}
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
                <h3 class="text-lg font-medium text-gray-900 mb-4">Buat Pengumuman Baru</h3>
                <form method="POST" action="{{ route('admin.announcements.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="title" value="Judul Pengumuman" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="content" value="Isi Pengumuman" />
                            <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required></textarea>
                        </div>
                        <div class="block mt-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" checked>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Tampilkan/Aktif') }}</span>
                            </label>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Pengumuman</h3>
                    <div class="space-y-4">
                        @foreach($announcements as $announcement)
                            <div class="border rounded-lg p-4 {{ $announcement->is_active ? 'border-green-300 bg-green-50' : 'border-gray-200 bg-gray-50' }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-bold text-lg text-gray-900">{{ $announcement->title }}</h4>
                                        <p class="text-gray-700 mt-1">{{ $announcement->content }}</p>
                                        <p class="text-xs text-gray-500 mt-2">{{ $announcement->created_at->format('d M Y H:i') }} | Status: {{ $announcement->is_active ? 'Aktif' : 'Non-aktif' }}</p>
                                    </div>
                                    <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-semibold">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        @if($announcements->isEmpty())
                            <p class="text-gray-500 text-center py-4">Belum ada pengumuman.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
