<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Book Stock SMKN 5</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * { box-sizing: border-box; }

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

        .brown { color: #6b3f28; }
        .menu-active { background: #d96b24; }

        .menu-item {
            transition: background .25s ease, transform .25s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.12);
            transform: translateX(4px);
        }

        .card, .action-btn {
            transition: all .25s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(74,45,30,.10);
        }

        .action-btn:hover { transform: translateY(-1px); }

        .page-enter {
            animation: pageEnter .5s ease forwards;
        }

        @keyframes pageEnter {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* HAMBURGER SAMA DENGAN DASHBOARD */
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
            transition: background .2s ease;
        }

        .hamburger:hover { background: #f4eee9; }

        /* TOPBAR SAMA DENGAN DASHBOARD */
        .topbar {
            min-height: 77px;
            padding: 20px 32px;
            background: #fff;
        }

        .sidebar-backdrop { display: none; }

        /* DESKTOP */
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

            .page-content { padding: 20px !important; }
            .topbar { padding: 16px !important; }
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

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar min-h-screen text-white shadow-lg flex flex-col">

        <!-- LOGO -->
        <div class="p-6 text-center border-b border-white/15">
            <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-md overflow-hidden">
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

        <!-- MENU ADMIN -->
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

    <!-- MAIN -->
    <main class="min-h-screen">

        <!-- TOPBAR -->
        <header class="topbar bg-white border-b border-gray-200 flex justify-between items-center sticky top-0 z-20 shadow-sm">

            <div class="flex items-center gap-4 min-w-0">
                <button
                    type="button"
                    id="menuToggle"
                    class="hamburger"
                    aria-label="Buka atau tutup menu"
                    aria-expanded="true">
                    ☰
                </button>

                <div class="min-w-0">
                    <h2 class="text-lg font-bold brown">Data Buku</h2>
                    <p class="text-xs text-gray-500">
                        Kelola data buku perpustakaan
                    </p>
                </div>
            </div>

            <!-- PROFIL -->
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 flex-shrink-0 ml-3">

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

        <!-- KONTEN DATA BUKU -->
        <section class="page-content p-8 page-enter">

            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-500 mb-2">
                        Dashboard / Data Buku
                    </p>
                    <h1 class="text-2xl font-bold brown">Daftar Buku</h1>
                    <p class="text-sm text-gray-500 mt-2">
                        Data buku yang tersedia di perpustakaan.
                    </p>
                </div>

                <a href="{{ route('books.create') }}"
                   class="action-btn inline-flex items-center justify-center gap-2 bg-[#6b3f28] hover:bg-[#56301f] text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                         stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Buku
                </a>
            </div>

            <!-- NOTIFIKASI -->
            @if(session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <!-- RINGKASAN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <p class="text-sm text-gray-500">Total Buku</p>
                    <h3 class="text-3xl font-bold brown mt-3">
                        {{ $books->count() }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">
                        Jenis buku terdaftar
                    </p>
                </div>

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <p class="text-sm text-gray-500">Total Stok Buku</p>
                    <h3 class="text-3xl font-bold brown mt-3">
                        {{ $books->sum('stock') }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">
                        Total unit buku
                    </p>
                </div>

            </div>

            <!-- TABEL BUKU -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">

                <div class="px-5 md:px-6 py-5 border-b border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                    <div>
                        <h3 class="font-bold brown text-lg">
                            Data Buku Perpustakaan
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Daftar buku yang telah dimasukkan ke dalam sistem.
                        </p>
                    </div>

                    <input
                        id="bookSearch"
                        type="text"
                        placeholder="Cari judul atau kategori..."
                        class="w-full sm:w-64 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-orange-400">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">

                        <thead class="bg-[#f4eee9]">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide brown">No.</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide brown">Judul Buku</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide brown">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide brown">Stok</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wide brown">Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="bookTableBody" class="divide-y divide-gray-100">

                            @forelse($books as $index => $book)
                                <tr class="book-row hover:bg-[#faf7f4]"
                                    data-search="{{ strtolower(($book->title ?? '') . ' ' . ($book->category->name ?? '')) }}">

                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-gray-800">
                                            {{ $book->title ?? '-' }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $book->category->name ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="font-semibold brown">
                                            {{ $book->stock ?? 0 }}
                                        </span>
                                        <span class="text-xs text-gray-400 ml-1">unit</span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('books.edit', $book->id) }}"
                                               class="action-btn px-3 py-1.5 rounded-md bg-[#f4eee9] brown text-xs font-semibold hover:bg-[#eadfd7]">
                                                Edit
                                            </a>

                                            <form
                                                action="{{ route('books.destroy', $book->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus buku ini?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="action-btn px-3 py-1.5 rounded-md bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr id="emptyBooks">
                                    <td colspan="5" class="px-6 py-14 text-center">
                                        <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-[#f4eee9] brown flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none"
                                                 stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
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

                            <tr id="noSearchResult" class="hidden">
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    Buku yang kamu cari tidak ditemukan.
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 text-xs text-gray-500">
                    Total {{ $books->count() }} jenis buku terdaftar.
                </div>

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

    // TUTUP SIDEBAR HP DENGAN BACKDROP
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
        document.body.classList.remove('mobile-menu-open', 'sidebar-hidden');
        menuToggle?.setAttribute('aria-expanded', 'true');
    });

    // PENCARIAN DATA BUKU
    const searchInput = document.getElementById('bookSearch');
    const rows = Array.from(document.querySelectorAll('.book-row'));
    const noSearchResult = document.getElementById('noSearchResult');

    searchInput?.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visible = 0;

        rows.forEach(function (row) {
            const match = (row.dataset.search || '').includes(keyword);
            row.classList.toggle('hidden', !match);

            if (match) visible++;
        });

        if (noSearchResult) {
            noSearchResult.classList.toggle(
                'hidden',
                rows.length === 0 || visible > 0
            );
        }
    });

});
</script>

</body>
</html>