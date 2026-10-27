@extends('admin.layouts.app')

@section('title', 'Kategori Buku')

@push('styles')
<style>
    .card {
        background: #ffffff;
        border: 1px solid #e2ddd9;
        box-shadow: 0 3px 12px rgba(70, 45, 30, 0.06);
    }
    .input-field { transition: all .2s ease; }
    .input-field:focus {
        border-color: #6b3f28;
        box-shadow: 0 0 0 3px rgba(107, 63, 40, 0.08);
        outline: none;
    }
    .save-button { transition: all .2s ease; }
    .save-button:hover { background: #56321f; transform: translateY(-1px); }
    .table-row { transition: background .2s ease; }
    .table-row:hover { background: #faf7f4; }
    .delete-button { transition: all .2s ease; }
    .delete-button:hover { background: #fee2e2; transform: translateY(-1px); }
    .success-message { animation: successIn .3s ease; }
    @keyframes successIn {
        from { opacity: 0; transform: translateY(-5px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<section class="page-content p-8 page-enter">

    @if(session('success'))
        <div class="success-message mb-6 px-5 py-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- TAMBAH KATEGORI -->
        <div class="card rounded-xl p-6 h-fit">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold brown">Tambah Kategori</h3>
                    <p class="text-sm text-gray-500 mt-1">Tambahkan kategori buku baru</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-[#f4e9df] flex items-center justify-center brown text-xl">+</div>
            </div>

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-semibold brown mb-2">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           placeholder="Contoh: Pelajaran"
                           class="input-field w-full h-11 px-4 rounded-lg border border-gray-300 text-sm text-gray-700">
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold brown mb-2">
                        Deskripsi <span class="font-normal text-gray-400">(Opsional)</span>
                    </label>
                    <textarea name="description" rows="4"
                              placeholder="Masukkan deskripsi kategori..."
                              class="input-field w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-700 resize-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="save-button w-full h-11 rounded-lg bg-[#6b3f28] text-white text-sm font-semibold">
                    Simpan Kategori
                </button>
            </form>
        </div>

        <!-- DAFTAR KATEGORI -->
        <div class="card rounded-xl overflow-hidden xl:col-span-2">

            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <h3 class="text-xl font-bold brown">Daftar Kategori</h3>
                        <p class="text-sm text-gray-500 mt-1">Data kategori buku yang tersedia</p>
                    </div>

                    <div class="px-3 py-2 rounded-lg bg-[#f4e9df] brown text-sm font-semibold whitespace-nowrap">
                        {{ $categories->count() }} Kategori
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#f7f4f1]">
                        <tr class="border-b border-gray-200">
                            <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">No</th>
                            <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">Nama Kategori</th>
                            <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">Deskripsi</th>
                            <th class="px-5 py-4 text-center text-xs font-bold brown uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($categories as $index => $category)
                            <tr class="table-row">
                                <td class="px-5 py-5 text-sm text-gray-500">{{ $index + 1 }}</td>

                                <td class="px-5 py-5">
                                    <span class="text-sm font-bold brown">{{ $category->name }}</span>
                                </td>

                                <td class="px-5 py-5 text-sm text-gray-600">
                                    {{ $category->description ?? '-' }}
                                </td>

                                <td class="px-5 py-5 text-center">
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="delete-button px-4 py-2 rounded-lg border border-red-200 bg-red-50 text-red-600 text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-14 text-center">
                                    <p class="text-sm font-semibold text-gray-500">Belum ada kategori buku.</p>
                                    <p class="text-xs text-gray-400 mt-1">Tambahkan kategori melalui form di sebelah kiri.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center text-xs text-gray-400 mt-8">
        © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
    </div>

</section>
@endsection