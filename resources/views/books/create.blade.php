<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Book Stock SMKN5</title>
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
        
        <!-- TOPBAR (PUTIH BERSIH) -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shadow-sm">
            <div>
                <h2 class="text-2xl font-bold brown">Tambah Buku</h2>
                <p class="text-gray-500">Formulir penambahan data koleksi buku baru</p>
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

        <!-- KONTEN UTAMA FORM TAMBAH BUKU -->
        <section class="p-8">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 max-w-2xl">
                
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <!-- Judul Buku -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Judul Buku</label>
                        <input type="text" name="title" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-[#6b3f28]" placeholder="Masukkan judul buku..." required>
                    </div>

                    <!-- Kategori Buku -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <select name="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-[#6b3f28]" required>
                            <option value="">Pilih Kategori</option>
                            <!-- Jika ada variabel $categories dari controller, loop di sini -->
                            @foreach($categories ?? [] as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Stok Buku -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Jumlah Stok</label>
                        <input type="number" name="stock" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-[#6b3f28]" placeholder="0" min="0" required>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-[#6b3f28] hover:bg-[#553120] text-white px-5 py-2 rounded-lg font-medium transition">
                            Simpan Buku
                        </button>
                        <a href="{{ route('books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2 rounded-lg font-medium transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </section>
    </main>
</div>

</body>
</html>