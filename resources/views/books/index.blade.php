<x-app-layout>
    <!-- Header / Judul Halaman yang akan masuk ke slot $header di app.blade.php -->
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-500 mb-1">
                    Sistem Informasi Perpustakaan
                </p>
                <h2 class="text-3xl font-bold text-[#713f24]">
                    Data Buku
                </h2>
                <p class="text-gray-600 mt-1 text-sm">
                    Daftar katalog buku yang tersedia di perpustakaan
                </p>
            </div>

            @if(Auth::user()->role === 'admin')
                <div>
                    <a href="{{ route('books.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#713f24] text-white rounded-xl font-semibold hover:bg-[#5c321d] transition shadow-sm text-sm">
                        <span>＋</span> Tambah Buku Baru
                    </a>
                </div>
            @endif
        </div>
    </x-slot>

    <!-- Konten Utama Halaman -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            
            <!-- TABLE KATALOG BUKU -->
            <div class="bg-white border border-[#eaded5] shadow-[0_5px_18px_rgba(76,45,29,0.08)] rounded-2xl overflow-hidden">

                <!-- HEADER TABLE -->
                <div class="px-7 py-5 border-b border-[#eaded5] flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <h3 class="text-xl font-bold text-[#713f24]">
                            Katalog Buku Perpustakaan
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Informasi detail mengenai ketersediaan stok buku
                        </p>
                    </div>
                </div>

                <!-- TABLE CONTENT -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#faf6f2]">
                            <tr class="text-left text-sm text-[#713f24]">
                                <th class="px-6 py-4 font-bold">No</th>
                                <th class="px-6 py-4 font-bold">Judul Buku</th>
                                <th class="px-6 py-4 font-bold">Penulis / Kategori</th>
                                <th class="px-6 py-4 font-bold text-center">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#eaded5]">
                            @forelse ($books as $index => $book)
                                <tr class="hover:bg-[#faf6f2]/60 transition text-sm">
                                    <td class="px-6 py-4 font-medium text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-bold text-[#713f24]">{{ $book->title }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $book->author }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1.5 bg-[#f7e9dc] text-[#713f24] font-bold rounded-full text-xs">
                                            {{ $book->stock }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 rounded-full bg-[#f7e9dc] flex items-center justify-center text-3xl mb-4">
                                                📚
                                            </div>
                                            <h4 class="font-bold text-lg text-[#713f24]">
                                                Belum ada data buku
                                            </h4>
                                            <p class="text-sm text-gray-500 mt-1">
                                                Silakan tambahkan data buku baru jika ada buku yang perlu dimasukkan ke katalog.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="text-center text-sm text-gray-400 mt-8">
                © {{ date('Y') }} Book Stock SMKN5 · Sistem Restock Buku Perpustakaan
            </div>

        </div>
    </div>
</x-app-layout>