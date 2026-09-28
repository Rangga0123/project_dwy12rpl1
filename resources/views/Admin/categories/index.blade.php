<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku - Book Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: #f7f3ef; color: #4a2c1d; font-family: Arial, Helvetica, sans-serif; }
        .sidebar { background: #713f24; }
        .sidebar-item:hover { background: #8b4d2c; transform: translateX(3px); transition: 0.2s; }
        .sidebar-active { background: #d86b1f; }
        .card { background: white; border: 1px solid #eaded5; box-shadow: 0 5px 18px rgba(76, 45, 29, 0.08); }
        .brown { color: #713f24; }
    </style>
</head>
<body class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="sidebar w-[270px] min-h-screen text-white flex flex-col">
        <div class="px-6 py-7 text-center border-b border-white/20">
            <div class="mx-auto mb-3 w-16 h-16 rounded-2xl bg-white flex items-center justify-center shadow-lg text-4xl">📖</div>
            <h1 class="text-2xl font-bold">Book Stock</h1>
            <p class="text-sm text-white/75 mt-1">SMKN 5 Kabupaten Tangerang</p>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">🏠 <span>Dashboard</span></a>
            <a href="{{ route('books.index') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">📚 <span>Data Buku</span></a>
            <a href="{{ route('categories.index') }}" class="sidebar-item sidebar-active flex items-center gap-4 px-4 py-3 rounded-xl font-semibold">📂 <span>Kategori Buku</span></a>
            <a href="#" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">🚚 <span>Supplier</span></a>
            <a href="#" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">📄 <span>Pengajuan Restock</span></a>
            <a href="#" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">🕘 <span>Riwayat Restock</span></a>
            <a href="#" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">📊 <span>Laporan</span></a>
        </nav>
        <div class="p-4 border-t border-white/20">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-item w-full flex items-center gap-4 px-4 py-3 rounded-xl text-left">🚪 <span>Logout / Profil</span></button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 min-w-0 p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold brown">Kategori Buku</h2>
                <p class="text-gray-600 mt-1">Kelola kategori pengelompokan buku perpustakaan</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-[#eaded5]">
                <span class="font-bold brown">admin</span>
                <span class="text-xs bg-[#f7e9dc] text-[#713f24] px-2 py-1 rounded-md font-semibold">Administrator</span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl font-semibold text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Form Tambah Kategori -->
            <div class="card p-6 rounded-2xl h-fit">
                <h3 class="text-xl font-bold brown mb-4">Tambah Kategori Baru</h3>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-2 brown">Nama Kategori</label>
                        <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#713f24]">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold mb-2 brown">Deskripsi (Opsional)</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#713f24]"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 bg-[#713f24] text-white font-semibold rounded-xl hover:bg-[#5c321d] transition">
                        Simpan Kategori
                    </button>
                </form>
            </div>

            <!-- Tabel Daftar Kategori -->
            <div class="card rounded-2xl overflow-hidden md:col-span-2 p-6">
                <h3 class="text-xl font-bold brown mb-4">Daftar Kategori</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#faf6f2] text-sm brown">
                            <tr class="text-left">
                                <th class="p-3 font-bold">No</th>
                                <th class="p-3 font-bold">Nama Kategori</th>
                                <th class="p-3 font-bold">Deskripsi</th>
                                <th class="p-3 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#eaded5] text-sm">
                            @forelse ($categories as $index => $category)
                                <tr class="hover:bg-[#faf6f2]/60 transition">
                                    <td class="p-3 text-gray-500 font-medium">{{ $index + 1 }}</td>
                                    <td class="p-3 font-bold brown">{{ $category->name }}</td>
                                    <td class="p-3 text-gray-600">{{ $category->description ?? '-' }}</td>
                                    <td class="p-3 text-center">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded-lg font-semibold hover:bg-red-200 transition">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-500">Belum ada kategori buku.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <div class="text-center text-sm text-gray-400 mt-12">
            © {{ date('Y') }} Book Stock SMKN5 · Sistem Restock Buku Perpustakaan
        </div>
    </main>

</body>
</html>