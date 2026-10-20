<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Supplier - Book Stock SMKN 5</title>
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

        .menu-item {
            transition: background .25s ease, transform .25s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.12);
            transform: translateX(4px);
        }

        .menu-active:hover { background: #d96b24; }

        .card {
            background: #fff;
            border: 1px solid #e2ddd9;
            box-shadow: 0 3px 12px rgba(70,45,30,.06);
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(74,45,30,.12);
        }

        .input-field { transition: all .2s ease; }

        .input-field:focus {
            border-color: #6b3f28;
            box-shadow: 0 0 0 3px rgba(107,63,40,.08);
            outline: none;
        }

        .save-button { transition: all .2s ease; }

        .save-button:hover {
            background: #56321f;
            transform: translateY(-1px);
        }

        .table-row { transition: background .2s ease; }
        .table-row:hover { background: #faf7f4; }

        .delete-button { transition: all .2s ease; }

        .delete-button:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        .page-enter {
            animation: pageEnter .6s cubic-bezier(.16,1,.3,1) forwards;
        }

        @keyframes pageEnter {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .success-message { animation: successIn .3s ease; }

        @keyframes successIn {
            from { opacity: 0; transform: translateY(-5px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .school-logo {
            transition: transform .4s cubic-bezier(.34,1.56,.64,1);
        }

        .school-logo:hover { transform: scale(1.06) rotate(2deg); }

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

            body.sidebar-hidden main {
                margin-left: 0 !important;
                width: 100%;
            }

            body:not(.sidebar-hidden) main {
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

            body.mobile-menu-open .sidebar { transform: translateX(0); }

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

            body.mobile-menu-open .sidebar-backdrop { display: block; }

            .dashboard-content { padding: 20px !important; }
            .topbar { padding: 16px !important; }
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

    <!-- BACKDROP MENU HP -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar min-h-screen text-white shadow-lg flex flex-col">

        <div class="p-6 text-center border-b border-white/15">
            <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-md school-logo overflow-hidden">
                <img
                    src="{{ asset('images/logo-smkn5.png') }}"
                    alt="Logo SMKN 5 Kabupaten Tangerang"
                    class="w-full h-full object-contain">
            </div>

            <h1 class="text-xl font-bold">Book Stock</h1>
            <p class="text-xs text-white/70 mt-1">SMKN 5 Kabupaten Tangerang</p>
        </div>

        <!-- MENU ADMIN -->
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

            <!-- SUPPLIER AKTIF -->
            <a href="{{ route('suppliers.index') }}"
               class="menu-item menu-active flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 21V7l7-4 7 4v14"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21v-5h6v5M9 9h.01M12 9h.01M15 9h.01"/>
                </svg>
                <span class="text-sm">Supplier</span>
            </a>

            <a href="{{ route('admin.restock.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">
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
                    <h2 class="text-lg font-bold brown">Supplier</h2>
                    <p class="text-xs text-gray-500">
                        Selamat datang, {{ Auth::user()->name }}!
                    </p>
                </div>
            </div>

            <!-- FOTO PROFIL DAN NAMA ADMIN -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3">

                <div class="text-right hidden sm:block">
                    <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
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

            @if(session('success'))
                <div class="success-message mb-6 px-5 py-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 px-5 py-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                    <p class="font-semibold mb-2">Periksa kembali data yang dimasukkan:</p>
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                <!-- FORM TAMBAH SUPPLIER -->
                <div class="card rounded-xl p-6 h-fit">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold brown">Tambah Supplier</h3>
                            <p class="text-sm text-gray-500 mt-1">Tambahkan supplier buku baru</p>
                        </div>

                        <div class="w-10 h-10 rounded-lg bg-[#f4e9df] flex items-center justify-center brown text-xl">
                            +
                        </div>
                    </div>

                    <form action="{{ route('suppliers.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-semibold brown mb-2">Nama Supplier</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                maxlength="255"
                                placeholder="Contoh: CV Buku Nusantara"
                                class="input-field w-full h-11 px-4 rounded-lg border border-gray-300 text-sm text-gray-700">
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold brown mb-2">
                                Narahubung
                                <span class="font-normal text-gray-400">(Opsional)</span>
                            </label>
                            <input
                                type="text"
                                name="contact_person"
                                value="{{ old('contact_person') }}"
                                maxlength="255"
                                placeholder="Nama orang yang dihubungi"
                                class="input-field w-full h-11 px-4 rounded-lg border border-gray-300 text-sm text-gray-700">
                            @error('contact_person')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold brown mb-2">
                                No. Telepon
                                <span class="font-normal text-gray-400">(Opsional)</span>
                            </label>
                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                maxlength="30"
                                placeholder="Contoh: 081234567890"
                                class="input-field w-full h-11 px-4 rounded-lg border border-gray-300 text-sm text-gray-700">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold brown mb-2">
                                Email
                                <span class="font-normal text-gray-400">(Opsional)</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                maxlength="255"
                                placeholder="supplier@email.com"
                                class="input-field w-full h-11 px-4 rounded-lg border border-gray-300 text-sm text-gray-700">
                            @error('email')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold brown mb-2">
                                Alamat
                                <span class="font-normal text-gray-400">(Opsional)</span>
                            </label>
                            <textarea
                                name="address"
                                rows="3"
                                placeholder="Alamat lengkap supplier..."
                                class="input-field w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-700 resize-none">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold brown mb-2">
                                Deskripsi
                                <span class="font-normal text-gray-400">(Opsional)</span>
                            </label>
                            <textarea
                                name="description"
                                rows="3"
                                placeholder="Catatan tentang supplier..."
                                class="input-field w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-700 resize-none">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="save-button w-full h-11 rounded-lg bg-[#6b3f28] text-white text-sm font-semibold">
                            Simpan Supplier
                        </button>
                    </form>
                </div>

                <!-- DAFTAR SUPPLIER -->
                <div class="card rounded-xl overflow-hidden xl:col-span-2">

                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <h3 class="text-xl font-bold brown">Daftar Supplier</h3>
                                <p class="text-sm text-gray-500 mt-1">Data supplier buku yang tersedia</p>
                            </div>

                            <div class="px-3 py-2 rounded-lg bg-[#f4e9df] brown text-sm font-semibold">
                                {{ $suppliers->count() }} Supplier
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#f7f4f1]">
                                <tr class="border-b border-gray-200">
                                    <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">No</th>
                                    <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">Nama Supplier</th>
                                    <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">Kontak</th>
                                    <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">Alamat</th>
                                    <th class="px-5 py-4 text-center text-xs font-bold brown uppercase">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @forelse($suppliers as $index => $supplier)
                                    <tr class="table-row">
                                        <td class="px-5 py-5 text-sm text-gray-500">{{ $index + 1 }}</td>

                                        <td class="px-5 py-5">
                                            <span class="text-sm font-bold brown">{{ $supplier->name }}</span>
                                            @if($supplier->description)
                                                <p class="text-xs text-gray-400 mt-1">{{ $supplier->description }}</p>
                                            @endif
                                        </td>

                                        <td class="px-5 py-5 text-sm text-gray-600">
                                            {{ $supplier->contact_person ?? '-' }}<br>
                                            <span class="text-xs text-gray-400">
                                                {{ $supplier->phone ?? '-' }} · {{ $supplier->email ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="px-5 py-5 text-sm text-gray-600">
                                            {{ $supplier->address ?? '-' }}
                                        </td>

                                        <td class="px-5 py-5 text-center">
                                            <form
                                                action="{{ route('suppliers.destroy', $supplier->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="delete-button px-4 py-2 rounded-lg border border-red-200 bg-red-50 text-red-600 text-sm font-semibold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-14 text-center">
                                            <p class="text-sm font-semibold text-gray-500">Belum ada supplier.</p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                Tambahkan supplier melalui form di sebelah kiri.
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="text-center text-xs text-gray-400 mt-8">
                © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
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

    // TUTUP MENU HP SAAT BACKDROP DIKLIK
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

    // RESET SAAT UKURAN LAYAR BERUBAH
    window.addEventListener('resize', function () {
        document.body.classList.remove('mobile-menu-open', 'sidebar-hidden');
        menuToggle?.setAttribute('aria-expanded', 'true');
    });
});
</script>

</body>
</html>