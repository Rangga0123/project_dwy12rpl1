<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Book Stock SMKN 5</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --brown: #70432d;
            --brown-dark: #5d3523;
            --orange: #d96b24;
            --page: #f6f3f0;
            --line: #e9e1db;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--page);
            color: #292524;
        }

        a, button {
            -webkit-tap-highlight-color: transparent;
        }

        /* SIDEBAR */
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

        /* HEADER */
        .topbar {
            height: 76px;
            background: #fff;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .brown {
            color: var(--brown);
        }

        .page-title {
            color: var(--brown);
            letter-spacing: -.45px;
        }

        /* CARDS */
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

        .stat-card:nth-child(2) {
            animation-delay: .05s;
        }

        .stat-card:nth-child(3) {
            animation-delay: .10s;
        }

        .stat-card:nth-child(4) {
            animation-delay: .15s;
        }

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

        .soft-link:hover {
            color: var(--orange);
        }

        /* PROFILE */
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

        .hamburger:hover {
            background: #f5eee8;
        }

        .empty-icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #f5eee8;
            display: grid;
            place-items: center;
            font-size: 23px;
        }

        .sidebar-backdrop {
            display: none;
        }

        /* ANIMASI */
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

        /* DESKTOP: SIDEBAR HILANG SEPENUHNYA */
        @media (min-width: 1024px) {
            .sidebar {
                overflow: hidden;
            }

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

        /* RESPONSIVE HP */
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

            <a href="{{ route('dashboard') }}"
               class="sidebar-item sidebar-active"
               aria-current="page">
                <span class="menu-icon">⌂</span>
                <span class="menu-label">Dashboard</span>
            </a>

            <a href="{{ route('books.index') }}"
               class="sidebar-item">
                <span class="menu-icon">▤</span>
                <span class="menu-label">Data Buku</span>
            </a>

            <a href="{{ route('user.restock.create') }}"
               class="sidebar-item">
                <span class="menu-icon">▧</span>
                <span class="menu-label">Pengajuan Restock</span>
            </a>

            <a href="{{ route('user.restock.history') }}"
               class="sidebar-item">
                <span class="menu-icon">◷</span>
                <span class="menu-label">Riwayat Restock</span>
            </a>

            <a href="{{ route('user.restock.history') }}"
               class="sidebar-item">
                <span class="menu-icon">↻</span>
                <span class="menu-label">Status Restock</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="sidebar-item">
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

        <!-- HEADER -->
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
                   class="flex items-center gap-3">

                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold brown leading-5">
                            {{ Auth::user()->name ?? 'User' }}
                        </p>

                        <p class="text-xs text-gray-500">
                            User
                        </p>
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

        <!-- DASHBOARD -->
        <section class="content-area p-7 lg:p-8">

            <!-- JUDUL -->
            <div
                class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6"
                style="animation: rise-in .4s both;">

                <div>
                    <p class="text-xs uppercase tracking-wider text-stone-500 mb-2">
                        Sistem Informasi Perpustakaan
                    </p>

                    <h2 class="page-title text-3xl font-bold">
                        Dashboard
                    </h2>

                    <p class="text-sm text-stone-600 mt-2">
                        Selamat datang kembali,
                        <span class="font-semibold brown">
                            {{ Auth::user()->name ?? 'User' }}
                        </span>
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-500">
                        Hari ini
                    </p>

                    <p class="text-sm font-semibold brown mt-1">
                        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>

            <!-- KARTU STATISTIK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

                <div class="card stat-card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">TOTAL BUKU</p>
                            <h3 class="stat-number count-up"
                                data-value="{{ $totalBuku ?? 0 }}">
                                {{ $totalBuku ?? 0 }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-2">
                                Buku tersedia di perpustakaan
                            </p>
                        </div>
                        <div class="stat-icon">▤</div>
                    </div>
                </div>

                <div class="card stat-card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">PENGAJUAN SAYA</p>
                            <h3 class="stat-number count-up"
                                data-value="{{ $totalPengajuan ?? 0 }}">
                                {{ $totalPengajuan ?? 0 }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-2">
                                Total pengajuan restock
                            </p>
                        </div>
                        <div class="stat-icon">▧</div>
                    </div>
                </div>

                <div class="card stat-card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">DISETUJUI</p>
                            <h3 class="stat-number count-up"
                                data-value="{{ $totalDisetujui ?? 0 }}">
                                {{ $totalDisetujui ?? 0 }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-2">
                                Pengajuan yang disetujui
                            </p>
                        </div>
                        <div class="stat-icon">✓</div>
                    </div>
                </div>

                <div class="card stat-card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">MENUNGGU</p>
                            <h3 class="stat-number count-up"
                                data-value="{{ $totalMenunggu ?? 0 }}">
                                {{ $totalMenunggu ?? 0 }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-2">
                                Pengajuan menunggu proses
                            </p>
                        </div>
                        <div class="stat-icon">◷</div>
                    </div>
                </div>

            </div>

            <!-- STATUS RESTOCK TERBARU -->
            <div class="card overflow-hidden">

                <div class="px-5 sm:px-6 py-5 border-b border-stone-200
                            flex flex-col sm:flex-row sm:items-center
                            sm:justify-between gap-3">

                    <div>
                        <h3 class="text-lg font-bold brown">
                            Status Restock Terbaru
                        </h3>

                        <p class="text-sm text-stone-500 mt-1">
                            Informasi terbaru mengenai pengajuan restock Anda
                        </p>
                    </div>

                    <a href="{{ route('user.restock.history') }}"
                       class="soft-link text-sm font-semibold">
                        Lihat Semua <span aria-hidden="true">→</span>
                    </a>

                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[620px]">

                        <thead class="table-head">
                            <tr class="text-left text-xs uppercase tracking-wide">
                                <th class="px-5 sm:px-6 py-4 font-bold">No</th>
                                <th class="px-5 sm:px-6 py-4 font-bold">Buku</th>
                                <th class="px-5 sm:px-6 py-4 font-bold">Jumlah</th>
                                <th class="px-5 sm:px-6 py-4 font-bold">Tanggal Pengajuan</th>
                                <th class="px-5 sm:px-6 py-4 font-bold">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($pengajuanTerbaru) && $pengajuanTerbaru->count())
                                @foreach ($pengajuanTerbaru as $item)
                                    <tr class="border-t border-stone-100">
                                        <td class="px-5 sm:px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-5 sm:px-6 py-4 font-medium">
                                            {{ $item->book->title ?? 'Buku tidak ditemukan' }}
                                        </td>

                                        <td class="px-5 sm:px-6 py-4">
                                            {{ $item->jumlah }}
                                        </td>

                                        <td class="px-5 sm:px-6 py-4">
                                            {{ $item->created_at?->format('d-m-Y') ?? '-' }}
                                        </td>

                                        <td class="px-5 sm:px-6 py-4">
                                            @if ($item->status === 'menunggu')
                                                <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                                    Menunggu
                                                </span>
                                            @elseif ($item->status === 'disetujui')
                                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                    Disetujui
                                                </span>
                                            @else
                                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="empty-icon mb-4">▤</div>

                                            <h4 class="font-semibold text-base brown">
                                                Belum ada pengajuan restock
                                            </h4>

                                            <p class="text-sm text-stone-500 mt-2 max-w-md">
                                                Pengajuan restock yang Anda buat akan muncul
                                                di bagian ini.
                                            </p>

                                            <a
                                                href="{{ route('user.restock.create') }}"
                                                class="mt-5 inline-flex items-center gap-2
                                                       px-4 py-2.5 bg-[#70432d] text-white
                                                       rounded-lg text-sm font-semibold
                                                       hover:bg-[#5d3523] transition">
                                                <span class="text-lg leading-none">＋</span>
                                                Ajukan Restock
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
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
    const menuToggle = document.getElementById('menuToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    // Buka/tutup sidebar
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

    // Tutup sidebar HP saat backdrop diklik
    sidebarBackdrop?.addEventListener('click', () => {
        document.body.classList.remove('mobile-menu-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    // Tutup menu HP saat memilih menu
    document.querySelectorAll('.sidebar .sidebar-item').forEach((item) => {
        item.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                document.body.classList.remove('mobile-menu-open');
            }
        });
    });

    // Sesuaikan saat ukuran layar berubah
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            document.body.classList.remove('mobile-menu-open');
        } else {
            document.body.classList.remove('sidebar-collapsed');
        }
    });

    // Animasi angka statistik
    document.querySelectorAll('.count-up').forEach((element) => {
        const target = Number(element.dataset.value || 0);

        if (
            !Number.isFinite(target) ||
            target <= 0 ||
            window.matchMedia('(prefers-reduced-motion: reduce)').matches
        ) {
            return;
        }

        const duration = 550;
        const startTime = performance.now();

        const animate = (now) => {
            const progress = Math.min((now - startTime) / duration, 1);

            element.textContent = Math.round(
                target * progress
            ).toLocaleString('id-ID');

            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };

        requestAnimationFrame(animate);
    });
</script>

</body>
</html>