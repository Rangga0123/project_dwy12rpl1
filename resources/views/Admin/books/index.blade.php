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
            font-family: Arial, sans-serif;
            background: #f7f4f1;
        }

        .sidebar {
            background: #6b3f28;
        }

        .brown {
            color: #6b3f28;
        }

        .menu-active {
            background: #d96b24;
        }

        .menu-item {
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.10);
            transform: translateX(3px);
        }

        .page-enter {
            animation: pageEnter 0.5s ease-out;
        }

        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-row {
            transition: background-color 0.2s ease;
        }

        .table-row:hover {
            background: #faf7f4;
        }

        .action-btn {
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }
    </style>
</head>

<body>

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="sidebar w-64 min-h-screen text-white fixed left-0 top-0">

        <div class="p-6 text-center border-b border-white/15">

            <div class="w-14 h-14 mx-auto mb-3 rounded-xl bg-white/10 flex items-center justify-center">

                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 5.5A2.5 2.5 0 016.5 3H20v16H6.5A2.5 2.5 0 014 16.5v-11z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 16.5A2.5 2.5 0 016.5 14H20"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7h8M8 10h6"/>
                </svg>

            </div>

            <h1 class="text-xl font-bold">
                Book Stock
            </h1>

            <p class="text-xs text-white/70 mt-1">
                SMKN 5 Kabupaten Tangerang
            </p>

        </div>


        <nav class="mt-5 px-3">

            <a href="{{ route('dashboard') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 10.5L12 3l9 7.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 9.5V21h14V9.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 21v-6h6v6"/>
                </svg>

                <span class="text-sm">Dashboard</span>

            </a>


            <a href="{{ route('books.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg menu-active mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 17a2 2 0 012-2h12"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 7h6M9 10h5"/>
                </svg>

                <span class="text-sm">Data Buku</span>

            </a>


            <a href="{{ route('categories.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"/>
                </svg>

                <span class="text-sm">Kategori Buku</span>

            </a>


            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                </svg>

                <span class="text-sm">Supplier</span>

            </a>


            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 3h9l3 3v15H6V3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14 3v4h4M9 12h6M9 15h6"/>
                </svg>

                <span class="text-sm">Pengajuan Restock</span>

            </a>


            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 5h16v14H4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 9h8M8 12h8M8 15h5"/>
                </svg>

                <span class="text-sm">Riwayat Restock</span>

            </a>


            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 20V10M12 20V4M19 20v-7"/>
                </svg>

                <span class="text-sm">Laporan</span>

            </a>


            <a href="{{ route('profile.edit') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="3"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 20a7 7 0 0114 0"/>
                </svg>

                <span class="text-sm">Profil</span>

            </a>

        </nav>


        <div class="absolute bottom-5 left-3 right-3">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="menu-item w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600/80">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10 17l5-5-5-5M15 12H3"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 19V5a2 2 0 00-2-2h-5"/>
                    </svg>

                    <span class="text-sm">Logout</span>

                </button>

            </form>

        </div>

    </aside>


    <!-- MAIN -->
    <main class="ml-64 w-full min-h-screen">

        <!-- TOPBAR -->
        <header class="bg-white border-b border-gray-200 px-8 py-5 flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold brown">
                    Data Buku
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola data buku perpustakaan.
                </p>

            </div>


            <div class="flex items-center gap-3">

                <div class="text-right">

                    <p class="font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Administrator
                    </p>

                </div>

                <div class="w-10 h-10 rounded-full bg-[#f4eee9] brown flex items-center justify-center">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="3"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 20a7 7 0 0114 0"/>
                    </svg>

                </div>

            </div>

        </header>


        <!-- CONTENT -->
        <section class="p-8 page-enter">

            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-6">

                <div>

                    <h3 class="text-2xl font-bold brown">
                        Daftar Buku
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Data buku yang tersedia di perpustakaan.
                    </p>

                </div>


                <a href="{{ route('books.create') }}"
                   class="action-btn inline-flex items-center gap-2 bg-[#6b3f28] hover:bg-[#56301f] text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 5v14M5 12h14"/>
                    </svg>

                    Tambah Buku

                </a>

            </div>


            <!-- TABLE CARD -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-200">

                    <h4 class="font-semibold text-gray-800">
                        Data Buku Perpustakaan
                    </h4>

                    <p class="text-sm text-gray-500 mt-1">
                        Daftar buku yang telah dimasukkan ke dalam sistem.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-[#f4eee9]">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide brown">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide brown">
                                    Judul Buku
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide brown">
                                    Penulis
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide brown">
                                    Stok
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wide brown">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse($books as $index => $book)

                                <tr class="table-row">

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $index + 1 }}
                                    </td>


                                    <td class="px-6 py-4">

                                        <p class="font-semibold text-gray-800">
                                            {{ $book->title ?? '-' }}
                                        </p>

                                    </td>


                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $book->author ?? '-' }}
                                    </td>


                                    <td class="px-6 py-4">

                                        <span class="font-semibold brown">
                                            {{ $book->stock ?? 0 }}
                                        </span>

                                        <span class="text-xs text-gray-400 ml-1">
                                            unit
                                        </span>

                                    </td>


                                    <td class="px-6 py-4">

                                        <div class="flex justify-center gap-2">

                                            <a href="#"
                                               class="action-btn px-3 py-1.5 rounded-md bg-[#f4eee9] brown text-xs font-semibold hover:bg-[#eadfd7]">

                                                Edit

                                            </a>


                                            <a href="#"
                                               class="action-btn px-3 py-1.5 rounded-md bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100">

                                                Hapus

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="px-6 py-14 text-center">

                                        <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-[#f4eee9] brown flex items-center justify-center">

                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 17a2 2 0 012-2h12"/>
                                            </svg>

                                        </div>

                                        <p class="font-semibold text-gray-700">
                                            Belum ada data buku
                                        </p>

                                        <p class="text-sm text-gray-500 mt-1">
                                            Tambahkan buku untuk mulai mengelola data.
                                        </p>

                                    </td>

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