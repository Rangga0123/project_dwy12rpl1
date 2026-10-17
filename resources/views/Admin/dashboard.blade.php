<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Book Stock SMKN 5</title>
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
            background: rgba(255,255,255,0.12);
            transform: translateX(4px);
        }

        .card {
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(74,45,30,.12);
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

        .quick-item {
            transition: all .25s ease;
        }

        .quick-item:hover {
            transform: translateX(4px);
            background: #eee3da;
        }

        .school-logo {
            transition: transform .4s cubic-bezier(.34,1.56,.64,1);
        }

        .school-logo:hover {
            transform: scale(1.06) rotate(2deg);
        }

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

        .hamburger:hover {
            background: #f4eee9;
        }

        .sidebar-backdrop {
            display: none;
        }

        /* DESKTOP: SIDEBAR HILANG SEPENUHNYA */
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

        /* RESPONSIVE HP DAN TABLET */
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

            .dashboard-content {
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

    <!-- LAPIS GELAP UNTUK MENU HP -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar min-h-screen text-white shadow-lg flex flex-col">

        <!-- LOGO -->
        <div class="p-6 text-center border-b border-white/15">

            <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-md school-logo overflow-hidden">
                <img
                    src="{{ asset('images/logo-smkn5.png') }}"
                    alt="Logo SMKN 5 Kabupaten Tangerang"
                    class="w-full h-full object-contain"
                >
            </div>

            <h1 class="text-xl font-bold">
                Book Stock
            </h1>

            <p class="text-xs text-white/70 mt-1">
                SMKN 5 Kabupaten Tangerang
            </p>

        </div>

        <!-- MENU ADMIN -->
        <nav class="mt-5 px-3 flex-1">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="menu-item menu-active flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 9.5V21h14V9.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21v-6h6v6"/>
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <!-- DATA BUKU -->
            <a href="{{ route('books.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 17a2 2 0 012-2h12"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6M9 10h5"/>
                </svg>
                <span class="text-sm">Data Buku</span>
            </a>

            <!-- KATEGORI -->
            <a href="{{ route('categories.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"/>
                </svg>
                <span class="text-sm">Kategori Buku</span>
            </a>

            <!-- SUPPLIER -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 21V7l7-4 7 4v14"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21v-5h6v5M9 9h.01M12 9h.01M15 9h.01"/>
                </svg>
                <span class="text-sm">Supplier</span>
            </a>

            <!-- PENGAJUAN RESTOCK -->
            <a href="{{ route('admin.restock.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v4h4M9 12h6M9 15h6"/>
                </svg>
                <span class="text-sm">Pengajuan Restock</span>
            </a>

            <!-- RIWAYAT RESTOCK -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 5h16v14H4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9h8M8 12h8M8 15h5"/>
                </svg>
                <span class="text-sm">Riwayat Restock</span>
            </a>

            <!-- LAPORAN -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 20V10M12 20V4M19 20v-7"/>
                </svg>
                <span class="text-sm">Laporan</span>
            </a>

            <!-- PROFIL -->
            <a href="{{ route('profile.edit') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
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

    <!-- MAIN -->
    <main class="min-h-screen">

        <!-- TOPBAR -->
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
                    <h2 class="text-lg font-bold brown">Dashboard</h2>
                    <p class="text-xs text-gray-500">Selamat datang, {{ Auth::user()->name }}!</p>
                </div>

            </div>

            <!-- PROFIL ADMIN -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3">

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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="3"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 20a7 7 0 0114 0"/>
                        </svg>
                    </div>
                @endif

            </a>

        </header>

        <!-- CONTENT -->
        <section class="dashboard-content p-8 page-enter">

            <!-- STATISTIK -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <p class="text-sm text-gray-500">Total Buku</p>
                    <div class="flex items-end justify-between mt-3">
                        <h3 class="text-3xl font-bold brown stat-number" data-target="{{ $totalBuku ?? 0 }}">0</h3>
                        <span class="text-sm text-gray-400">Buku</span>
                    </div>
                </div>

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <p class="text-sm text-gray-500">Total Stok</p>
                    <div class="flex items-end justify-between mt-3">
                        <h3 class="text-3xl font-bold brown stat-number" data-target="{{ $totalStok ?? 0 }}">0</h3>
                        <span class="text-sm text-gray-400">Unit</span>
                    </div>
                </div>

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <p class="text-sm text-gray-500">Pengajuan Restock</p>
                    <div class="flex items-end justify-between mt-3">
                        <h3 class="text-3xl font-bold brown stat-number" data-target="{{ $totalPengajuan ?? 0 }}">0</h3>
                        <span class="text-sm text-gray-400">Pengajuan</span>
                    </div>
                </div>

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <p class="text-sm text-gray-500">Restock Selesai</p>
                    <div class="flex items-end justify-between mt-3">
                        <h3 class="text-3xl font-bold brown stat-number" data-target="{{ $totalRestockSelesai ?? 0 }}">0</h3>
                        <span class="text-sm text-gray-400">Selesai</span>
                    </div>
                </div>

            </div>

            <!-- BAGIAN BAWAH -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                <!-- RINGKASAN -->
                <div class="xl:col-span-2 bg-white rounded-xl border border-gray-200 p-6 shadow-sm">

                    <div class="mb-6">
                        <h3 class="text-xl font-bold brown">Ringkasan Restock</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Status pengajuan restock buku
                        </p>
                    </div>

                    <!-- MENUNGGU -->
                    <div class="mb-6">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Menunggu</span>
                            <span class="font-semibold">{{ $totalMenunggu ?? 0 }}</span>
                        </div>

                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="progress-bar h-full bg-yellow-400 rounded-full transition-all duration-1000"
                                 style="width:0%" data-width="30%"></div>
                        </div>
                    </div>

                    <!-- DIPROSES -->
                    <div class="mb-6">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Diproses</span>
                            <span class="font-semibold">{{ $totalDiproses ?? 0 }}</span>
                        </div>

                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="progress-bar h-full bg-blue-500 rounded-full transition-all duration-1000"
                                 style="width:0%" data-width="50%"></div>
                        </div>
                    </div>

                    <!-- SELESAI -->
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Selesai</span>
                            <span class="font-semibold">{{ $totalRestockSelesai ?? 0 }}</span>
                        </div>

                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="progress-bar h-full bg-green-500 rounded-full transition-all duration-1000"
                                 style="width:0%" data-width="80%"></div>
                        </div>
                    </div>

                </div>

                <!-- AKSI CEPAT -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">

                    <h3 class="text-xl font-bold brown mb-5">Aksi Cepat</h3>

                    <a href="{{ route('books.create') }}"
                       class="quick-item flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9] mb-3">

                        <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center brown shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold brown">Tambah Buku</p>
                            <p class="text-xs text-gray-500">Menambahkan data buku</p>
                        </div>

                    </a>

                    <a href="{{ route('admin.restock.index') }}"
                       class="quick-item flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9] mb-3">

                        <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center brown shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 15h6"/>
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold brown">Pengajuan Restock</p>
                            <p class="text-xs text-gray-500">Kelola pengajuan restock</p>
                        </div>

                    </a>

                    <a href="#"
                       class="quick-item flex items-center gap-4 p-4 rounded-lg bg-[#f4eee9]">

                        <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center brown shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 20V10M12 20V4M19 20v-7"/>
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold brown">Lihat Laporan</p>
                            <p class="text-xs text-gray-500">Melihat laporan restock</p>
                        </div>

                    </a>

                </div>

            </div>

            <!-- INFORMASI -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mt-6 shadow-sm">
                <h3 class="text-lg font-bold brown mb-2">
                    Book Stock SMKN 5
                </h3>

                <p class="text-sm text-gray-600 leading-relaxed">
                    Sistem ini digunakan untuk membantu pengelolaan
                    data buku, stok buku, pengajuan restock,
                    supplier, serta riwayat penambahan stok
                    perpustakaan SMKN 5 Kabupaten Tangerang.
                </p>
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

    // TUTUP MENU HP SAAT AREA GELAP DIKLIK
    sidebarBackdrop?.addEventListener('click', function () {
        document.body.classList.remove('mobile-menu-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    // TUTUP MENU HP SETELAH MEMILIH MENU
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

    // ANIMASI ANGKA STATISTIK
    document.querySelectorAll('.stat-number').forEach(function (element) {

        const target = parseInt(element.dataset.target, 10) || 0;

        if (target === 0) {
            element.textContent = '0';
            return;
        }

        let current = 0;
        const increment = Math.max(1, Math.ceil(target / 30));

        const timer = setInterval(function () {

            current += increment;

            if (current >= target) {
                element.textContent = target.toLocaleString('id-ID');
                clearInterval(timer);
            } else {
                element.textContent = current.toLocaleString('id-ID');
            }

        }, 30);

    });

    // ANIMASI PROGRESS BAR
    setTimeout(function () {

        document.querySelectorAll('.progress-bar').forEach(function (bar) {
            bar.style.width = bar.dataset.width || '0%';
        });

    }, 200);

    // SAPAAN OTOMATIS
    const greetingEl = document.getElementById('greeting-text');
    const hour = new Date().getHours();
    let greeting = 'Selamat datang kembali, Admin.';

    if (hour >= 4 && hour < 11) {
        greeting = 'Selamat pagi, {{ Auth::user()->name }}. Semangat beraktivitas!';
    } else if (hour >= 11 && hour < 15) {
        greeting = 'Selamat siang, {{ Auth::user()->name }}. Tetap produktif ya!';
    } else if (hour >= 15 && hour < 18) {
        greeting = 'Selamat sore, {{ Auth::user()->name }}. Pekerjaan hampir beres!';
    } else {
        greeting = 'Selamat malam, {{ Auth::user()->name }}. Waktunya istirahat santai.';
    }

    if (greetingEl) {
        greetingEl.textContent = greeting;
    }

});
</script>

</body>
</html>