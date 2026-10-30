<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Book Stock SMKN 5</title>
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

        .menu-item { transition: background .25s ease, transform .25s ease; }
        .menu-item:hover {
            background: rgba(255,255,255,0.12);
            transform: translateX(4px);
        }

        .card { transition: transform .3s ease, box-shadow .3s ease; }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(74,45,30,.12);
        }

        .page-enter { animation: pageEnter .6s cubic-bezier(.16,1,.3,1) forwards; }

        @keyframes pageEnter {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .quick-item { transition: all .25s ease; }
        .quick-item:hover { transform: translateX(4px); background: #eee3da; }

        .school-logo { transition: transform .4s cubic-bezier(.34,1.56,.64,1); }
        .school-logo:hover { transform: scale(1.06) rotate(2deg); }

        /* HAMBURGER */
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
        .hamburger:hover { background: #f4eee9; }

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
            transition: background .2s ease, color .2s ease,
                        transform .2s ease, border-color .2s ease;
        }
        .fullscreen-button:hover {
            background: #f4eee9;
            border-color: #d7c3b5;
            transform: translateY(-1px);
        }
        .fullscreen-button:focus-visible {
            outline: 3px solid rgba(217,107,36,.35);
            outline-offset: 2px;
        }
        .fullscreen-button svg { display: block; width: 22px; height: 22px; }

        .topbar-right { display: flex; align-items: center; gap: 12px; }
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
            body.sidebar-hidden .sidebar { transform: translateX(-100%); }
            body.sidebar-hidden main { margin-left: 0 !important; width: 100%; }
            body:not(.sidebar-hidden) main { margin-left: 256px; width: calc(100% - 256px); }
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
            body.mobile-menu-open .sidebar { transform: translateX(0); }
            body main { margin-left: 0 !important; width: 100%; }

            .sidebar-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.4);
                z-index: 30;
            }
            body.mobile-menu-open .sidebar-backdrop { display: block; }

            .dashboard-content { padding: 20px !important; }
            .topbar { padding: 16px !important; }
        }

        @media (max-width: 480px) {
            .topbar { gap: 8px; }
            .topbar-right { gap: 7px; }
            .fullscreen-button { width: 36px; height: 36px; }
            .fullscreen-button svg { width: 20px; height: 20px; }
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
<div class="min-h-screen">

    <!-- BACKDROP MENU HP -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- ===================== SIDEBAR ===================== -->
    <aside class="sidebar min-h-screen text-white shadow-lg flex flex-col">

        <div class="p-6 text-center border-b border-white/15">
            <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-md school-logo overflow-hidden">
                <img src="{{ asset('images/logo-smkn5.png') }}"
                     alt="Logo SMKN 5 Kabupaten Tangerang"
                     class="w-full h-full object-contain">
            </div>

            <h1 class="text-xl font-bold">Book Stock N5</h1>
            <p class="text-xs text-white/70 mt-1">SMKN 5 Kabupaten Tangerang</p>
        </div>

        <!-- MENU ADMIN -->
        <nav class="mt-5 px-3 flex-1">

            <a href="{{ route('dashboard') }}"
               class="menu-item {{ request()->routeIs('dashboard') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 9.5V21h14V9.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21v-6h6v6"/>
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="{{ route('books.index') }}"
               class="menu-item {{ request()->routeIs('books.*') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 17a2 2 0 012-2h12"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6M9 10h5"/>
                </svg>
                <span class="text-sm">Data Buku</span>
            </a>

            <a href="{{ route('categories.index') }}"
               class="menu-item {{ request()->routeIs('categories.*') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"/>
                </svg>
                <span class="text-sm">Kategori Buku</span>
            </a>

            {{-- Pengajuan Restock: tidak aktif saat sedang di halaman Laporan Restock --}}
            <a href="{{ route('admin.restock.index') }}"
               class="menu-item {{ request()->routeIs('admin.restock.*') && !request()->routeIs('admin.restock.report') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v4h4M9 12h6M9 15h6"/>
                </svg>
                <span class="text-sm">Pengajuan Restock</span>
            </a>

            {{-- Laporan Restock --}}
            <a href="{{ route('admin.restock.report') }}"
               class="menu-item {{ request()->routeIs('admin.restock.report') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16v-5M12 16V6M17 16v-3"/>
                </svg>
                <span class="text-sm">Laporan Restock</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="menu-item {{ request()->routeIs('profile.*') ? 'menu-active' : '' }} flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="3"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 20a7 7 0 0114 0"/>
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
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5M15 12H3"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 19V5a2 2 0 00-2-2h-5"/>
                    </svg>
                    <span class="text-sm">Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- ===================== MAIN ===================== -->
    <main class="min-h-screen">

        <!-- TOPBAR -->
        <header class="topbar bg-white border-b border-gray-200 px-8 py-5 flex justify-between items-center sticky top-0 z-20 shadow-sm">

            <div class="flex items-center gap-4">
                <button type="button" id="menuToggle" class="hamburger"
                        aria-label="Buka atau tutup menu" aria-expanded="true">
                    ☰
                </button>

                <div>
                    <h2 class="text-lg font-bold brown">@yield('title', 'Dashboard')</h2>
                    <p class="text-xs text-gray-500">
                        @hasSection('subtitle')
                            @yield('subtitle')
                        @else
                            Selamat datang, {{ Auth::user()->name }}!
                        @endif
                    </p>
                </div>
            </div>

            <!-- FULLSCREEN DAN PROFIL -->
            <div class="topbar-right">

                <button type="button" id="fullscreenToggle" class="fullscreen-button"
                        aria-label="Masuk layar penuh" aria-pressed="false" title="Masuk layar penuh">
                    <svg id="fullscreenIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.8" stroke-linecap="square" stroke-linejoin="miter" aria-hidden="true">
                        <path d="M3 9V3H9"/>
                        <path d="M3 3L9 9"/>
                        <path d="M15 3H21V9"/>
                        <path d="M21 3L15 9"/>
                        <path d="M3 15V21H9"/>
                        <path d="M3 21L9 15"/>
                        <path d="M21 15V21H15"/>
                        <path d="M21 21L15 15"/>
                    </svg>
                </button>

                <!-- PROFIL ADMIN -->
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">
                            {{ Auth::user()->role === 'admin' ? 'Administrator' : 'User' }}
                        </p>
                    </div>

                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                             alt="Foto Profil"
                             class="w-10 h-10 rounded-full object-cover border-2 border-[#6b3f28]">
                    @else
                        <div class="w-10 h-10 rounded-full bg-[#f4eee9] brown flex items-center justify-center shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="3"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 20a7 7 0 0114 0"/>
                            </svg>
                        </div>
                    @endif
                </a>
            </div>
        </header>

        <!-- ISI HALAMAN -->
        @yield('content')

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.getElementById('menuToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    /* HAMBURGER DESKTOP DAN HP */
    menuToggle?.addEventListener('click', function () {
        if (window.innerWidth < 1024) {
            document.body.classList.toggle('mobile-menu-open');
            menuToggle.setAttribute('aria-expanded',
                String(document.body.classList.contains('mobile-menu-open')));
        } else {
            document.body.classList.toggle('sidebar-hidden');
            menuToggle.setAttribute('aria-expanded',
                String(!document.body.classList.contains('sidebar-hidden')));
        }
    });

    /* TUTUP MENU HP */
    sidebarBackdrop?.addEventListener('click', function () {
        document.body.classList.remove('mobile-menu-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    document.querySelectorAll('.sidebar a, .sidebar button').forEach(function (item) {
        item.addEventListener('click', function () {
            if (window.innerWidth < 1024) {
                document.body.classList.remove('mobile-menu-open');
                menuToggle?.setAttribute('aria-expanded', 'false');
            }
        });
    });

    /* RESET SIDEBAR SAAT UKURAN LAYAR BERUBAH */
    window.addEventListener('resize', function () {
        document.body.classList.remove('mobile-menu-open', 'sidebar-hidden');
        menuToggle?.setAttribute('aria-expanded', 'true');
    });

    /* FITUR FULLSCREEN */
    const fullscreenToggle = document.getElementById('fullscreenToggle');
    const fullscreenIcon = document.getElementById('fullscreenIcon');

    function updateFullscreenButton() {
        const isFullscreen = Boolean(document.fullscreenElement);
        if (!fullscreenToggle || !fullscreenIcon) return;

        fullscreenToggle.title = isFullscreen ? 'Keluar layar penuh' : 'Masuk layar penuh';
        fullscreenToggle.setAttribute('aria-label', fullscreenToggle.title);
        fullscreenToggle.setAttribute('aria-pressed', String(isFullscreen));

        if (isFullscreen) {
            fullscreenIcon.innerHTML = `
                <path d="M3 3L9 9 M9 3V9H3"/>
                <path d="M21 3L15 9 M15 3V9H21"/>
                <path d="M3 21L9 15 M9 21V15H3"/>
                <path d="M21 21L15 15 M15 21V15H21"/>
            `;
        } else {
            fullscreenIcon.innerHTML = `
                <path d="M9 3H3V9 M3 3L9 9"/>
                <path d="M15 3H21V9 M21 3L15 9"/>
                <path d="M3 15V21H9 M3 21L9 15"/>
                <path d="M21 15V21H15 M21 21L15 15"/>
            `;
        }
    }

    fullscreenToggle?.addEventListener('click', async function () {
        try {
            if (!document.fullscreenElement) {
                await document.documentElement.requestFullscreen();
            } else {
                await document.exitFullscreen();
            }
        } catch (error) {
            console.error('Gagal mengubah mode layar penuh:', error);
        }
    });

    document.addEventListener('fullscreenchange', updateFullscreenButton);
    updateFullscreenButton();
});
</script>

@stack('scripts')

</body>
</html>