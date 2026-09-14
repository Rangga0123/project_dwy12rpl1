<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-4">
                    <h3 class="text-lg font-bold">Judul Barang:</h3>
                    <p class="text-xl">{{ $book->title }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-bold">Penulis:</h3>
                    <p>{{ $book->author }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-bold">Total Stok Saat Ini:</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $book->stock }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('books.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                        Kembali ke Daftar
                    </a>
                    <a href="{{ route('books.edit', $book->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded ml-2">
                        Edit Data
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>