<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Book Stock SMKN 5</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --brown: #70432d;
            --brown-dark: #5d3523;
            --orange: #d96b24;
            --page: #f6f3f0;
            --line: #e9e1db;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--page);
            color: #292524;
        }

        a, button {
            -webkit-tap-highlight-color: transparent;
        }

        /* SIDEBAR — SAMA DENGAN DASHBOARD */
        .sidebar {
            width: 230px;
            min-width: 230px;
            background: var(--brown);
            color: white;
            flex-shrink: 0;
            z-index: 30;
            transition: width .25s ease,
                        min-width .25s ease,
                        margin-left .25s ease,
                        transform .25s ease;
        }

        .brand-area {
            border-bottom: 1px solid rgba(255,255,255,.16);
        }

        .brand-logo {
            width: 58px;
            height: 58px;
            border-radius: 15px;
            background: #fff;
            display: grid;
            place-items: center;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,.10);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 5px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 43px;
            padding: 10px 13px;
            border-radius: 8px;
            color: rgba(255,255,255,.94);
            font-size: 13px;
            font-weight: 600;
            transition: background .18s ease, transform .18s ease;
            text-decoration: none;
        }

        .sidebar-item:hover {
            background: rgba(255,255,255,.11);
            transform: translateX(2px);
        }

        .sidebar-active {
            background: var(--orange);
            color: #fff;
            box-shadow: 0 3px 8px rgba(0,0,0,.1);
        }

        .sidebar-active:hover {
            background: #c95e1b;
        }

        .menu-icon {
            width: 19px;
            text-align: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        /* TOPBAR — SAMA DENGAN DASHBOARD */
        .topbar {
            height: 76px;
            background: #fff;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .brown { color: var(--brown); }

        .page-title {
            color: var(--brown);
            letter-spacing: -.45px;
        }

        /* KARTU */
        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 2px 7px rgba(55,35,24,.035);
            transition: transform .2s ease,
                        box-shadow .2s ease,
                        border-color .2s ease;
            animation: rise-in .45s both;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(55,35,24,.075);
            border-color: #ddc9ba;
        }

        .stat-card:nth-child(2) { animation-delay: .05s; }
        .stat-card:nth-child(3) { animation-delay: .10s; }

        .stat-label {
            font-size: 12px;
            color: #737373;
            font-weight: 600;
        }

        .stat-number {
            font-size: 29px;
            line-height: 1.15;
            font-weight: 700;
            color: var(--brown);
            margin-top: 9px;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 21px;
            background: #f5eee8;
            color: var(--brown);
            transition: transform .2s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.06);
        }

        .table-head {
            background: #f8f5f2;
            color: var(--brown);
        }

        .soft-link {
            color: var(--brown);
            transition: color .18s ease;
            text-decoration: none;
        }

        .soft-link:hover { color: var(--orange); }

        /* PROFIL */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            overflow: hidden;
            background: #f1e5dc;
            color: var(--brown);
            border: 1px solid #eaded5;
            font-size: 17px;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hamburger {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            color: var(--brown);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: background .18s ease;
        }

        .hamburger:hover { background: #f5eee8; }

        .sidebar-backdrop { display: none; }

        /* TABEL DATA BUKU */
        .book-search {
            width: 100%;
            max-width: 290px;
            padding: 10px 12px;
            border: 1px solid #e3d9d1;
            border-radius: 8px;
            background: #fff;
            font-size: 13px;
            outline: none;
            color: #292524;
        }

        .book-search:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 2px rgba(217,107,36,.10);
        }

        .book-table {
            width: 100%;
            min-width: 600px;
            border-collapse: collapse;
        }

        .book-table th {
            padding: 14px 18px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            background: #f8f5f2;
            color: var(--brown);
            border-bottom: 1px solid var(--line);
        }

        .book-table td {
            padding: 16px 18px;
            font-size: 13px;
            border-bottom: 1px solid #f0ebe7;
        }

        .book-table tbody tr:last-child td {
            border-bottom: none;
        }

        .book-table tbody tr:hover {
            background: #fcfaf8;
        }

        .stock-badge {
            display: inline-block;
            min-width: 40px;
            padding: 5px 10px;
            border-radius: 20px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
        }

        .stock-ok {
            background: #dcfce7;
            color: #166534;
        }

        .stock-low {
            background: #fef3c7;
            color: #92400e;
        }

        .stock-empty {
            background: #fee2e2;
            color: #991b1b;
        }

        .sidebar-backdrop { display: none; }

        @keyframes rise-in {
            from {
                opacity: 0;
                transform: translateY(9px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* DESKTOP: SIDEBAR BISA DITUTUP */
        @media (min-width: 1024px) {
            .sidebar { overflow: hidden; }

            body.sidebar-collapsed .sidebar {
                width: 0;
                min-width: 0;
                margin-left: 0;
                overflow: hidden;
                border: none;
            }

            body.sidebar-collapsed .sidebar > * {
                visibility: hidden;
            }
        }

        /* RESPONSIVE HP — SAMA DENGAN DASHBOARD */
        @media (max-width: 1023px) {
            .sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                transform: translateX(-100%);
                height: 100vh;
                height: 100dvh;
                overflow-y: auto;
                width: 250px;
                min-width: 250px;
            }

            body.mobile-menu-open .sidebar {
                transform: translateX(0);
            }

            .sidebar-backdrop {
                position: fixed;
                inset: 0;
                background: rgba(25,18,14,.42);
                z-index: 25;
            }

            body.mobile-menu-open .sidebar-backdrop {
                display: block;
            }

            .content-area {
                padding: 24px 18px !important;
            }

            .topbar {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            .book-search {
                max-width: none;
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

<div class="flex min-h-screen">

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar min-h-screen flex flex-col">

        <div class="brand-area px-5 py-6 text-center">
            <div class="brand-logo mx-auto mb-3">
                <img
                    src="{{ asset('images/logo-smkn5.png') }}"
                    alt="Logo SMKN 5 Kabupaten Tangerang"
                >
            </div>

            <div class="brand-copy">
                <h1 class="text-lg font-bold tracking-tight leading-tight">
                    Book Stock SMKN 5
                </h1>

                <p class="text-xs text-white/75 mt-2">
                    Sistem Restock Buku
                </p>

                <p class="text-xs text-white/75 mt-1">
                    Perpustakaan
                </p>
            </div>
        </div>

        <!-- MENU USER -->
        <nav class="flex-1 px-3 py-5 space-y-1.5">

            <a href="{{ route('dashboard') }}" class="sidebar-item">
                <span class="menu-icon">⌂</span>
                <span class="menu-label">Dashboard</span>
            </a>

            <a href="{{ route('books.index') }}"
               class="sidebar-item sidebar-active"
               aria-current="page">
                <span class="menu-icon">▤</span>
                <span class="menu-label">Data Buku</span>
            </a>

            <a href="{{ route('user.restock.create') }}" class="sidebar-item">
                <span class="menu-icon">▧</span>
                <span class="menu-label">Pengajuan Restock</span>
            </a>

            <a href="{{ route('user.restock.history') }}" class="sidebar-item">
                <span class="menu-icon">◷</span>
                <span class="menu-label">Riwayat Restock</span>
            </a>

            <a href="{{ route('user.restock.history') }}" class="sidebar-item">
                <span class="menu-icon">↻</span>
                <span class="menu-label">Status Restock</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="sidebar-item">
                <span class="menu-icon">♙</span>
                <span class="menu-label">Profil</span>
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="px-3 pb-5 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="sidebar-item w-full text-left hover:!bg-red-700">
                    <span class="menu-icon">⇥</span>
                    <span class="logout-label">Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 min-w-0">

        <!-- TOPBAR -->
        <header class="topbar flex items-center justify-between px-7">

            <button
                type="button"
                id="menuToggle"
                class="hamburger text-2xl"
                aria-label="Buka atau tutup menu"
                aria-expanded="true">
                ☰
            </button>

            <div class="flex items-center gap-5">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 no-underline">

                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold brown leading-5">
                            {{ Auth::user()->name ?? 'User' }}
                        </p>
                        <p class="text-xs text-gray-500">User</p>
                    </div>

                    <div class="user-avatar">
                        @if (Auth::user() && Auth::user()->profile_photo)
                            <img
                                src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                                alt="Foto profil">
                        @else
                            <span>♙</span>
                        @endif
                    </div>

                </a>
            </div>

        </header>

        <!-- HALAMAN DATA BUKU -->
        <section class="content-area p-7 lg:p-8">

            <!-- JUDUL -->
            <div class="mb-6" style="animation: rise-in .4s both;">
                <p class="text-xs uppercase tracking-wider text-stone-500 mb-2">
                    Sistem Informasi Perpustakaan
                </p>

                <h2 class="page-title text-3xl font-bold">
                    Data Buku
                </h2>

                <p class="text-sm text-stone-600 mt-2">
                    Daftar buku dan ketersediaan stok di perpustakaan.
                </p>
            </div>

            <!-- PESAN SUKSES -->
            @if (session('success'))
                <div class="mb-5 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <!-- PESAN ERROR -->
            @if (session('error'))
                <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <!-- KARTU STATISTIK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">

                <div class="card stat-card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">TOTAL JUDUL BUKU</p>
                            <h3 class="stat-number">
                                {{ $books->count() }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-2">
                                Jenis buku terdaftar
                            </p>
                        </div>
                        <div class="stat-icon">▤</div>
                    </div>
                </div>

                <div class="card stat-card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">TOTAL STOK</p>
                            <h3 class="stat-number">
                                {{ $books->sum('stock') }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-2">
                                Seluruh stok buku
                            </p>
                        </div>
                        <div class="stat-icon">≡</div>
                    </div>
                </div>

                <div class="card stat-card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">STOK HABIS</p>
                            <h3 class="stat-number">
                                {{ $books->filter(fn ($book) => ($book->stock ?? 0) <= 0)->count() }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-2">
                                Buku tanpa stok
                            </p>
                        </div>
                        <div class="stat-icon">!</div>
                    </div>
                </div>

            </div>

            <!-- TABEL BUKU -->
            <div class="card overflow-hidden">

                <div class="px-5 sm:px-6 py-5 border-b border-stone-200">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold brown">
                                Daftar Buku Perpustakaan
                            </h3>
                            <p class="text-sm text-stone-500 mt-1">
                                Lihat judul, kategori, dan jumlah stok buku.
                            </p>
                        </div>

                        <input
                            type="search"
                            id="searchBook"
                            class="book-search"
                            placeholder="Cari judul atau kategori buku..."
                            aria-label="Cari judul atau kategori buku">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="book-table">

                        <thead>
                            <tr class="table-head">
                                <th style="width:70px">No.</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th style="width:130px">Stok</th>
                            </tr>
                        </thead>

                        <tbody id="bookTableBody">

                            @forelse ($books as $index => $book)
                                <tr class="book-row">
                                    <td class="text-stone-500">
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        <p class="font-semibold brown book-title">
                                            {{ $book->title }}
                                        </p>
                                        <p class="text-xs text-stone-400 mt-1">
                                            ID Buku: {{ $book->id }}
                                        </p>
                                    </td>

                                    <td class="book-category text-stone-600">
                                        {{ $book->category->name ?? 'Tanpa Kategori' }}
                                    </td>

                                    <td>
                                        @if (($book->stock ?? 0) <= 0)
                                            <span class="stock-badge stock-empty">
                                                Habis
                                            </span>
                                        @elseif (($book->stock ?? 0) <= 5)
                                            <span class="stock-badge stock-low">
                                                {{ $book->stock }} buku
                                            </span>
                                        @else
                                            <span class="stock-badge stock-ok">
                                                {{ $book->stock }} buku
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyBooks">
                                    <td colspan="4" class="text-center py-12">
                                        <p class="font-semibold brown">
                                            Belum ada data buku
                                        </p>
                                        <p class="text-sm text-stone-500 mt-2">
                                            Data buku akan ditampilkan di sini.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse

                            <tr id="noSearchResult" class="hidden">
                                <td colspan="4" class="text-center py-10 text-stone-500">
                                    Buku yang dicari tidak ditemukan.
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="px-5 sm:px-6 py-4 border-t border-stone-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <p class="text-xs text-stone-500">
                        Total <span id="visibleBookCount">{{ $books->count() }}</span>
                        buku ditampilkan.
                    </p>

                    <p class="text-xs text-stone-400">
                        Book Stock SMKN 5
                    </p>
                </div>

            </div>

            <!-- FOOTER -->
            <footer class="text-center text-xs text-stone-400 mt-7">
                © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
            </footer>

        </section>
    </main>
</div>

<script>
    // HAMBURGER — MENGIKUTI DASHBOARD
    const menuToggle = document.getElementById('menuToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    menuToggle?.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            document.body.classList.toggle('mobile-menu-open');

            menuToggle.setAttribute(
                'aria-expanded',
                document.body.classList.contains('mobile-menu-open')
            );
        } else {
            document.body.classList.toggle('sidebar-collapsed');

            menuToggle.setAttribute(
                'aria-expanded',
                !document.body.classList.contains('sidebar-collapsed')
            );
        }
    });

    sidebarBackdrop?.addEventListener('click', () => {
        document.body.classList.remove('mobile-menu-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    document.querySelectorAll('.sidebar .sidebar-item').forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                document.body.classList.remove('mobile-menu-open');
            }
        });
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            document.body.classList.remove('mobile-menu-open');
        } else {
            document.body.classList.remove('sidebar-collapsed');
        }
    });

    // PENCARIAN JUDUL DAN KATEGORI
    const searchInput = document.getElementById('searchBook');
    const rows = [...document.querySelectorAll('.book-row')];
    const noResult = document.getElementById('noSearchResult');
    const countLabel = document.getElementById('visibleBookCount');

    searchInput?.addEventListener('input', function () {
        const keyword = this.value.trim().toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const title = row.querySelector('.book-title')?.textContent.toLowerCase() || '';
            const category = row.querySelector('.book-category')?.textContent.toLowerCase() || '';
            const matched = title.includes(keyword) || category.includes(keyword);

            row.classList.toggle('hidden', !matched);

            if (matched) visibleCount++;
        });

        if (noResult) {
            noResult.classList.toggle(
                'hidden',
                visibleCount > 0 || rows.length === 0
            );
        }

        if (countLabel) {
            countLabel.textContent = visibleCount;
        }
    });
</script>

</body>
</html>