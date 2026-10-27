<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Book Stock SMKN5</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        .sidebar { background: #6b3f28; }
        .brown { color: #6b3f28; }
        .menu-active { background-color: #d96b24; }
    </style>
</head>
<body class="bg-[#f7f4f1]">

<div class="min-h-screen flex">

    <!-- ================= SIDEBAR (KONSISTEN COKELAT) ================= -->
    <aside class="sidebar w-64 min-h-screen text-white fixed left-0 top-0">
        <div class="p-5 text-center border-b border-white/20">
            <div class="text-5xl mb-2">📚</div>
            <h1 class="text-xl font-bold">Book Stock</h1>
            <p class="text-sm text-white/80">SMKN 5 Kabupaten Tangerang</p>
        </div>

        <nav class="mt-5 px-3">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">🏠</span>
                <span>Dashboard</span>
            </a>

            <!-- Data Buku (AKTIF) -->
            <a href="{{ route('books.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg menu-active mb-2">
                <span class="text-xl">📚</span>
                <span>Data Buku</span>
            </a>

            <!-- Kategori -->
            <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📂</span>
                <span>Kategori Buku</span>
            </a>

            <!-- Supplier -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">🏢</span>
                <span>Supplier</span>
            </a>

            <!-- Pengajuan Restock -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📄</span>
                <span>Pengajuan Restock</span>
            </a>

            <!-- Riwayat Restock -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📋</span>
                <span>Riwayat Restock</span>
            </a>

            <!-- Laporan -->
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📊</span>
                <span>Laporan</span>
            </a>

            <!-- Profil -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">👤</span>
                <span>Profil</span>
            </a>
        </nav>

        <div class="absolute bottom-5 left-3 right-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600/80 transition">
                    <span class="text-xl">🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="ml-64 w-full min-h-screen">
        
        <!-- TOPBAR (DIUBAH JADI PUTIH BERSIH) -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shadow-sm">
            <div>
                <h2 class="text-2xl font-bold brown">Data Buku</h2>
                <p class="text-gray-500">Kelola daftar buku perpustakaan</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="font-semibold brown">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
                <div class="w-11 h-11 rounded-full bg-[#6b3f28] text-white font-bold flex items-center justify-center text-xl shadow">
                    👤
                </div>
            </div>
        </header>

        <!-- KONTEN UTAMA HALAMAN DATA BUKU -->
        <section class="p-8">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                
                <!-- Bagian Tombol Tambah & Search -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold brown">Daftar Koleksi Buku</h3>
                    <a href="{{ route('books.create') }}" class="bg-[#6b3f28] hover:bg-[#553120] text-white px-4 py-2 rounded-lg font-medium transition flex items-center gap-2">
                        <span>➕</span> Tambah Buku
                    </a>
                </div>

                <!-- Tabel Data Buku -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#f4eee9] brown border-b border-gray-200">
                                <th class="p-3">No</th>
                                <th class="p-3">Judul Buku</th>
                                <th class="p-3">Penerbit</th>
                                <th class="p-3">Pengarang</th>
                                <th class="p-3">Tahun Terbit</th>
                                <th class="p-3">Tahun Bantuan</th>
                                <th class="p-3">Kategori</th>
                                <th class="p-3">Stok</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books ?? [] as $index => $book)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3 font-semibold">{{ $book->title }}</td>
                                <td class="p-3">{{ $book->category->name ?? '-' }}</td>
                                <td class="p-3">{{ $book->stock }}</td>
                                <td class="p-3 flex gap-2">
                                    <!-- Tombol Edit yang Diperbaiki -->
                                    <a href="{{ route('books.edit', $book->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">Edit</a>
                                    
                                    <!-- Tombol Hapus yang Diperbaiki -->
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-5 text-gray-500">Belum ada data buku.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </main>
</div>

</body>
</html>