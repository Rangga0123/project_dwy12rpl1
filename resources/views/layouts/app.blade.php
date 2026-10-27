<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Book Stock SMKN 5') }}</title>

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
            background: rgba(255, 255, 255, .12);
            transform: translateX(4px);
        }

        .page-enter {
            animation: pageEnter .5s ease forwards;
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

        .school-logo {
            transition: transform .3s ease;
        }

        .school-logo:hover {
            transform: scale(1.05);
        }

        /* TOMBOL HAMBURGER */
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

        .hamburger:hover {
            background: #f4eee9;
        }

        /* TOMBOL FULLSCREEN */
        .fullscreen-button {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
            background: white;
            color: #6b3f28;
            cursor: pointer;
            transition: background .2s ease,
                        color .2s ease,
                        transform .2s ease,
                        border-color .2s ease;
        }

        .fullscreen-button:hover {
            background: #f4eee9;
            border-color: #d7c3b5;
            transform: translateY(-1px);
        }

        .fullscreen-button:focus-visible {
            outline: 3px solid rgba(217, 107, 36, .35);
            outline-offset: 2px;
        }

        .fullscreen-button svg {
            display: block;
            width: 22px;
            height: 22px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .sidebar-backdrop {
            display: none;
        }

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

            body.sidebar-hidden .app-main {
                margin-left: 0 !important;
                width: 100% !important;
            }

            body:not(.sidebar-hidden) .app-main {
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

            body .app-main {
                margin-left: 0 !important;
                width: 100% !important;
            }

            .sidebar-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .4);
                z-index: 30;
            }

            body.mobile-menu-open .sidebar-backdrop {
                display: block;
            }

            .dashboard-content {
                padding: 20px !important;
            }

            .topbar {
                padding: 16px !important;
                gap: 8px;
            }

            .page-content {
                padding: 20px !important;
            }
        }

        @media (max-width: 480px) {
            .topbar {
                padding: 12px !important;
            }

            .topbar-right {
                gap: 7px;
            }

            .fullscreen-button,
            .hamburger {
                width: 36px;
                height: 36px;
            }

            .fullscreen-button svg {
                width: 20px;
                height: 20px;
            }

            .page-content {
                padding: 14px !important;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
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

    <!-- SIDEBAR -->
    <aside class="sidebar min-h-screen text-white fixed left-0 top-0 z-20 shadow-lg flex flex-col">

        <!-- LOGO DAN NAMA APLIKASI -->
        <div class="p-6 text-center border-b border-white/15">
            <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-md school-logo overflow-hidden">
                <img
                    src="{{ asset('images/logo-smkn5.png') }}"
                    alt="Logo SMKN 5 Kabupaten Tangerang"
                    class="w-full h-full object-contain"
                >
            </div>

            <h1 class="text-xl font-bold">Book Stock</h1>

            <p class="text-xs text-white/70 mt-1">
                SMKN 5 Kabupaten Tangerang
            </p>
        </div>

        <!-- MENU NAVIGASI -->
        <nav class="mt-5 px-3 flex-1">

            <!-- DASHBOARD -->
            <a
                href="{{ route('dashboard') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
                {{ request()->routeIs('dashboard') ? 'menu-active' : '' }}"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 10.5L12 3l9 7.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 9.5V21h14V9.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 21v-6h6v6"/>
                </svg>

                <span class="text-sm">Dashboard</span>
            </a>

            <!-- DATA BUKU -->
            <a
                href="{{ route('books.index') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
                {{ request()->routeIs('books.*') ? 'menu-active' : '' }}"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 17a2 2 0 012-2h12"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 7h6M9 10h5"/>
                </svg>

                <span class="text-sm">Data Buku</span>
            </a>

            <!-- KATEGORI BUKU -->
            <a
                href="{{ route('categories.index') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
                {{ request()->routeIs('categories.*') ? 'menu-active' : '' }}"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 17.5v-11z"/>
                </svg>

                <span class="text-sm">Kategori Buku</span>
            </a>

            <!-- PENGAJUAN RESTOCK -->
            <a
                href="{{ route('user.restock.create') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
                {{ request()->routeIs('user.restock.create') ? 'menu-active' : '' }}"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 3h9l3 3v15H6V3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14 3v4h4M9 12h6M9 15h6"/>
                </svg>

                <span class="text-sm">Pengajuan Restock</span>
            </a>

            <!-- RIWAYAT RESTOCK -->
            <a
                href="{{ route('user.restock.history') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
                {{ request()->routeIs('user.restock.history') ? 'menu-active' : '' }}"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 5h16v14H4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 9h8M8 12h8M8 15h5"/>
                </svg>

                <span class="text-sm">Riwayat Restock</span>
            </a>

            <!-- LAPORAN -->
            <a
                href="#"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 20V10M12 20V4M19 20v-7"/>
                </svg>

                <span class="text-sm">Laporan</span>
            </a>

            <!-- PROFIL -->
            <a
                href="{{ route('profile.edit') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
                {{ request()->routeIs('profile.*') ? 'menu-active' : '' }}"
            >
                <svg class="w-5 h-5 flex-shrink-0"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">
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

                <button
                    type="submit"
                    class="menu-item w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600/80 text-left"
                >
                    <svg class="w-5 h-5 flex-shrink-0"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24">
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

    <!-- AREA KONTEN UTAMA -->
    <div class="app-main min-h-screen">

        <!-- TOPBAR -->
        <header class="topbar bg-white border-b border-gray-200 px-8 py-5 flex justify-between items-center sticky top-0 z-20 shadow-sm">

            <!-- JUDUL DAN HAMBURGER -->
            <div class="flex items-center gap-4 min-w-0">
                <button
                    type="button"
                    id="menuToggle"
                    class="hamburger"
                    aria-label="Buka atau tutup menu"
                    aria-expanded="true"
                >
                    ☰
                </button>

                <div class="min-w-0">
                    <h2 class="text-xl font-bold brown">
                        {{ $pageTitle ?? 'Dashboard' }}
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        {{ $pageDescription ?? 'Selamat datang di Book Stock SMKN 5 Kabupaten Tangerang' }}
                    </p>
                </div>
            </div>

            <!-- TOMBOL FULLSCREEN DAN PROFIL -->
            <div class="topbar-right">

                <button
                    type="button"
                    id="fullscreenToggle"
                    class="fullscreen-button"
                    aria-label="Masuk layar penuh"
                    aria-pressed="false"
                    title="Masuk layar penuh"
                >
                    <svg
                        id="fullscreenIcon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M8 3H5a2 2 0 00-2 2v3"/>
                        <path d="M16 3h3a2 2 0 012 2v3"/>
                        <path d="M3 16v3a2 2 0 002 2h3"/>
                        <path d="M21 16v3a2 2 0 01-2 2h-3"/>
                    </svg>
                </button>

                <!-- PROFIL PENGGUNA -->
                <a
                    href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 min-w-0"
                >
                    <div class="text-right hidden sm:block">
                        <p class="font-semibold text-gray-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ auth()->user()->role === 'admin' ? 'Administrator' : 'Pengguna' }}
                        </p>
                    </div>

                    @if(auth()->user()->profile_photo)
                        <img
                            src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                            alt="Foto Profil"
                            class="w-10 h-10 rounded-full object-cover border-2 border-[#6b3f28]"
                        >
                    @else
                        <div class="w-10 h-10 rounded-full bg-[#f4eee9] brown flex items-center justify-center">
                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <circle cx="12" cy="8" r="3"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 20a7 7 0 0114 0"/>
                            </svg>
                        </div>
                    @endif
                </a>

            </div>
        </header>

        <!-- KONTEN HALAMAN -->
        <main class="page-content p-8 page-enter">
            @yield('content')
        </main>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.getElementById('menuToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const fullscreenToggle = document.getElementById('fullscreenToggle');
    const fullscreenIcon = document.getElementById('fullscreenIcon');

    /*
    |--------------------------------------------------------------------------
    | HAMBURGER DESKTOP DAN HP
    |--------------------------------------------------------------------------
    */
    menuToggle?.addEventListener('click', function () {

        if (window.innerWidth < 1024) {
            document.body.classList.toggle('mobile-menu-open');

            menuToggle.setAttribute(
                'aria-expanded',
                String(document.body.classList.contains('mobile-menu-open'))
            );

        } else {
            document.body.classList.toggle('sidebar-hidden');

            menuToggle.setAttribute(
                'aria-expanded',
                String(!document.body.classList.contains('sidebar-hidden'))
            );
        }
    });

    /*
    |--------------------------------------------------------------------------
    | TUTUP SIDEBAR KETIKA BACKDROP DIKLIK
    |--------------------------------------------------------------------------
    */
    sidebarBackdrop?.addEventListener('click', function () {
        document.body.classList.remove('mobile-menu-open');

        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    /*
    |--------------------------------------------------------------------------
    | TUTUP MENU HP SETELAH MEMILIH MENU
    |--------------------------------------------------------------------------
    */
    document.querySelectorAll('.sidebar a, .sidebar button').forEach(function (item) {

        item.addEventListener('click', function () {

            if (window.innerWidth < 1024) {
                document.body.classList.remove('mobile-menu-open');

                menuToggle?.setAttribute('aria-expanded', 'false');
            }
        });
    });

    /*
    |--------------------------------------------------------------------------
    | ATUR ULANG SIDEBAR KETIKA UKURAN LAYAR BERUBAH
    |--------------------------------------------------------------------------
    */
    window.addEventListener('resize', function () {

        document.body.classList.remove('mobile-menu-open', 'sidebar-hidden');

        menuToggle?.setAttribute('aria-expanded', 'true');
    });

    /*
    |--------------------------------------------------------------------------
    | FITUR FULLSCREEN
    |--------------------------------------------------------------------------
    */
    function updateFullscreenButton() {

        if (!fullscreenToggle || !fullscreenIcon) {
            return;
        }

        const isFullscreen = Boolean(document.fullscreenElement);

        fullscreenToggle.title = isFullscreen
            ? 'Keluar layar penuh'
            : 'Masuk layar penuh';

        fullscreenToggle.setAttribute(
            'aria-label',
            fullscreenToggle.title
        );

        fullscreenToggle.setAttribute(
            'aria-pressed',
            String(isFullscreen)
        );

        if (isFullscreen) {

            /* IKON KELUAR FULLSCREEN */
            fullscreenIcon.innerHTML = `
                <path d="M9 3v6H3"/>
                <path d="M3 9l6-6"/>

                <path d="M15 3v6h6"/>
                <path d="M21 9l-6-6"/>

                <path d="M9 21v-6H3"/>
                <path d="M3 15l6 6"/>

                <path d="M15 21v-6h6"/>
                <path d="M21 15l-6 6"/>
            `;

        } else {

            /* IKON MASUK FULLSCREEN */
            fullscreenIcon.innerHTML = `
                <path d="M8 3H5a2 2 0 00-2 2v3"/>
                <path d="M16 3h3a2 2 0 012 2v3"/>
                <path d="M3 16v3a2 2 0 002 2h3"/>
                <path d="M21 16v3a2 2 0 01-2 2h-3"/>
            `;
        }
    }

    fullscreenToggle?.addEventListener('click', async function () {

        try {

            if (!document.fullscreenElement) {

                if (document.documentElement.requestFullscreen) {
                    await document.documentElement.requestFullscreen();
                }

            } else {

                if (document.exitFullscreen) {
                    await document.exitFullscreen();
                }
            }

        } catch (error) {

            console.error(
                'Gagal mengubah mode layar penuh:',
                error
            );

        }
    });

    /*
    |--------------------------------------------------------------------------
    | PERBARUI IKON JIKA FULLSCREEN DIKELUARKAN DENGAN TOMBOL ESC
    |--------------------------------------------------------------------------
    */
    document.addEventListener(
        'fullscreenchange',
        updateFullscreenButton
    );

    updateFullscreenButton();

});
</script>

</body>
</html>