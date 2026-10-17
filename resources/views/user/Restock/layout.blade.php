<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Pengajuan Restock') - Book Stock SMKN 5</title>

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
            background: white;
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
            text-decoration: none;
            transition: background .18s ease, transform .18s ease;
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

        /* HEADER */
        .topbar {
            height: 76px;
            background: white;
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

        /* CARD */
        .card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 2px 7px rgba(55,35,24,.035);
            transition: transform .2s ease,
                        box-shadow .2s ease,
                        border-color .2s ease;
            animation: rise-in .45s both;
        }

        .card:hover {
            box-shadow: 0 7px 18px rgba(55,35,24,.075);
            border-color: #ddc9ba;
        }

        .soft-link {
            color: var(--brown);
            text-decoration: none;
            transition: color .18s ease;
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

        /* DESKTOP */
        @media (min-width: 1024px) {
            body.sidebar-collapsed .sidebar {
                width: 0;
                min-width: 0;
                overflow: hidden;
                border: none;
            }

            body.sidebar-collapsed .sidebar > * {
                visibility: hidden;
            }
        }

        /* HP DAN TABLET */
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

    @stack('styles')
</head>

<body>

<div class="flex min-h-screen">

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    {{-- SIDEBAR --}}
    <aside class="sidebar min-h-screen flex flex-col">

        <div class="brand-area px-5 py-6 text-center">

            <div class="brand-logo mx-auto mb-3">
                <img
                    src="{{ asset('images/logo-smkn5.png') }}"
                    alt="Logo SMKN 5 Kabupaten Tangerang">
            </div>

            <div>
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

        {{-- MENU USER --}}
        <nav class="flex-1 px-3 py-5 space-y-1.5">

            <a href="{{ route('dashboard') }}"
               class="sidebar-item">
                <span class="menu-icon">⌂</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('books.index') }}"
               class="sidebar-item">
                <span class="menu-icon">▤</span>
                <span>Data Buku</span>
            </a>

            <a href="{{ route('user.restock.index') }}"
               class="sidebar-item {{ request()->routeIs('user.restock.index') || request()->routeIs('user.restock.create') ? 'sidebar-active' : '' }}"
               @if(request()->routeIs('user.restock.index') || request()->routeIs('user.restock.create')) aria-current="page" @endif>
                <span class="menu-icon">▧</span>
                <span>Pengajuan Restock</span>
            </a>

            <a href="{{ route('user.restock.history') }}"
               class="sidebar-item {{ request()->routeIs('user.restock.history') ? 'sidebar-active' : '' }}">
                <span class="menu-icon">◷</span>
                <span>Riwayat Restock</span>
            </a>

            <a href="{{ route('user.restock.history') }}"
               class="sidebar-item">
                <span class="menu-icon">↻</span>
                <span>Status Restock</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="sidebar-item">
                <span class="menu-icon">♙</span>
                <span>Profil</span>
            </a>

        </nav>

        {{-- LOGOUT --}}
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

    {{-- AREA KONTEN --}}
    <main class="flex-1 min-w-0">

        {{-- HEADER --}}
        <header class="topbar flex items-center justify-between px-7">

            <button
                type="button"
                id="menuToggle"
                class="hamburger text-2xl"
                aria-label="Buka atau tutup menu"
                aria-expanded="true">
                ☰
            </button>

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

        </header>

        {{-- KONTEN SETIAP HALAMAN DIMASUKKAN DI SINI --}}
        <section class="content-area p-7 lg:p-8">

            @yield('content')

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

@stack('scripts')

</body>
</html>