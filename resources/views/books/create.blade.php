<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Book Stock SMKN 5</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f4f1;
        }

        .sidebar {
            background: #6b3f28;
            width: 256px;
            flex-shrink: 0;
            transition: transform .25s ease;
        }

        .brown {
            color: #6b3f28;
        }

        .menu-active {
            background: #d96b24;
        }

        .menu-item {
            transition: background .25s ease, transform .25s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.12);
            transform: translateX(4px);
        }

        .school-logo {
            transition: transform .4s cubic-bezier(.34,1.56,.64,1);
        }

        .school-logo:hover {
            transform: scale(1.06) rotate(2deg);
        }

        .hamburger {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 8px;
            background: transparent;
            color: #6b3f28;
            font-size: 25px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .hamburger:hover {
            background: #f4eee9;
        }

        .page-enter {
            animation: pageEnter .6s cubic-bezier(.16,1,.3,1) forwards;
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

        .form-card {
            transition: box-shadow .25s ease;
        }

        .form-control {
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #d96b24;
            box-shadow: 0 0 0 3px rgba(217,107,36,.12);
        }

        .action-btn {
            transition: background .2s ease, transform .2s ease;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }

        .sidebar-backdrop {
            display: none;
        }

        /* DESKTOP: SIDEBAR BISA DISEMBUNYIKAN */
        @media (min-width: 1024px) {
            .sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                height: 100vh;
                overflow-y: auto;
                z-index: 40;
            }

            body.sidebar-hidden .sidebar {
                transform: translateX(-100%);
            }

            body.sidebar-hidden main {
                margin-left: 0 !important;
                width: 100%;
            }

            body:not(.sidebar-hidden) main {
                margin-left: 256px;
                width: calc(100% - 256px);
            }
        }

        /* HP DAN TABLET */
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                width: 256px;
                height: 100vh;
                height: 100dvh;
                overflow-y: auto;
                transform: translateX(-100%);
                z-index: 40;
            }

            body.mobile-menu-open .sidebar {
                transform: translateX(0);
            }

            body main {
                margin-left: 0 !important;
                width: 100%;
            }

            .sidebar-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.4);
                z-index: 30;
            }

            body.mobile-menu-open .sidebar-backdrop {
                display: block;
            }

            .page-content {
                padding: 20px !important;
            }

            .topbar {
                padding: 16px !important;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

<div class="min-h-screen">

    <!-- BACKDROP MENU HP -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR ADMIN -->
    <aside class="sidebar min-h-screen text-white shadow-lg flex flex-col">

        <!-- LOGO SEKOLAH -->
        <div class="p-6 text-center border-b border-white/15">
            <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-md school-logo overflow-hidden">
                <img
                    src="{{ asset('images/logo-smkn5.png') }}"
                    alt="Logo SMKN 5 Kabupaten Tangerang"
                    class="w-full h-full object-contain">
            </div>

            <h1 class="text-xl font-bold">Book Stock</h1>

            <p class="text-xs text-white/70 mt-1">
                SMKN 5 Kabupaten Tangerang
            </p>
        </div>

        <!-- MENU -->
        <nav class="mt-5 px-3 flex-1">

            <a href="{{ route('dashboard') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none"
                     stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
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
               class="menu-item menu-active flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none"
                     stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
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
                <svg class="w-5 h-5 flex-shrink-0" fill="none"
                     stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"/>
                </svg>
                <span class="text-sm">Kategori Buku</span>
            </a>

            <a href="{{ route('suppliers.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none"
                     stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                </svg>
                <span class="text-sm">Supplier</span>
            </a>

            <a href="{{ route('admin.restock.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none"
                     stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 3h9l3 3v15H6V3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14 3v4h4M9 12h6M9 15h6"/>
                </svg>
                <span class="text-sm">Pengajuan Restock</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none"
                     stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="3"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 20a7 7 0 0114 0"/>
                </svg>
                <span class="text-sm">Profil</span>
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="px-3 pb-5 mt-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="menu-item w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600/80 text-left">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none"
                         stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
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

    <!-- MAIN CONTENT -->
    <main class="min-h-screen">

        <!-- NAVBAR SAMA SEPERTI DASHBOARD -->
        <header class="topbar bg-white border-b border-gray-200 px-8 py-5 flex justify-between items-center sticky top-0 z-20 shadow-sm">

            <div class="flex items-center gap-4">
                <button
                    type="button"
                    id="menuToggle"
                    class="hamburger"
                    aria-label="Buka atau tutup menu"
                    aria-expanded="true">
                    ☰
                </button>

                <div>
                    <h2 class="text-lg font-bold brown">Tambah Buku</h2>
                    <p class="text-xs text-gray-500">
                        Formulir penambahan data koleksi buku baru
                    </p>
                </div>
            </div>

            <!-- PROFIL ADMIN -->
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3">

                <div class="text-right hidden sm:block">
                    <p class="font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ Auth::user()->role === 'admin' ? 'Administrator' : 'User' }}
                    </p>
                </div>

                @if(Auth::user()->profile_photo)
                    <img
                        src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                        alt="Foto Profil"
                        class="w-10 h-10 rounded-full object-cover border-2 border-[#6b3f28]">
                @else
                    <div class="w-10 h-10 rounded-full bg-[#f4eee9] brown flex items-center justify-center shadow-inner">
                        <svg class="w-5 h-5" fill="none"
                             stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="3"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 20a7 7 0 0114 0"/>
                        </svg>
                    </div>
                @endif
            </a>

        </header>

        <!-- FORM TAMBAH BUKU -->
        <section class="page-content p-8 page-enter">

            <!-- BREADCRUMB DAN JUDUL -->
            <div class="mb-6">
                <p class="text-sm text-gray-500 mb-2">
                    <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                    /
                    <a href="{{ route('books.index') }}" class="hover:underline">Data Buku</a>
                    / Tambah Buku
                </p>

                <h1 class="text-2xl font-bold brown">Tambah Buku Baru</h1>

                <p class="text-sm text-gray-500 mt-2">
                    Isi informasi buku yang akan ditambahkan ke perpustakaan.
                </p>
            </div>

            <!-- NOTIFIKASI VALIDASI -->
            @if($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <p class="font-semibold mb-2">Periksa kembali data yang kamu masukkan:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- KARTU FORM -->
            <div class="form-card bg-white rounded-xl border border-gray-200 shadow-sm p-6 max-w-2xl">

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold brown">Informasi Buku</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Lengkapi judul, kategori, dan jumlah stok buku.
                    </p>
                </div>

                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <!-- JUDUL BUKU -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            Judul Buku <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-control w-full border border-gray-300 rounded-lg px-4 py-3 text-sm"
                            placeholder="Masukkan judul buku..."
                            required>
                    </div>

                    <!-- KATEGORI -->
                    <div class="mb-5">
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori Buku <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="form-control w-full border border-gray-300 rounded-lg px-4 py-3 text-sm bg-white"
                            required>

                            <option value="">Pilih kategori buku</option>

                            @foreach($categories ?? [] as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @if(isset($categories) && $categories->isEmpty())
                            <p class="text-xs text-red-600 mt-2">
                                Belum ada kategori buku. Tambahkan kategori terlebih dahulu.
                            </p>
                        @endif
                    </div>

                    <!-- STOK -->
                    <div class="mb-6">
                        <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah Stok <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            <input
                                id="stock"
                                type="number"
                                name="stock"
                                value="{{ old('stock', 0) }}"
                                class="form-control w-full border border-gray-300 rounded-lg px-4 py-3 pr-16 text-sm"
                                placeholder="Masukkan jumlah stok"
                                min="0"
                                required>

                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm text-gray-400">
                                Unit
                            </span>
                        </div>

                        <p class="text-xs text-gray-400 mt-2">
                            Masukkan jumlah buku yang tersedia saat ini.
                        </p>
                    </div>

                    <!-- TOMBOL -->
                    <div class="flex flex-col-reverse sm:flex-row sm:items-center gap-3 pt-4 border-t border-gray-100">

                        <a
                            href="{{ route('books.index') }}"
                            class="action-btn inline-flex items-center justify-center px-5 py-2.5 rounded-lg border border-gray-300 text-gray-600 text-sm font-semibold hover:bg-gray-100">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="action-btn inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-[#6b3f28] hover:bg-[#553120] text-white text-sm font-semibold shadow-sm">

                            <svg class="w-4 h-4" fill="none"
                                 stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 12l4 4L19 6"/>
                            </svg>

                            Simpan Buku
                        </button>

                    </div>
                </form>
            </div>

        </section>

    </main>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.getElementById('menuToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    // HAMBURGER DESKTOP DAN HP
    menuToggle?.addEventListener('click', function () {

        if (window.innerWidth < 1024) {
            document.body.classList.toggle('mobile-menu-open');

            menuToggle.setAttribute(
                'aria-expanded',
                document.body.classList.contains('mobile-menu-open')
            );

        } else {
            document.body.classList.toggle('sidebar-hidden');

            menuToggle.setAttribute(
                'aria-expanded',
                !document.body.classList.contains('sidebar-hidden')
            );
        }
    });

    // TUTUP MENU HP SAAT BACKDROP DIKLIK
    sidebarBackdrop?.addEventListener('click', function () {
        document.body.classList.remove('mobile-menu-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    // TUTUP MENU HP SETELAH MENU DIPILIH
    document.querySelectorAll('.sidebar a, .sidebar button').forEach(function (item) {
        item.addEventListener('click', function () {
            if (window.innerWidth < 1024) {
                document.body.classList.remove('mobile-menu-open');
                menuToggle?.setAttribute('aria-expanded', 'false');
            }
        });
    });

    // RESET SIDEBAR SAAT UKURAN LAYAR BERUBAH
    window.addEventListener('resize', function () {
        document.body.classList.remove(
            'mobile-menu-open',
            'sidebar-hidden'
        );

        menuToggle?.setAttribute('aria-expanded', 'true');
    });

});
</script>

</body>
</html>