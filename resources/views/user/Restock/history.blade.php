<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Restock - Book Stock SMKN 5</title>

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
            box-shadow: 0 4px 12px rgba(0,0,0,.1);
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
            text-decoration: none;
            transition: background .18s ease, transform .18s ease;
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

        .topbar {
            height: 76px;
            background: #fff;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 20;
        }

        .brown { color: var(--brown); }

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

        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 2px 7px rgba(55,35,24,.035);
        }

        .table-head {
            background: #f8f5f2;
            color: var(--brown);
        }

        .status-badge {
            display: inline-block;
            border-radius: 999px;
            padding: 5px 11px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-menunggu {
            background: #ffedd5;
            color: #c2410c;
        }

        .status-disetujui {
            background: #dcfce7;
            color: #15803d;
        }

        .status-ditolak {
            background: #fee2e2;
            color: #b91c1c;
        }

        .sidebar-backdrop { display: none; }

        @keyframes rise-in {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .page-content {
            animation: rise-in .4s ease both;
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
<div class="flex min-h-screen">

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar min-h-screen flex flex-col">

        <div class="brand-area px-5 py-6 text-center">
            <div class="brand-logo mx-auto mb-3">
                <img src="{{ asset('images/logo-smkn5.png') }}"
                     alt="Logo SMKN 5 Kabupaten Tangerang">
            </div>

            <div class="brand-copy">
                <h1 class="text-lg font-bold tracking-tight leading-tight">
                    Book Stock SMKN 5
                </h1>
                <p class="text-xs text-white/75 mt-2">Sistem Restock Buku</p>
                <p class="text-xs text-white/75 mt-1">Perpustakaan</p>
            </div>
        </div>

        <!-- MENU USER -->
        <nav class="flex-1 px-3 py-5 space-y-1.5">

            <a href="{{ route('dashboard') }}" class="sidebar-item">
                <span class="menu-icon">⌂</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('books.index') }}" class="sidebar-item">
                <span class="menu-icon">▤</span>
                <span>Data Buku</span>
            </a>

            <a href="{{ route('user.restock.create') }}" class="sidebar-item">
                <span class="menu-icon">▧</span>
                <span>Pengajuan Restock</span>
            </a>

            <a href="{{ route('user.restock.history') }}"
               class="sidebar-item sidebar-active"
               aria-current="page">
                <span class="menu-icon">◷</span>
                <span>Riwayat Restock</span>
            </a>

            <a href="{{ route('user.restock.history') }}" class="sidebar-item">
                <span class="menu-icon">↻</span>
                <span>Status Restock</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="sidebar-item">
                <span class="menu-icon">♙</span>
                <span>Profil</span>
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="px-3 pb-5 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="sidebar-item w-full text-left hover:!bg-red-700">
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

            <button type="button"
                    id="menuToggle"
                    class="hamburger text-2xl"
                    aria-label="Buka atau tutup menu"
                    aria-expanded="true">
                ☰
            </button>

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
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                             alt="Foto profil">
                    @else
                        <span>♙</span>
                    @endif
                </div>
            </a>

        </header>

        <!-- RIWAYAT RESTOCK -->
        <section class="content-area p-7 lg:p-8 page-content">

            <div class="mb-6">
                <h2 class="text-3xl font-bold brown tracking-tight">
                    Riwayat Restock
                </h2>
                <p class="text-sm text-stone-500 mt-2">
                    Lihat semua pengajuan restock yang pernah Anda kirim.
                </p>
            </div>

            @if (session('success'))
                <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card overflow-hidden">

                <div class="px-5 sm:px-6 py-5 border-b border-stone-200
                            flex flex-col sm:flex-row sm:items-center
                            sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold brown">
                            Daftar Pengajuan Restock
                        </h3>
                        <p class="text-sm text-stone-500 mt-1">
                            Riwayat pengajuan yang telah Anda buat.
                        </p>
                    </div>

                    <a href="{{ route('user.restock.create') }}"
                       class="inline-flex items-center justify-center px-4 py-2.5
                              rounded-lg bg-[#70432d] text-white text-sm font-semibold
                              hover:bg-[#5d3523] transition">
                        + Pengajuan Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[850px] text-sm">

                        <thead class="table-head">
                            <tr class="text-left text-xs uppercase tracking-wide">
                                <th class="px-4 py-4">No</th>
                                <th class="px-4 py-4">Buku</th>
                                <th class="px-4 py-4">Jumlah</th>
                                <th class="px-4 py-4">Alasan</th>
                                <th class="px-4 py-4">Tanggal</th>
                                <th class="px-4 py-4">Status</th>
                                <th class="px-4 py-4">Catatan Admin</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-stone-100">

                            @forelse ($requests as $request)
                                <tr class="hover:bg-stone-50 transition-colors">

                                    <td class="px-4 py-4 text-stone-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-4 py-4 font-semibold brown">
                                        {{ $request->book->title ?? 'Buku tidak ditemukan' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $request->jumlah }}
                                        buku
                                    </td>

                                    <td class="px-4 py-4 text-stone-600">
                                        {{ $request->alasan ?: '-' }}
                                    </td>

                                    <td class="px-4 py-4 text-stone-600 whitespace-nowrap">
                                        {{ $request->created_at?->format('d/m/Y H:i') ?? '-' }}
                                    </td>

                                    <td class="px-4 py-4">
                                        @if ($request->status === 'menunggu')
                                            <span class="status-badge status-menunggu">
                                                Menunggu
                                            </span>
                                        @elseif ($request->status === 'disetujui')
                                            <span class="status-badge status-disetujui">
                                                Disetujui
                                            </span>
                                        @else
                                            <span class="status-badge status-ditolak">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-4 text-stone-600">
                                        {{ $request->catatan_admin ?: '-' }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-14 text-center">
                                        <div class="text-3xl mb-3">▤</div>
                                        <p class="font-semibold brown">
                                            Belum ada pengajuan restock
                                        </p>
                                        <p class="text-sm text-stone-500 mt-2">
                                            Pengajuan yang kamu buat akan muncul di sini.
                                        </p>
                                        <a href="{{ route('user.restock.create') }}"
                                           class="inline-flex mt-5 px-4 py-2.5 rounded-lg
                                                  bg-[#70432d] text-white text-sm font-semibold
                                                  hover:bg-[#5d3523] transition">
                                            + Ajukan Restock
                                        </a>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
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

    document.querySelectorAll('.sidebar .sidebar-item').forEach((item) => {
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
</script>

</body>
</html>