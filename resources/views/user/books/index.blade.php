<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Book Stock SMKN5</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, Helvetica, sans-serif; background: #f7f3ef; color: #4a2c1d; }
        .sidebar { background: #713f24; }
        .sidebar-item { transition: all 0.2s ease; }
        .sidebar-item:hover { background: #8b4d2c; transform: translateX(3px); }
        .sidebar-active { background: #d86b1f; box-shadow: 0 4px 10px rgba(0,0,0,0.12); }
        .card { background: white; border: 1px solid #eaded5; box-shadow: 0 5px 18px rgba(76, 45, 29, 0.08); }
        .topbar { background: white; border-bottom: 1px solid #eaded5; }
        .brown { color: #713f24; }
    </style>
</head>
<body>

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar w-[270px] min-h-screen text-white flex flex-col">

        <!-- LOGO -->
        <div class="px-6 py-7 text-center border-b border-white/20">
            <div class="mx-auto mb-3 w-16 h-16 rounded-2xl bg-white flex items-center justify-center shadow-lg">
                <span class="text-4xl">📖</span>
            </div>
            <h1 class="text-2xl font-bold">Book Stock SMKN5</h1>
            <p class="text-sm text-white/75 mt-1">Sistem Restock Buku</p>
            <p class="text-sm text-white/75">Perpustakaan</p>
        </div>

        <!-- MENU -->
        <nav class="flex-1 px-4 py-6 space-y-2">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">🏠</span>
                <span>Dashboard</span>
            </a>

            <!-- Data Buku -->
            <a href="{{ route('books.index') }}" class="sidebar-item sidebar-active flex items-center gap-4 px-4 py-3 rounded-xl font-semibold">
                <span class="text-xl">📚</span>
                <span>Data Buku</span>
            </a>

            <!-- Pengajuan Restock -->
            <a href="{{ route('user.restock.create') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">📄</span>
                <span>Pengajuan Restock</span>
            </a>

            <!-- Riwayat Restock -->
            <a href="#" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">🕘</span>
                <span>Riwayat Restock</span>
            </a>

            <!-- Status Restock -->
            <a href="#" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">🔄</span>
                <span>Status Restock</span>
            </a>

            <!-- Profil -->
            <a href="{{ route('profile.edit') }}" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">👤</span>
                <span>Profil</span>
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="px-4 pb-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-item w-full flex items-center gap-4 px-4 py-3 rounded-xl text-left hover:bg-red-700">
                    <span class="text-xl">🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- ================= MAIN ================= -->
    <main class="flex-1 min-w-0">

        <!-- TOPBAR -->
        <header class="topbar h-[76px] flex items-center justify-between px-8">
            <button class="text-3xl brown">☰</button>

            <!-- RIGHT -->
            <div class="flex items-center gap-6">
                <!-- Notification -->
                <button class="relative text-2xl brown">
                    🔔
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                </button>

                <!-- User -->
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full bg-[#713f24] text-white flex items-center justify-center text-xl">
                        👤
                    </div>
                    <div class="hidden sm:block">
                        <p class="font-bold brown">{{ Auth::user()->name ?? 'User' }}</p>
                        <p class="text-xs text-gray-500">User</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <section class="p-8">
            <div class="mb-8">
                <h2 class="text-4xl font-bold brown">Data Buku</h2>
                <p class="text-gray-600 mt-2">Daftar seluruh buku yang tersedia di perpustakaan.</p>
            </div>

            <!-- TABEL BUKU -->
            <div class="card rounded-2xl overflow-hidden p-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-[#eaded5] text-left brown">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Judul Buku</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $index => $book)
                        <tr class="border-b border-[#f7f3ef] hover:bg-[#faf6f2]">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 font-semibold brown">{{ $book->title }}</td>
                            <td class="py-3 px-4">{{ $book->category->name ?? 'Tanpa Kategori' }}</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $book->stock }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-8 text-gray-400">Belum ada data buku.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </main>

</div>

</body>
</html>