<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Book Stock SMKN5</title>

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

        .card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(74, 45, 30, 0.10);
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

        .stat-number {
            animation: numberEnter 0.6s ease-out;
        }

        @keyframes numberEnter {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .quick-item {
            transition: all 0.2s ease;
        }

        .quick-item:hover {
            transform: translateX(4px);
            background: #eee3da;
        }
    </style>
</head>

<body>

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="sidebar w-64 min-h-screen text-white fixed left-0 top-0">

        <!-- LOGO -->
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


        <!-- MENU -->
        <nav class="mt-5 px-3">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg menu-active mb-2">

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


            <!-- Data Buku -->
            <a href="{{ route('books.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

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


            <!-- Kategori -->
            <a href="{{ route('categories.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"/>
                </svg>

                <span class="text-sm">Kategori Buku</span>

            </a>


            <!-- Supplier -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 21h18"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 21V7l7-4 7 4v14"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 21v-5h6v5M9 9h.01M12 9h.01M15 9h.01"/>
                </svg>

                <span class="text-sm">Supplier</span>

            </a>


            <!-- Pengajuan -->
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


            <!-- Riwayat -->
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


            <!-- Laporan -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5 20V10M12 20V4M19 20v-7"/>
                </svg>

                <span class="text-sm">Laporan</span>

            </a>


            <!-- Profile -->
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


        <!-- LOGOUT -->
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
                    Dashboard
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Selamat datang kembali, Admin.
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

            <!-- STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

                <!-- TOTAL BUKU -->
                <div class="card bg-white rounded-xl p-5 border border-gray-200">

                    <p class="text-sm text-gray-500">
                        Total Buku
                    </p>

                    <div class="flex items-end justify-between mt-3">

                        <h3 class="text-3xl font-bold brown stat-number">
                            {{ $totalBuku ?? 0 }}
                        </h3>

                        <span class="text-sm text-gray-400">
                            Buku
                        </span>

                    </div>

                </div>


                <!-- STOK -->
                <div class="card bg-white rounded-xl p-5 border border-gray-200">

                    <p class="text-sm text-gray-500">
                        Total Stok
                    </p>

                    <div class="flex items-end justify-between mt-3">

                        <h3 class="text-3xl font-bold brown stat-number">
                            {{ $totalStok ?? 0 }}
                        </h3>

                        <span class="text-sm text-gray-400">
                            Unit
                        </span>

                    </div>

                </div>


                <!-- PENGAJUAN -->
                <div class="card bg-white rounded-xl p-5 border border-gray-200">

                    <p class="text-sm text-gray-500">
                        Pengajuan Restock
                    </p>

                    <div class="flex items-end justify-between mt-3">

                        <h3 class="text-3xl font-bold brown stat-number">
                            {{ $totalPengajuan ?? 0 }}
                        </h3>

                        <span class="text-sm text-gray-400">
                            Pengajuan
                        </span>

                    </div>

                </div>


                <!-- SELESAI -->
                <div class="card bg-white rounded-xl p-5 border border-gray-200">

                    <p class="text-sm text-gray-500">
                        Restock Selesai
                    </p>

                    <div class="flex items-end justify-between mt-3">

                        <h3 class="text-3xl font-bold brown stat-number">
                            {{ $totalRestockSelesai ?? 0 }}
                        </h3>

                        <span class="text-sm text-gray-400">
                            Selesai
                        </span>

                    </div>

                </div>

            </div>


            <!-- BAGIAN BAWAH -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                <!-- RINGKASAN -->
                <div class="xl:col-span-2 bg-white rounded-xl border border-gray-200 p-6">

                    <div class="mb-6">

                        <h3 class="text-xl font-bold brown">
                            Ringkasan Restock
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Status pengajuan restock buku
                        </p>

                    </div>


                    <!-- MENUNGGU -->
                    <div class="mb-6">

                        <div class="flex justify-between text-sm mb-2">

                            <span class="text-gray-600">
                                Menunggu
                            </span>

                            <span class="font-semibold">
                                {{ $totalMenunggu ?? 0 }}
                            </span>

                        </div>

                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">

                            <div class="h-full bg-yellow-400 rounded-full transition-all duration-700"
                                 style="width: 30%">
                            </div>

                        </div>

                    </div>


                    <!-- DIPROSES -->
                    <div class="mb-6">

                        <div class="flex justify-between text-sm mb-2">

                            <span class="text-gray-600">
                                Diproses
                            </span>

                            <span class="font-semibold">
                                {{ $totalDiproses ?? 0 }}
                            </span>

                        </div>

                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">

                            <div class="h-full bg-blue-500 rounded-full transition-all duration-700"
                                 style="width: 50%">
                            </div>

                        </div>

                    </div>


                    <!-- SELESAI -->
                    <div>

                        <div class="flex justify-between text-sm mb-2">

                            <span class="text-gray-600">
                                Selesai
                            </span>

                            <span class="font-semibold">
                                {{ $totalRestockSelesai ?? 0 }}
                            </span>

                        </div>

                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">

                            <div class="h-full bg-green-500 rounded-full transition-all duration-700"
                                 style="width: 80%">
                            </div>

                        </div>

                    </div>

                </div>


                <!-- AKSI CEPAT -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">

                    <h3 class="text-xl font-bold brown mb-5">
                        Aksi Cepat
                    </h3>


                    <a href="{{ route('books.create') }}"
                       class="quick-item flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9] mb-3">

                        <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center brown">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 5v14M5 12h14"/>
                            </svg>

                        </div>

                        <div>

                            <p class="font-semibold brown">
                                Tambah Buku
                            </p>

                            <p class="text-xs text-gray-500">
                                Menambahkan data buku
                            </p>

                        </div>

                    </a>


                    <a href="#"
                       class="quick-item flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9] mb-3">

                        <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center brown">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 3h9l3 3v15H6V3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6M9 15h6"/>
                            </svg>

                        </div>

                        <div>

                            <p class="font-semibold brown">
                                Pengajuan Restock
                            </p>

                            <p class="text-xs text-gray-500">
                                Kelola pengajuan restock
                            </p>

                        </div>

                    </a>


                    <a href="#"
                       class="quick-item flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9]">

                        <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center brown">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 20V10M12 20V4M19 20v-7"/>
                            </svg>

                        </div>

                        <div>

                            <p class="font-semibold brown">
                                Lihat Laporan
                            </p>

                            <p class="text-xs text-gray-500">
                                Melihat laporan restock
                            </p>

                        </div>

                    </a>

                </div>

            </div>


            <!-- INFORMASI -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mt-6">

                <h3 class="text-lg font-bold brown mb-2">
                    Book Stock SMKN 5
                </h3>

                <p class="text-sm text-gray-600 leading-relaxed">
                    Sistem ini digunakan untuk membantu pengelolaan
                    data buku, stok buku, pengajuan restock,
                    supplier, serta riwayat penambahan stok
                    perpustakaan SMKN 5 Kabupaten Tangerang.
                </p>

            </div>

        </section>

    </main>

</div>

</body>
</html>