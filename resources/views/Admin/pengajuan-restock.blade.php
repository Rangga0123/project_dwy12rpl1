<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengajuan Restock - Book Stock SMKN 5</title>

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
            background: rgba(255,255,255,.12);
            transform: translateX(4px);
        }

        .card {
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 22px rgba(74,45,30,.10);
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

        .status {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .status-disetujui {
            background: #dcfce7;
            color: #166534;
        }

        .status-ditolak {
            background: #fee2e2;
            color: #991b1b;
        }

        .form-control {
            width: 100%;
            border: 1px solid #d6d3d1;
            border-radius: 8px;
            padding: 9px 11px;
            font-size: 13px;
            outline: none;
            background: white;
        }

        .form-control:focus {
            border-color: #9a6848;
            box-shadow: 0 0 0 3px rgba(107,63,40,.10);
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
            border: none;
        }

        .btn-approve {
            color: white;
            background: #15803d;
        }

        .btn-approve:hover {
            background: #166534;
        }

        .btn-reject {
            color: white;
            background: #b91c1c;
        }

        .btn-reject:hover {
            background: #991b1b;
        }

        .btn:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

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

            .page-content {
                padding: 18px !important;
            }

            .topbar {
                padding: 14px 16px !important;
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

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR ADMIN -->
    <aside class="sidebar min-h-screen text-white shadow-lg flex flex-col">

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

        <nav class="mt-5 px-3 flex-1">

            <a href="{{ route('dashboard') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5L12 3l9 7.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 9.5V21h14V9.5"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21v-6h6v6"/>
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="{{ route('books.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 17a2 2 0 012-2h12"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6M9 10h5"/>
                </svg>
                <span class="text-sm">Data Buku</span>
            </a>

            <a href="{{ route('categories.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"/>
                </svg>
                <span class="text-sm">Kategori Buku</span>
            </a>

            <a href="{{ route('suppliers.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"/>
                </svg>
                <span class="text-sm">Supplier</span>
            </a>

            <a href="{{ route('admin.restock.index') }}"
               class="menu-item menu-active flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v4h4M9 12h6M9 15h6"/>
                </svg>
                <span class="text-sm">Pengajuan Restock</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="3"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 20a7 7 0 0114 0"/>
                </svg>
                <span class="text-sm">Profil</span>
            </a>

        </nav>

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

        <!-- NAVBAR -->
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
                    <h2 class="text-lg font-bold brown">Pengajuan Restock</h2>
                    <p class="text-xs text-gray-500">Kelola permintaan penambahan stok buku</p>
                </div>
            </div>

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

        <!-- KONTEN -->
        <section class="page-content p-8 page-enter">

            <!-- JUDUL HALAMAN -->
            <div class="mb-7">
                <p class="text-sm text-gray-500 mb-2">
                    Dashboard / Pengajuan Restock
                </p>

                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold brown">
                            Pengajuan Restock Buku
                        </h1>
                        <p class="text-sm text-gray-500 mt-2">
                            Periksa, setujui, atau tolak permintaan restock dari pengguna.
                        </p>
                    </div>

                    <div class="text-sm text-gray-500">
                        Total pengajuan:
                        <span class="font-bold brown">{{ $requests->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- NOTIFIKASI -->
            @if(session('success'))
                <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
                    <div class="flex items-start gap-2">
                        <span class="font-bold">✓</span>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    <div class="flex items-start gap-2">
                        <span class="font-bold">!</span>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                    <p class="font-semibold mb-2">Periksa kembali data berikut:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- KARTU STATISTIK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">Total Pengajuan</p>
                        <div class="w-10 h-10 rounded-xl bg-[#f4eee9] brown flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 15h6"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold brown mt-4">{{ $requests->count() }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Semua permintaan</p>
                </div>

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">Menunggu</p>
                        <div class="w-10 h-10 rounded-xl bg-yellow-50 text-yellow-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-yellow-700 mt-4">
                        {{ $requests->where('status', 'menunggu')->count() }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">Perlu diperiksa</p>
                </div>

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">Disetujui</p>
                        <div class="w-10 h-10 rounded-xl bg-green-50 text-green-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l4 4L19 6"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-green-700 mt-4">
                        {{ $requests->where('status', 'disetujui')->count() }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">Pengajuan diterima</p>
                </div>

                <div class="card bg-white rounded-xl p-5 border border-gray-200">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">Ditolak</p>
                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-red-700 mt-4">
                        {{ $requests->where('status', 'ditolak')->count() }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">Pengajuan ditolak</p>
                </div>

            </div>

            <!-- TABEL PENGAJUAN -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                <div class="p-5 md:p-6 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold brown">Daftar Pengajuan</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Data permintaan restock buku dari pengguna.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Cari nama atau judul buku..."
                            class="form-control sm:w-64"
                            aria-label="Cari pengajuan">

                        <select id="statusFilter" class="form-control sm:w-40" aria-label="Filter status">
                            <option value="">Semua Status</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-[#f8f5f2] text-gray-600">
                            <tr>
                                <th class="px-5 py-4 text-left font-semibold">No.</th>
                                <th class="px-5 py-4 text-left font-semibold">Pengguna</th>
                                <th class="px-5 py-4 text-left font-semibold">Buku</th>
                                <th class="px-5 py-4 text-center font-semibold">Jumlah</th>
                                <th class="px-5 py-4 text-left font-semibold">Alasan</th>
                                <th class="px-5 py-4 text-left font-semibold">Status</th>
                                <th class="px-5 py-4 text-left font-semibold">Catatan Admin</th>
                                <th class="px-5 py-4 text-left font-semibold">Tindakan</th>
                            </tr>
                        </thead>

                        <tbody id="requestTableBody" class="divide-y divide-gray-100">

                            @forelse($requests as $item)
                                <tr class="request-row hover:bg-[#fcfaf8] align-top"
                                    data-search="{{ strtolower(($item->user->name ?? 'pengguna') . ' ' . ($item->book->title ?? 'buku')) }}"
                                    data-status="{{ strtolower($item->status ?? '') }}">

                                    <td class="px-5 py-5 text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-5 py-5">
                                        <p class="font-semibold text-gray-800">
                                            {{ $item->user->name ?? 'Pengguna tidak ditemukan' }}
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            ID: {{ $item->user_id }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5">
                                        <p class="font-semibold brown">
                                            {{ $item->book->title ?? 'Buku tidak ditemukan' }}
                                        </p>
                                        @if($item->book && isset($item->book->author))
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $item->book->author }}
                                            </p>
                                        @endif
                                    </td>

                                    <td class="px-5 py-5 text-center">
                                        <span class="inline-flex items-center justify-center min-w-10 px-3 py-1 rounded-lg bg-[#f4eee9] brown font-bold">
                                            {{ $item->jumlah }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-5 text-gray-600 min-w-40 max-w-xs">
                                        {{ $item->alasan ?: 'Tidak ada alasan' }}
                                    </td>

                                    <td class="px-5 py-5">
                                        @if($item->status === 'menunggu')
                                            <span class="status status-menunggu">Menunggu</span>
                                        @elseif($item->status === 'disetujui')
                                            <span class="status status-disetujui">Disetujui</span>
                                        @elseif($item->status === 'ditolak')
                                            <span class="status status-ditolak">Ditolak</span>
                                        @else
                                            <span class="status bg-gray-100 text-gray-600">
                                                {{ ucfirst($item->status ?? 'Tidak diketahui') }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-5 text-gray-600 min-w-40 max-w-xs">
                                        {{ $item->catatan_admin ?: '—' }}
                                    </td>

                                    <td class="px-5 py-5 min-w-64">

                                        @if($item->status === 'menunggu')

                                            <!-- FORM SETUJUI -->
                                            <form
                                                method="POST"
                                                action="{{ route('admin.restock.approve', $item->id) }}"
                                                class="mb-3">

                                                @csrf
                                                @method('PATCH')

                                                <label class="block text-xs text-gray-500 mb-1">
                                                    Catatan persetujuan (opsional)
                                                </label>

                                                <textarea
                                                    name="catatan_admin"
                                                    rows="2"
                                                    maxlength="1000"
                                                    class="form-control mb-2"
                                                    placeholder="Catatan untuk pengguna..."></textarea>

                                                <button
                                                    type="submit"
                                                    class="btn btn-approve w-full"
                                                    onclick="return confirm('Yakin ingin menyetujui pengajuan ini?')">
                                                    ✓ Setujui Pengajuan
                                                </button>
                                            </form>

                                            <!-- FORM TOLAK -->
                                            <form
                                                method="POST"
                                                action="{{ route('admin.restock.reject', $item->id) }}"
                                                class="border-t border-gray-100 pt-3">

                                                @csrf
                                                @method('PATCH')

                                                <label class="block text-xs text-gray-500 mb-1">
                                                    Alasan penolakan (wajib)
                                                </label>

                                                <textarea
                                                    name="catatan_admin"
                                                    rows="2"
                                                    maxlength="1000"
                                                    required
                                                    class="form-control mb-2"
                                                    placeholder="Tuliskan alasan penolakan..."></textarea>

                                                <button
                                                    type="submit"
                                                    class="btn btn-reject w-full"
                                                    onclick="return confirm('Yakin ingin menolak pengajuan ini?')">
                                                    ✕ Tolak Pengajuan
                                                </button>
                                            </form>

                                        @else

                                            <div class="rounded-lg bg-gray-50 border border-gray-200 p-3">
                                                <p class="text-xs font-semibold text-gray-600">
                                                    Pengajuan sudah diproses
                                                </p>
                                                <p class="text-xs text-gray-400 mt-1">
                                                    Tindakan tidak tersedia lagi.
                                                </p>
                                            </div>

                                        @endif

                                    </td>
                                </tr>

                            @empty
                                <tr id="emptyDataRow">
                                    <td colspan="8" class="px-6 py-14 text-center">
                                        <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-[#f4eee9] brown flex items-center justify-center">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 15h6"/>
                                            </svg>
                                        </div>

                                        <h4 class="font-bold text-gray-700">
                                            Belum Ada Pengajuan
                                        </h4>

                                        <p class="text-sm text-gray-500 mt-2">
                                            Pengajuan restock dari pengguna akan muncul di halaman ini.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse

                            <tr id="noSearchResult" class="hidden">
                                <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                                    Tidak ada pengajuan yang cocok dengan pencarian.
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="px-5 py-4 border-t border-gray-200 bg-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <p class="text-xs text-gray-500">
                        Menampilkan <span id="visibleCount">{{ $requests->count() }}</span>
                        dari {{ $requests->count() }} pengajuan.
                    </p>

                    <p class="text-xs text-gray-400">
                        Book Stock SMKN 5 Kabupaten Tangerang
                    </p>
                </div>

            </div>

            <!-- INFORMASI -->
            <div class="bg-white rounded-xl border border-gray-200 p-5 md:p-6 mt-6 shadow-sm">
                <h3 class="text-base font-bold brown mb-2">
                    Informasi Pengelolaan Restock
                </h3>

                <p class="text-sm text-gray-600 leading-relaxed">
                    Periksa judul buku, jumlah yang diajukan, dan alasan pengguna.
                    Pengajuan berstatus Menunggu dapat disetujui atau ditolak.
                    Jika menolak, admin wajib mengisi alasan agar pengguna mengetahui
                    keputusan tersebut. Setelah diproses, status dan catatan admin
                    akan ditampilkan pada tabel ini.
                </p>
            </div>

        </section>

    </main>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.getElementById('menuToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');

    // BUKA/TUTUP SIDEBAR
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

    // TUTUP SIDEBAR HP SAAT BACKDROP DIKLIK
    sidebarBackdrop?.addEventListener('click', function () {
        document.body.classList.remove('mobile-menu-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    // TUTUP SIDEBAR HP SETELAH MEMILIH MENU
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

    // PENCARIAN DAN FILTER STATUS
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const requestRows = Array.from(document.querySelectorAll('.request-row'));
    const noSearchResult = document.getElementById('noSearchResult');
    const visibleCount = document.getElementById('visibleCount');

    function filterRequests() {
        const keyword = (searchInput?.value || '').toLowerCase().trim();
        const status = (statusFilter?.value || '').toLowerCase();
        let visible = 0;

        requestRows.forEach(function (row) {
            const searchText = row.dataset.search || '';
            const rowStatus = row.dataset.status || '';

            const matchesSearch = searchText.includes(keyword);
            const matchesStatus = !status || rowStatus === status;
            const show = matchesSearch && matchesStatus;

            row.classList.toggle('hidden', !show);

            if (show) visible++;
        });

        if (visibleCount) {
            visibleCount.textContent = visible;
        }

        if (noSearchResult) {
            noSearchResult.classList.toggle(
                'hidden',
                requestRows.length === 0 || visible !== 0
            );
        }
    }

    searchInput?.addEventListener('input', filterRequests);
    statusFilter?.addEventListener('change', filterRequests);

});
</script>

</body>
</html>