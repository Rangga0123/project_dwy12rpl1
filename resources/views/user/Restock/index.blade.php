<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengajuan Restock - Book Stock SMKN 5</title>

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

        .sidebar {
            width: 230px;
            min-width: 230px;
            background: var(--brown);
            color: white;
            flex-shrink: 0;
            z-index: 30;
            transition: width .25s ease, min-width .25s ease,
                margin-left .25s ease, transform .25s ease;
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
            color: white;
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

        .topbar {
            height: 76px;
            background: white;
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

        .card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 2px 7px rgba(55,35,24,.035);
            transition: transform .2s ease, box-shadow .2s ease,
                border-color .2s ease;
            animation: rise-in .45s both;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(55,35,24,.075);
            border-color: #ddc9ba;
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

        .stat-icon, .info-icon {
            width: 43px;
            height: 43px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            font-size: 21px;
            background: #f5eee8;
            color: var(--brown);
            flex-shrink: 0;
        }

        .table-head {
            background: #f8f5f2;
            color: var(--brown);
        }

        .soft-link {
            color: var(--brown);
            text-decoration: none;
            transition: color .18s ease;
        }

        .soft-link:hover {
            color: var(--orange);
        }

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
        }

        .hamburger:hover {
            background: #f5eee8;
        }

        .empty-icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #f5eee8;
            color: var(--brown);
            display: grid;
            place-items: center;
            font-size: 23px;
        }

        .sidebar-backdrop {
            display: none;
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: var(--brown);
            color: white;
            border-radius: 8px;
            padding: 12px 18px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: background .2s ease, transform .2s ease;
        }

        .primary-btn:hover {
            background: var(--brown-dark);
            transform: translateY(-1px);
        }

        .secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #f5eee8;
            color: var(--brown);
            border: 1px solid #eaded5;
            border-radius: 8px;
            padding: 11px 15px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .secondary-btn:hover {
            background: #eee1d7;
        }

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
@php
    $requests = $requests ?? collect();

    $totalPengajuan = $requests->count();
    $totalMenunggu = $requests->where('status', 'menunggu')->count();
    $totalDisetujui = $requests->where('status', 'disetujui')->count();
