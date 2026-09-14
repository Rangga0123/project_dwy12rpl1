<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Book Stock SMKN5</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f3ef;
            color: #4a2c1d;
        }

        .sidebar {
            background: #713f24;
        }

        .sidebar-item {
            transition: all 0.2s ease;
        }

        .sidebar-item:hover {
            background: #8b4d2c;
            transform: translateX(3px);
        }

        .sidebar-active {
            background: #d86b1f;
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
        }

        .card {
            background: white;
            border: 1px solid #eaded5;
            box-shadow: 0 5px 18px rgba(76, 45, 29, 0.08);
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(76, 45, 29, 0.12);
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #eaded5;
        }

        .brown {
            color: #713f24;
        }

        .orange {
            color: #d86b1f;
        }
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
            <h1 class="text-2xl font-bold">
                Book Stock SMKN5
            </h1>
            <p class="text-sm text-white/75 mt-1">
                Sistem Restock Buku
            </p>
            <p class="text-sm text-white/75">
                Perpustakaan
            </p>
        </div>

        <!-- MENU -->
        <nav class="flex-1 px-4 py-6 space-y-2">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">🏠</span>
                <span>Dashboard</span>
            </a>

            <!-- Data Buku (Aktif) -->
            <a href="{{ route('books.index') }}"
               class="sidebar-item sidebar-active flex items-center gap-4 px-4 py-3 rounded-xl font-semibold">
                <span class="text-xl">📚</span>
                <span>Data Buku</span>
            </a>

            <!-- Pengajuan Restock -->
            <a href="{{ route('books.index') }}"
               class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">📄</span>
                <span>Pengajuan Restock</span>
            </a>

            <!-- Riwayat Restock -->
            <a href="#"
               class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">🕘</span>
                <span>Riwayat Restock</span>
            </a>

            <!-- Status Restock -->
            <a href="#"
               class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">🔄</span>
                <span>Status Restock</span>
            </a>

            <!-- Profil -->
            <a href="{{ route('profile.edit') }}"
               class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl">
                <span class="text-xl">👤</span>
                <span>Profil</span>
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="px-4 pb-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="sidebar-item w-full flex items-center gap-4 px-4 py-3 rounded-xl text-left hover:bg-red-700">
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

            <!-- MENU -->
            <button class="text-3xl brown">
                ☰
            </button>

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
                        <p class="font-bold brown">
                            {{ Auth::user()->name ?? 'User' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            User
                        </p>
                    </div>
                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <section class="p-8">

            <!-- TITLE & ACTION -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <p class="text-sm text-gray-500 mb-1">
                        Sistem Informasi Perpustakaan
                    </p>
                    <h2 class="text-4xl font-bold brown">
                        Data Buku
                    </h2>
                    <p class="text-gray-600 mt-2">
                        Daftar katalog buku yang tersedia di perpustakaan
                    </p>
                </div>

                @if(Auth::user()->role === 'admin')
                    <div>
                        <a href="{{ route('books.create') }}"
                           class="inline-flex items-center gap-2 px-5 py-3 bg-[#713f24] text-white rounded-xl font-semibold hover:bg-[#5c321d] transition shadow-sm">
                            <span>＋</span> Tambah Buku Baru
                        </a>
                    </div>
                @endif
            </div>

            <!-- TABLE KATALOG BUKU -->
            <div class="card rounded-2xl overflow-hidden">

                <!-- HEADER TABLE -->
                <div class="px-7 py-5 border-b border-[#eaded5] flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <h3 class="text-xl font-bold brown">
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
                            <tr class="text-left text-sm brown">
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
                                    <td class="px-6 py-4 font-bold brown">{{ $book->title }}</td>
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
                                            <h4 class="font-bold text-lg brown">
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

        </section>

    </main>

</div>

</body>
</html>