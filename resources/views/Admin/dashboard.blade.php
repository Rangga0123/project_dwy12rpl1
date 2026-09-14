<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - Book Stock SMKN5</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background: #6b3f28;
        }

        .brown {
            color: #6b3f28;
        }

        .border-brown {
            border-color: #8b4e2d;
        }

        .bg-brown {
            background-color: #6b3f28;
        }

        .bg-brown-light {
            background-color: #f4eee9;
        }

        .menu-active {
            background-color: #d96b24;
        }

        .card {
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
    </style>
</head>

<body class="bg-[#f7f4f1]">

<div class="min-h-screen flex">

    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar w-64 min-h-screen text-white fixed left-0 top-0">

        <!-- Logo -->
        <div class="p-5 text-center border-b border-white/20">

            <div class="text-5xl mb-2">
                📚
            </div>

            <h1 class="text-xl font-bold">
                Book Stock
            </h1>

            <p class="text-sm text-white/80">
                SMKN 5 Kabupaten Tangerang
            </p>
        </div>


        <!-- MENU -->
        <nav class="mt-5 px-3">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg menu-active mb-2">
                <span class="text-xl">🏠</span>
                <span>Dashboard</span>
            </a>


            <!-- Data Buku -->
            <a href="{{ route('books.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📚</span>
                <span>Data Buku</span>
            </a>


            <!-- Kategori -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📂</span>
                <span>Kategori Buku</span>
            </a>


            <!-- Supplier -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">🏢</span>
                <span>Supplier</span>
            </a>


            <!-- Pengajuan Restock -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📄</span>
                <span>Pengajuan Restock</span>
            </a>


            <!-- Riwayat Restock -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📋</span>
                <span>Riwayat Restock</span>
            </a>


            <!-- Laporan -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">📊</span>
                <span>Laporan</span>
            </a>


            <!-- Profile -->
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
                <span class="text-xl">👤</span>
                <span>Profil</span>
            </a>

        </nav>


        <!-- Logout -->
        <div class="absolute bottom-5 left-3 right-3">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600/80 transition">

                    <span class="text-xl">🚪</span>
                    <span>Logout</span>

                </button>
            </form>

        </div>

    </aside>



    <!-- ================= MAIN CONTENT ================= -->

    <main class="ml-64 w-full min-h-screen">


        <!-- TOPBAR -->
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">

            <div>
                <h2 class="text-2xl font-bold brown">
                    Dashboard
                </h2>

                <p class="text-gray-600">
                    Selamat datang kembali, Admin.
                </p>
            </div>


            <!-- User -->
            <div class="flex items-center gap-3">

                <div class="text-right">
                    <p class="font-semibold brown">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Administrator
                    </p>
                </div>

                <div class="w-11 h-11 rounded-full bg-[#6b3f28] text-white flex items-center justify-center text-xl">
                    👤
                </div>

            </div>

        </header>



        <!-- CONTENT -->
        <section class="p-8">


            <!-- ================= STATISTIC CARDS ================= -->

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">


                <!-- TOTAL BUKU -->
                <div class="card bg-white rounded-xl p-5 border border-gray-200 shadow-sm">

                    <div class="flex justify-between items-center">

                        <div>
                            <p class="text-gray-500 font-medium">
                                Total Buku
                            </p>

                            <h3 class="text-3xl font-bold brown mt-2">
                                {{ $totalBuku ?? 0 }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-full bg-[#f4eee9] flex items-center justify-center text-3xl">
                            📚
                        </div>

                    </div>

                </div>



                <!-- TOTAL STOK -->
                <div class="card bg-white rounded-xl p-5 border border-gray-200 shadow-sm">

                    <div class="flex justify-between items-center">

                        <div>
                            <p class="text-gray-500 font-medium">
                                Total Stok
                            </p>

                            <h3 class="text-3xl font-bold brown mt-2">
                                {{ $totalStok ?? 0 }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-full bg-[#f4eee9] flex items-center justify-center text-3xl">
                            📦
                        </div>

                    </div>

                </div>



                <!-- PENGAJUAN -->
                <div class="card bg-white rounded-xl p-5 border border-gray-200 shadow-sm">

                    <div class="flex justify-between items-center">

                        <div>
                            <p class="text-gray-500 font-medium">
                                Pengajuan Restock
                            </p>

                            <h3 class="text-3xl font-bold brown mt-2">
                                {{ $totalPengajuan ?? 0 }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-full bg-[#f4eee9] flex items-center justify-center text-3xl">
                            📄
                        </div>

                    </div>

                </div>



                <!-- RESTOCK SELESAI -->
                <div class="card bg-white rounded-xl p-5 border border-gray-200 shadow-sm">

                    <div class="flex justify-between items-center">

                        <div>
                            <p class="text-gray-500 font-medium">
                                Restock Selesai
                            </p>

                            <h3 class="text-3xl font-bold brown mt-2">
                                {{ $totalRestockSelesai ?? 0 }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-full bg-[#f4eee9] flex items-center justify-center text-3xl">
                            ✅
                        </div>

                    </div>

                </div>

            </div>



            <!-- ================= BAGIAN BAWAH ================= -->

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


                <!-- RINGKASAN RESTOCK -->
                <div class="xl:col-span-2 bg-white rounded-xl border border-gray-200 shadow-sm p-6">

                    <div class="flex justify-between items-center mb-6">

                        <div>
                            <h3 class="text-xl font-bold brown">
                                Ringkasan Restock
                            </h3>

                            <p class="text-gray-500 text-sm">
                                Status pengajuan restock buku
                            </p>
                        </div>

                        <span class="text-3xl">
                            📊
                        </span>

                    </div>


                    <!-- Menunggu -->
                    <div class="mb-5">

                        <div class="flex justify-between mb-2">

                            <span class="font-medium text-gray-700">
                                Menunggu
                            </span>

                            <span class="font-bold">
                                {{ $totalMenunggu ?? 0 }}
                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div class="bg-yellow-400 h-3 rounded-full"
                                 style="width: 30%">
                            </div>

                        </div>

                    </div>



                    <!-- Diproses -->
                    <div class="mb-5">

                        <div class="flex justify-between mb-2">

                            <span class="font-medium text-gray-700">
                                Diproses
                            </span>

                            <span class="font-bold">
                                {{ $totalDiproses ?? 0 }}
                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div class="bg-blue-500 h-3 rounded-full"
                                 style="width: 50%">
                            </div>

                        </div>

                    </div>



                    <!-- Selesai -->
                    <div>

                        <div class="flex justify-between mb-2">

                            <span class="font-medium text-gray-700">
                                Selesai
                            </span>

                            <span class="font-bold">
                                {{ $totalRestockSelesai ?? 0 }}
                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3">

                            <div class="bg-green-500 h-3 rounded-full"
                                 style="width: 80%">
                            </div>

                        </div>

                    </div>

                </div>



                <!-- AKSI CEPAT -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">

                    <h3 class="text-xl font-bold brown mb-5">
                        Aksi Cepat
                    </h3>


                    <!-- Tambah Buku -->
                    <a href="{{ route('books.create') }}"
                       class="flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9] hover:bg-[#eadfd7] mb-3 transition">

                        <div class="text-2xl">
                            ➕
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



                    <!-- Pengajuan -->
                    <a href="#"
                       class="flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9] hover:bg-[#eadfd7] mb-3 transition">

                        <div class="text-2xl">
                            📄
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



                    <!-- Laporan -->
                    <a href="#"
                       class="flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9] hover:bg-[#eadfd7] transition">

                        <div class="text-2xl">
                            📊
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



            <!-- ================= INFORMASI SISTEM ================= -->

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mt-6">

                <div class="flex items-start gap-4">

                    <div class="text-4xl">
                        📚
                    </div>

                    <div>

                        <h3 class="text-xl font-bold brown mb-1">
                            Book Stock SMKN5
                        </h3>

                        <p class="text-gray-600">
                            Sistem ini digunakan untuk membantu pengelolaan
                            data buku, stok buku, pengajuan restock,
                            supplier, serta riwayat penambahan stok
                            perpustakaan SMKN 5 Kabupaten Tangerang.
                        </p>

                    </div>

                </div>

            </div>


        </section>

    </main>

</div>

</body>
</html>