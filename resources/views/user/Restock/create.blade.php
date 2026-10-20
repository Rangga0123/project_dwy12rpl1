<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buat Pengajuan Restock - Book Stock SMKN 5</title>
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

        a, button { -webkit-tap-highlight-color: transparent; }

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

        .brand-area { border-bottom: 1px solid rgba(255,255,255,.16); }

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

        .sidebar-active:hover { background: #c95e1b; }

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
            animation: rise-in .4s both;
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

        .hamburger:hover { background: #f5eee8; }

        .sidebar-backdrop { display: none; }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            background: var(--brown);
            color: white;
            border: 1px solid var(--brown);
            border-radius: 8px;
            padding: 12px 18px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s ease, transform .2s ease;
        }

        .primary-btn:hover {
            background: var(--brown-dark);
            transform: translateY(-1px);
        }

        .primary-btn:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
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
            cursor: pointer;
        }

        .secondary-btn:hover { background: #eee1d7; }

        .form-label {
            display: block;
            color: #44403c;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-control {
            display: block;
            width: 100%;
            min-height: 46px;
            border: 1px solid #ded6d0;
            border-radius: 8px;
            background: white;
            padding: 11px 13px;
            color: #292524;
            font-size: 14px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .form-control:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(217,107,36,.12);
        }

        .form-control::placeholder { color: #a8a29e; }

        textarea.form-control {
            min-height: 125px;
            resize: vertical;
        }

        .field-error {
            color: #b91c1c;
            font-size: 12px;
            margin-top: 6px;
        }

        .section-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: #f5eee8;
            color: var(--brown);
            font-size: 21px;
            flex-shrink: 0;
        }

        .notice {
            border: 1px solid #eaded5;
            background: #faf6f2;
            border-radius: 9px;
            padding: 14px;
        }

        @keyframes rise-in {
            from { opacity: 0; transform: translateY(9px); }
            to { opacity: 1; transform: translateY(0); }
        }

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

            .content-area { padding: 24px 18px !important; }

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

            <h1 class="text-lg font-bold tracking-tight leading-tight">
                Book Stock SMKN 5
            </h1>

            <p class="text-xs text-white/75 mt-2">Sistem Restock Buku</p>
            <p class="text-xs text-white/75 mt-1">Perpustakaan</p>
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

            <a href="{{ route('user.restock.history') }}" class="sidebar-item">
                <span class="menu-icon">◷</span>
                <span>Riwayat Restock</span>
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

            <!-- JUDUL -->
            <div class="mb-6" style="animation: rise-in .4s both;">

                <a
                    href="{{ route('user.restock.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold brown mb-4 hover:underline"
                >
                    <span>←</span>
                    Kembali ke Pengajuan Restock
                </a>

                <p class="text-xs uppercase tracking-wider text-stone-500 mb-2">
                    Sistem Informasi Perpustakaan
                </p>

                <h2 class="page-title text-3xl font-bold">
                    Buat Pengajuan Restock
                </h2>

                <p class="text-sm text-stone-600 mt-2 leading-6">
                    Halo, <strong class="brown">{{ Auth::user()->name ?? 'User' }}</strong>.
                    Lengkapi formulir berikut untuk mengajukan penambahan stok buku.
                </p>
            </div>

            <!-- ERROR VALIDASI -->
            @if ($errors->any())
                <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-800" role="alert">
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

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                <!-- FORMULIR -->
                <div class="xl:col-span-2">

                    <div class="card overflow-hidden">

                        <div class="px-5 sm:px-7 py-5 border-b border-stone-200">
                            <div class="flex items-center gap-3">
                                <div class="section-icon">▤</div>

                                <div>
                                    <h3 class="text-lg font-bold brown">
                                        Informasi Pengajuan
                                    </h3>

                                    <p class="text-sm text-stone-500 mt-1">
                                        Isi semua kolom yang wajib diisi.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form
                            action="{{ route('user.restock.store') }}"
                            method="POST"
                            id="restockForm"
                        >
                            @csrf

                            <div class="p-5 sm:p-7 space-y-6">

                                <!-- PILIH BUKU -->
                                <div>
                                    <label for="book_id" class="form-label">
                                        Pilih Buku
                                        <span class="text-red-600">*</span>
                                    </label>

                                    <select
                                        id="book_id"
                                        name="book_id"
                                        required
                                        class="form-control"
                                    >
                                        <option value="">-- Pilih Buku --</option>

                                        @forelse ($books as $book)
                                            <option
                                                value="{{ $book->id }}"
                                                data-title="{{ $book->title }}"
                                                data-stock="{{ $book->stock ?? 0 }}"
                                                {{ (string) old('book_id') === (string) $book->id ? 'selected' : '' }}
                                            >
                                                {{ $book->title }}
                                                — Stok: {{ $book->stock ?? 0 }}
                                            </option>
                                        @empty
                                            <option value="" disabled>
                                                Belum ada data buku
                                            </option>
                                        @endforelse
                                    </select>

                                    @error('book_id')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror

                                    <p class="text-xs text-stone-500 mt-2">
                                        Pilih buku yang ingin ditambah stoknya.
                                    </p>

                                    <div id="selectedBookInfo" class="notice mt-3 hidden">
                                        <p class="text-xs text-stone-500">
                                            Buku yang dipilih
                                        </p>

                                        <p id="selectedBookTitle" class="font-bold brown mt-1"></p>

                                        <p class="text-sm text-stone-600 mt-2">
                                            Stok saat ini:
                                            <strong id="selectedBookStock">0</strong>
                                        </p>
                                    </div>
                                </div>

                                <!-- JUMLAH -->
                                <div>
                                    <label for="jumlah" class="form-label">
                                        Jumlah Buku yang Diajukan
                                        <span class="text-red-600">*</span>
                                    </label>

                                    <input
                                        type="number"
                                        id="jumlah"
                                        name="jumlah"
                                        min="1"
                                        step="1"
                                        value="{{ old('jumlah', 1) }}"
                                        required
                                        placeholder="Masukkan jumlah buku"
                                        class="form-control"
                                    >

                                    @error('jumlah')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror

                                    <p class="text-xs text-stone-500 mt-2">
                                        Masukkan jumlah buku yang dibutuhkan. Minimal 1 buku.
                                    </p>
                                </div>

                                <!-- ALASAN -->
                                <div>
                                    <label for="alasan" class="form-label">
                                        Alasan Pengajuan
                                        <span class="text-stone-400 font-normal">
                                            (Opsional)
                                        </span>
                                    </label>

                                    <textarea
                                        id="alasan"
                                        name="alasan"
                                        rows="4"
                                        maxlength="1000"
                                        placeholder="Contoh: Stok buku mulai menipis dan masih dibutuhkan oleh siswa."
                                        class="form-control"
                                    >{{ old('alasan') }}</textarea>

                                    @error('alasan')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror

                                    <div class="flex justify-between gap-3 mt-2">
                                        <p class="text-xs text-stone-500">
                                            Jelaskan alasan penambahan stok jika diperlukan.
                                        </p>

                                        <p class="text-xs text-stone-400 whitespace-nowrap">
                                            <span id="alasanCount">0</span>/1000
                                        </p>
                                    </div>
                                </div>

                                <!-- INFORMASI -->
                                <div class="notice">
                                    <div class="flex items-start gap-3">
                                        <div class="text-lg brown">ⓘ</div>

                                        <div>
                                            <p class="text-sm font-bold brown">
                                                Informasi Pengajuan
                                            </p>

                                            <p class="text-sm text-stone-600 leading-6 mt-1">
                                                Setelah dikirim, status pengajuan akan menjadi
                                                <strong>Menunggu</strong> sampai admin memeriksa
                                                permintaanmu. Kamu dapat melihat perkembangan
                                                pengajuan melalui halaman Riwayat Restock.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- TOMBOL -->
                                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">

                                    <a
                                        href="{{ route('user.restock.index') }}"
                                        class="secondary-btn"
                                    >
                                        Batal
                                    </a>

                                    <button
                                        type="submit"
                                        id="submitButton"
                                        class="primary-btn"
                                        {{ $books->isEmpty() ? 'disabled' : '' }}
                                    >
                                        <span>✓</span>
                                        Kirim Pengajuan
                                    </button>

                                </div>

                                @if ($books->isEmpty())
                                    <p class="text-sm text-red-600">
                                        Data buku masih kosong. Pengajuan belum dapat dibuat
                                        sampai buku ditambahkan ke Data Buku.
                                    </p>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>

                <!-- PANEL SAMPING -->
                <aside class="space-y-5">

                    <div class="card p-5">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="section-icon">ⓘ</div>

                            <h3 class="font-bold brown">
                                Alur Pengajuan
                            </h3>
                        </div>

                        <div class="space-y-5">

                            <div class="flex items-start gap-3">
                                <div class="section-icon !w-9 !h-9 !text-sm">01</div>

                                <div>
                                    <p class="text-sm font-bold brown">Pilih Buku</p>

                                    <p class="text-xs text-stone-500 leading-5 mt-1">
                                        Pilih buku yang tersedia pada Data Buku.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="section-icon !w-9 !h-9 !text-sm">02</div>

                                <div>
                                    <p class="text-sm font-bold brown">Isi Formulir</p>

                                    <p class="text-xs text-stone-500 leading-5 mt-1">
                                        Tentukan jumlah buku dan tulis alasan jika diperlukan.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <div class="section-icon !w-9 !h-9 !text-sm">03</div>

                                <div>
                                    <p class="text-sm font-bold brown">Pantau Status</p>

                                    <p class="text-xs text-stone-500 leading-5 mt-1">
                                        Tunggu admin memeriksa pengajuanmu.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="section-icon">◷</div>

                            <h3 class="font-bold brown">
                                Status Pengajuan
                            </h3>
                        </div>

                        <div class="space-y-4">

                            <div class="flex items-start gap-3">
                                <span class="mt-1.5 w-2.5 h-2.5 rounded-full bg-orange-500 shrink-0"></span>

                                <div>
                                    <p class="text-sm font-semibold text-stone-700">Menunggu</p>
                                    <p class="text-xs text-stone-500 mt-1">
                                        Pengajuan belum diputuskan admin.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="mt-1.5 w-2.5 h-2.5 rounded-full bg-green-600 shrink-0"></span>

                                <div>
                                    <p class="text-sm font-semibold text-stone-700">Disetujui</p>
                                    <p class="text-xs text-stone-500 mt-1">
                                        Pengajuan disetujui admin.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="mt-1.5 w-2.5 h-2.5 rounded-full bg-red-600 shrink-0"></span>

                                <div>
                                    <p class="text-sm font-semibold text-stone-700">Ditolak</p>
                                    <p class="text-xs text-stone-500 mt-1">
                                        Pengajuan tidak disetujui admin.
                                    </p>
                                </div>
                            </div>

                        </div>

                        <a
                            href="{{ route('user.restock.history') }}"
                            class="secondary-btn w-full mt-5"
                        >
                            Lihat Riwayat Restock →
                        </a>
                    </div>

                </aside>
            </div>

            <footer class="text-center text-xs text-stone-400 mt-8">
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

    // Informasi buku yang dipilih
    const bookSelect = document.getElementById('book_id');
    const selectedBookInfo = document.getElementById('selectedBookInfo');
    const selectedBookTitle = document.getElementById('selectedBookTitle');
    const selectedBookStock = document.getElementById('selectedBookStock');

    function updateSelectedBook() {
        const option = bookSelect?.selectedOptions[0];

        if (option && option.value !== '') {
            selectedBookTitle.textContent = option.dataset.title || option.textContent.trim();
            selectedBookStock.textContent = option.dataset.stock || '0';
            selectedBookInfo.classList.remove('hidden');
        } else {
            selectedBookInfo.classList.add('hidden');
        }
    }

    bookSelect?.addEventListener('change', updateSelectedBook);
    updateSelectedBook();

    // Penghitung karakter alasan
    const alasanInput = document.getElementById('alasan');
    const alasanCount = document.getElementById('alasanCount');

    function updateAlasanCount() {
        alasanCount.textContent = alasanInput.value.length;
    }

    alasanInput?.addEventListener('input', updateAlasanCount);
    updateAlasanCount();

    // Mencegah klik kirim berulang
    const restockForm = document.getElementById('restockForm');
    const submitButton = document.getElementById('submitButton');

    restockForm?.addEventListener('submit', () => {
        if (restockForm.checkValidity() && !submitButton.disabled) {
            submitButton.disabled = true;
            submitButton.textContent = 'Mengirim pengajuan...';
        }
    });
</script>

</body>
</html>