@endphp

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

        <nav class="flex-1 px-3 py-5 space-y-1.5">

            <a href="{{ route('dashboard') }}" class="sidebar-item">
                <span class="menu-icon">⌂</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('books.index') }}" class="sidebar-item">
                <span class="menu-icon">▤</span>
                <span>Data Buku</span>
            </a>

            <a
                href="{{ route('user.restock.index') }}"
                class="sidebar-item sidebar-active"
                aria-current="page"
            >
                <span class="menu-icon">▧</span>
                <span>Pengajuan Restock</span>
            </a>

            <a
                href="{{ route('user.restock.history') }}"
                class="sidebar-item {{ request()->routeIs('user.restock.history') ? 'sidebar-active' : '' }}"
            >
                <span class="menu-icon">◷</span>
                <span>Riwayat Restock</span>
            </a>

            <a
                href="{{ route('user.restock.history') }}"
                class="sidebar-item"
            >
                <span class="menu-icon">↻</span>
                <span>Status Restock</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="sidebar-item">
                <span class="menu-icon">♙</span>
                <span>Profil</span>
            </a>

        </nav>

        <div class="px-3 pb-5 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="sidebar-item w-full text-left hover:!bg-red-700"
                >
                    <span class="menu-icon">⇥</span>
                    <span>Logout</span>
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
                aria-expanded="true"
            >
                ☰
            </button>

            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 no-underline"
            >
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold brown leading-5">
                        {{ Auth::user()->name ?? 'User' }}
                    </p>

                    <p class="text-xs text-gray-500">User</p>
                </div>

                <div class="user-avatar">
                    @if (Auth::user()?->profile_photo)
                        <img
                            src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                            alt="Foto profil"
                        >
                    @else
                        <span>♙</span>
                    @endif
                </div>
            </a>

        </header>

        <!-- ISI HALAMAN -->
        <section class="content-area p-7 lg:p-8">

            <!-- JUDUL HALAMAN -->
            <div
                class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6"
                style="animation: rise-in .4s both;"
            >
                <div>
                    <p class="text-xs uppercase tracking-wider text-stone-500 mb-2">
                        Sistem Informasi Perpustakaan
                    </p>

                    <h2 class="page-title text-3xl font-bold">
                        Pengajuan Restock
                    </h2>

                    <p class="text-sm text-stone-600 mt-2">
                        Halo,
                        <span class="font-semibold brown">
                            {{ Auth::user()->name ?? 'User' }}
                        </span>.
                        Kelola pengajuan penambahan stok buku di sini.
                    </p>
                </div>

                <div>
                    <p class="text-xs text-stone-500">Hari ini</p>

                    <p class="text-sm font-semibold brown mt-1">
                        {{ now()->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>

            <!-- PESAN BERHASIL -->
            @if (session('success'))
                <div
                    class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
                    role="status"
                >
                    {{ session('success') }}
                </div>
            @endif

            <!-- PESAN ERROR -->
            @if (session('error'))
                <div
                    class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
                    role="alert"
                >
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
                    role="alert"
                >
                    <p class="font-bold mb-2">
                        Ada data yang perlu diperbaiki:
                    </p>

                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- RINGKASAN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">

                <div class="card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">TOTAL PENGAJUAN</p>

                            <h3 class="stat-number">
                                {{ $totalPengajuan }}
                            </h3>

                            <p class="text-xs text-stone-500 mt-2">
                                Semua pengajuan yang kamu kirim
                            </p>
                        </div>

                        <div class="stat-icon">▧</div>
                    </div>
                </div>

                <div class="card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">MENUNGGU</p>

                            <h3 class="stat-number">
                                {{ $totalMenunggu }}
                            </h3>

                            <p class="text-xs text-stone-500 mt-2">
                                Menunggu keputusan admin
                            </p>
                        </div>

                        <div class="stat-icon">◷</div>
                    </div>
                </div>

                <div class="card p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="stat-label">DISETUJUI</p>

                            <h3 class="stat-number">
                                {{ $totalDisetujui }}
                            </h3>

                            <p class="text-xs text-stone-500 mt-2">
                                Pengajuan yang disetujui admin
                            </p>
                        </div>

                        <div class="stat-icon">✓</div>
                    </div>
                </div>

            </div>

            <!-- BANNER DAN TOMBOL -->
            <div class="card p-6 sm:p-8 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div class="flex items-start gap-4">
                        <div class="info-icon">▤</div>

                        <div class="max-w-2xl">
                            <p
                                class="text-xs font-bold uppercase tracking-wider"
                                style="color: var(--orange);"
                            >
                                Layanan Perpustakaan
                            </p>

                            <h3 class="text-xl sm:text-2xl font-bold brown mt-2">
                                Ajukan Penambahan Stok Buku
                            </h3>

                            <p class="text-sm text-stone-600 mt-3 leading-6">
                                Pilih buku dari Data Buku, tentukan jumlah yang
                                dibutuhkan, lalu kirim pengajuan kepada admin
                                untuk ditinjau.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row lg:flex-col gap-3 shrink-0">

                        <a
                            href="{{ route('user.restock.create') }}"
                            class="primary-btn"
                        >
                            <span class="text-lg leading-none">＋</span>
                            Buat Pengajuan
                        </a>

                        <a
                            href="{{ route('user.restock.history') }}"
                            class="secondary-btn"
                        >
                            <span>◷</span>
                            Lihat Riwayat
                        </a>

                    </div>
                </div>
            </div>

            <!-- TABEL PENGAJUAN -->
            <div class="card overflow-hidden">

                <div class="px-5 sm:px-6 py-5 border-b border-stone-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold brown">
                            Daftar Pengajuan Saya
                        </h3>

                        <p class="text-sm text-stone-500 mt-1">
                            Pantau status dan catatan dari admin.
                        </p>
                    </div>

                    <a
                        href="{{ route('user.restock.history') }}"
                        class="soft-link text-sm font-semibold"
                    >
                        Riwayat Lengkap →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px]">

                        <thead class="table-head">
                            <tr class="text-left text-xs uppercase tracking-wide">
                                <th class="px-5 py-4">No</th>
                                <th class="px-5 py-4">Nama Buku</th>
                                <th class="px-5 py-4">Jumlah</th>
                                <th class="px-5 py-4">Tanggal</th>
                                <th class="px-5 py-4">Status</th>
                                <th class="px-5 py-4">Catatan Admin</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($requests as $item)
                                <tr class="border-t border-stone-100 hover:bg-stone-50">

                                    <td class="px-5 py-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-5 py-4 font-semibold brown">
                                        {{ $item->book?->title ?? 'Buku tidak ditemukan' }}
                                    </td>

                                    <td class="px-5 py-4">
                                        {{ $item->jumlah }}
                                    </td>

                                    <td class="px-5 py-4">
                                        {{ $item->created_at?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4">
                                        @if ($item->status === 'menunggu')
                                            <span class="inline-block rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                                Menunggu
                                            </span>
                                        @elseif ($item->status === 'disetujui')
                                            <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Disetujui
                                            </span>
                                        @elseif ($item->status === 'ditolak')
                                            <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="inline-block rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                                {{ ucfirst($item->status ?? 'Belum ada status') }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 text-sm text-stone-600">
                                        {{ $item->catatan_admin ?: '-' }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">

                                            <div class="empty-icon mb-4">
                                                ▤
                                            </div>

                                            <h4 class="font-semibold text-base brown">
                                                Belum ada pengajuan restock
                                            </h4>

                                            <p class="text-sm text-stone-500 mt-2 max-w-md">
                                                Pengajuan yang kamu kirim akan muncul di sini.
                                            </p>

                                            <a
                                                href="{{ route('user.restock.create') }}"
                                                class="primary-btn mt-5"
                                            >
                                                ＋ Buat Pengajuan
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

            <!-- CARA PENGAJUAN -->
            <div class="mt-7 mb-4">
                <h3 class="text-lg font-bold brown">
                    Cara Mengajukan Restock
                </h3>

                <p class="text-sm text-stone-500 mt-1">
                    Ikuti tiga langkah sederhana berikut.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div class="card p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="info-icon">01</div>
                        <h4 class="font-bold brown">Pilih Buku</h4>
                    </div>

                    <p class="text-sm text-stone-600 leading-6">
                        Pilih buku yang terdaftar di Data Buku.
                    </p>
                </div>

                <div class="card p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="info-icon">02</div>
                        <h4 class="font-bold brown">Isi Pengajuan</h4>
                    </div>

                    <p class="text-sm text-stone-600 leading-6">
                        Masukkan jumlah buku dan alasan pengajuan.
                    </p>
                </div>

                <div class="card p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="info-icon">03</div>
                        <h4 class="font-bold brown">Pantau Status</h4>
                    </div>

                    <p class="text-sm text-stone-600 leading-6">
                        Periksa apakah pengajuan menunggu, disetujui, atau ditolak.
                    </p>
                </div>

            </div>

            <footer class="text-center text-xs text-stone-400 mt-7">
                © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
            </footer>

        </section>
    </main>
</div>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    menuToggle?.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            document.body.classList.toggle('mobile-menu-open');

            menuToggle.setAttribute(
                'aria-expanded',
                String(document.body.classList.contains('mobile-menu-open'))
            );
        } else {
            document.body.classList.toggle('sidebar-collapsed');

            menuToggle.setAttribute(
                'aria-expanded',
                String(!document.body.classList.contains('sidebar-collapsed'))
            );
        }
    });

    sidebarBackdrop?.addEventListener('click', () => {
        document.body.classList.remove('mobile-menu-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    document.querySelectorAll('.sidebar a, .sidebar button').forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                document.body.classList.remove('mobile-menu-open');
                menuToggle?.setAttribute('aria-expanded', 'false');
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
</script>

</body>
</html>