<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Book Stock SMKN 5</title>
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
            background: var(--page);
            font-family: Arial, Helvetica, sans-serif;
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
            background: white;
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

        .menu-item {
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

        .menu-item:hover {
            background: rgba(255,255,255,.11);
            transform: translateX(2px);
        }

        .menu-active,
        .menu-active:hover {
            background: var(--orange);
            color: white;
        }

        .menu-icon {
            width: 19px;
            min-width: 19px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 17px;
            line-height: 1;
            flex-shrink: 0;
        }

        .topbar {
            height: 76px;
            background: white;
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 20;
            box-shadow: 0 2px 5px rgba(0,0,0,.03);
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
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            color: var(--brown);
            background: transparent;
            border: none;
            font-size: 25px;
            cursor: pointer;
            flex-shrink: 0;
            transition: background .18s ease;
        }

        .hamburger:hover { background: #f4eee9; }

        .sidebar-backdrop { display: none; }

        .page-content {
            animation: rise-in .4s ease both;
        }

        @keyframes rise-in {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 2px 7px rgba(55,35,24,.035);
            overflow: hidden;
        }

        .card-heading {
            padding: 19px 22px;
            border-bottom: 1px solid var(--line);
        }

        .card-body { padding: 22px; }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #57534e;
            margin-bottom: 7px;
        }

        .form-input {
            width: 100%;
            border: 1px solid #ded6cf;
            border-radius: 8px;
            padding: 11px 12px;
            font-size: 14px;
            background: white;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(217,107,36,.12);
        }

        .btn-primary,
        .btn-orange,
        .btn-danger {
            border-radius: 8px;
            padding: 10px 17px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s ease;
        }

        .btn-primary {
            background: var(--brown);
            color: white;
            border: none;
        }

        .btn-primary:hover { background: var(--brown-dark); }

        .btn-orange {
            background: var(--orange);
            color: white;
            border: none;
        }

        .btn-orange:hover { background: #c95e1b; }

        .btn-danger {
            background: white;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .btn-danger:hover { background: #fef2f2; }

        .notice-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px 15px;
            border-radius: 9px;
            font-size: 13px;
        }

        .notice-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 15px;
            border-radius: 9px;
            font-size: 13px;
        }

        .profile-photo,
        .photo-placeholder {
            width: 105px;
            height: 105px;
            border-radius: 50%;
            border: 4px solid #f3e8df;
        }

        .profile-photo {
            object-fit: cover;
            background: #eadfd6;
        }

        .photo-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eadfd6;
            color: var(--brown);
            font-size: 35px;
            font-weight: bold;
        }

        /* DESKTOP: sidebar sama seperti Riwayat Restock */
        @media (min-width: 1024px) {
            .sidebar {
                position: fixed;
                inset: 0 auto 0 0;
                height: 100vh;
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

            body.sidebar-collapsed main {
                margin-left: 0 !important;
                width: 100%;
            }

            body:not(.sidebar-collapsed) main {
                margin-left: 230px;
                width: calc(100% - 230px);
            }
        }

        /* MOBILE DAN TABLET */
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

        @media (max-width: 639px) {
            .card-body { padding: 16px; }
            .card-heading { padding: 16px; }
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
    $user = Auth::user();
    $isAdmin = $user && $user->role === 'admin';
@endphp

<div class="flex min-h-screen">

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar" class="sidebar min-h-screen flex flex-col">

        <div class="brand-area px-5 py-6 text-center">
            <div class="brand-logo mx-auto mb-3">
                <img src="{{ asset('images/logo-smkn5.png') }}"
                     alt="Logo SMKN 5 Kabupaten Tangerang">
            </div>

            <div>
                <h1 class="text-lg font-bold tracking-tight leading-tight">
                    Book Stock SMKN 5
                </h1>
                <p class="text-xs text-white/75 mt-2">Sistem Restock Buku</p>
                <p class="text-xs text-white/75 mt-1">Perpustakaan</p>
            </div>
        </div>

        <!-- MENU -->
        <nav class="flex-1 px-3 py-5 space-y-1.5">

            <a href="{{ route('dashboard') }}" class="menu-item">
                <span class="menu-icon">⌂</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('books.index') }}" class="menu-item">
                <span class="menu-icon">▤</span>
                <span>Data Buku</span>
            </a>

            @if ($isAdmin)

                <a href="{{ route('categories.index') }}" class="menu-item">
                    <span class="menu-icon">▧</span>
                    <span>Kategori Buku</span>
                </a>

                <a href="{{ route('suppliers.index') }}" class="menu-item">
                    <span class="menu-icon">▦</span>
                    <span>Supplier</span>
                </a>

                <a href="{{ route('admin.restock.index') }}" class="menu-item">
                    <span class="menu-icon">▧</span>
                    <span>Pengajuan Restock</span>
                </a>

            @else

                <a href="{{ route('user.restock.create') }}" class="menu-item">
                    <span class="menu-icon">▧</span>
                    <span>Pengajuan Restock</span>
                </a>

                <a href="{{ route('user.restock.history') }}" class="menu-item">
                    <span class="menu-icon">◷</span>
                    <span>Riwayat Restock</span>
                </a>


            @endif

            <a href="{{ route('profile.edit') }}"
               class="menu-item menu-active"
               aria-current="page">
                <span class="menu-icon">♙</span>
                <span>Profil</span>
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="px-3 pb-5 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item w-full text-left hover:!bg-red-700">
                    <span class="menu-icon">⇥</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN -->
    <main class="min-h-screen min-w-0">

        <!-- TOPBAR -->
        <header class="topbar flex items-center justify-between px-7">

            <div class="flex items-center gap-4 min-w-0">
                <button type="button"
                        id="menuToggle"
                        class="hamburger"
                        aria-label="Buka atau tutup menu"
                        aria-expanded="true">
                    ☰
                </button>

                <div class="min-w-0">
                    <h2 class="text-lg font-bold brown">Profil Saya</h2>
                    <p class="text-xs text-gray-500">
                        Kelola informasi akun kamu
                    </p>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 no-underline min-w-0">

                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold brown leading-5">
                        {{ $user->name ?? 'User' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $isAdmin ? 'Administrator' : 'User' }}
                    </p>
                </div>

                <div class="user-avatar">
                    @if ($user && $user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                             alt="Foto profil">
                    @else
                        <span>♙</span>
                    @endif
                </div>
            </a>

        </header>

        <!-- KONTEN PROFIL -->
        <section class="content-area p-4 md:p-8 page-content">
            <div class="max-w-5xl mx-auto">

                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-stone-800">
                        Pengaturan Profil
                    </h1>
                    <p class="text-sm text-stone-500 mt-1">
                        Perbarui informasi akun, foto profil, dan kata sandi.
                    </p>
                </div>

                @if (session('success'))
                    <div class="notice-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('success_photo'))
                    <div class="notice-success mb-4">
                        {{ session('success_photo') }}
                    </div>
                @endif

                @if (session('success_password'))
                    <div class="notice-success mb-4">
                        {{ session('success_password') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="notice-error mb-5">
                        <p class="font-bold mb-2">
                            Ada data yang perlu diperiksa:
                        </p>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                    <!-- FOTO PROFIL -->
                    <div class="profile-card">
                        <div class="card-heading">
                            <h3 class="font-bold text-stone-800">Foto Profil</h3>
                            <p class="text-xs text-stone-500 mt-1">
                                Foto yang tampil di akun kamu
                            </p>
                        </div>

                        <div class="card-body">
                            <div class="flex flex-col items-center text-center">

                                @if ($user->profile_photo)
                                    <img id="photoPreview"
                                         src="{{ asset('storage/' . $user->profile_photo) }}"
                                         alt="Foto profil"
                                         class="profile-photo mb-4">
                                @else
                                    <div id="photoPlaceholder" class="photo-placeholder mb-4">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <img id="photoPreview"
                                         src=""
                                         alt="Pratinjau foto profil"
                                         class="profile-photo mb-4 hidden">
                                @endif

                                <h4 class="font-bold text-stone-800">
                                    {{ $user->name }}
                                </h4>

                                <p class="text-xs text-stone-500 mt-1">
                                    {{ $user->email }}
                                </p>

                                <span class="mt-3 px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background:#f5e7dc;color:#70432d;">
                                    {{ $isAdmin ? 'Administrator' : 'User' }}
                                </span>
                            </div>

                            <form method="POST"
                                  action="{{ route('profile.photo.update') }}"
                                  enctype="multipart/form-data"
                                  class="mt-6">
                                @csrf

                                <label for="profile_photo" class="form-label">
                                    Pilih foto baru
                                </label>

                                <input type="file"
                                       id="profile_photo"
                                       name="profile_photo"
                                       accept="image/jpeg,image/png,image/webp"
                                       class="form-input text-xs"
                                       required>

                                <p class="text-xs text-stone-500 mt-2">
                                    Format JPG, PNG, atau WEBP. Maksimal 2 MB.
                                </p>

                                <button type="submit" class="btn-orange w-full mt-4">
                                    Simpan Foto
                                </button>
                            </form>

                            @if ($user->profile_photo)
                                <form method="POST"
                                      action="{{ route('profile.photo.delete') }}"
                                      class="mt-3"
                                      onsubmit="return confirm('Yakin ingin menghapus foto profil?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-danger w-full">
                                        Hapus Foto Profil
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- INFORMASI AKUN -->
                    <div class="profile-card lg:col-span-2">
                        <div class="card-heading">
                            <h3 class="font-bold text-stone-800">Informasi Akun</h3>
                            <p class="text-xs text-stone-500 mt-1">
                                Ubah nama atau email akun kamu
                            </p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PATCH')

                                <div class="mb-5">
                                    <label for="name" class="form-label">
                                        Nama Lengkap
                                    </label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           class="form-input"
                                           value="{{ old('name', $user->name) }}"
                                           required
                                           maxlength="255"
                                           autocomplete="name">
                                </div>

                                <div class="mb-5">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           class="form-input"
                                           value="{{ old('email', $user->email) }}"
                                           required
                                           maxlength="255"
                                           autocomplete="username">
                                </div>

                                <div class="mb-5">
                                    <label class="form-label">Role Akun</label>
                                    <input type="text"
                                           class="form-input bg-stone-50"
                                           value="{{ $isAdmin ? 'Administrator' : 'User' }}"
                                           disabled>
                                    <p class="text-xs text-stone-500 mt-2">
                                        Role akun hanya dapat diubah oleh pengelola sistem.
                                    </p>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="btn-primary">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- GANTI PASSWORD -->
                    <div class="profile-card lg:col-span-3">
                        <div class="card-heading">
                            <h3 class="font-bold text-stone-800">Keamanan Akun</h3>
                            <p class="text-xs text-stone-500 mt-1">
                                Ganti kata sandi untuk menjaga keamanan akun.
                            </p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div>
                                        <label for="current_password" class="form-label">
                                            Kata Sandi Saat Ini
                                        </label>
                                        <input type="password"
                                               id="current_password"
                                               name="current_password"
                                               class="form-input"
                                               autocomplete="current-password"
                                               required>
                                    </div>

                                    <div>
                                        <label for="password" class="form-label">
                                            Kata Sandi Baru
                                        </label>
                                        <input type="password"
                                               id="password"
                                               name="password"
                                               class="form-input"
                                               autocomplete="new-password"
                                               required>
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="form-label">
                                            Konfirmasi Kata Sandi Baru
                                        </label>
                                        <input type="password"
                                               id="password_confirmation"
                                               name="password_confirmation"
                                               class="form-input"
                                               autocomplete="new-password"
                                               required>
                                    </div>
                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="btn-primary">
                                        Ganti Kata Sandi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <footer class="text-center text-xs text-stone-400 mt-7">
                    © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
                </footer>

            </div>
        </section>

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const menuToggle = document.getElementById('menuToggle');
    const backdrop = document.getElementById('sidebarBackdrop');

    // Toggle sidebar desktop dan mobile
    menuToggle?.addEventListener('click', function () {
        if (window.innerWidth < 1024) {
            body.classList.toggle('mobile-menu-open');

            menuToggle.setAttribute(
                'aria-expanded',
                String(body.classList.contains('mobile-menu-open'))
            );
        } else {
            body.classList.toggle('sidebar-collapsed');

            menuToggle.setAttribute(
                'aria-expanded',
                String(!body.classList.contains('sidebar-collapsed'))
            );
        }
    });

    // Tutup sidebar mobile saat backdrop diklik
    backdrop?.addEventListener('click', function () {
        body.classList.remove('mobile-menu-open');
        menuToggle?.setAttribute('aria-expanded', 'false');
    });

    // Tutup sidebar mobile setelah menu dipilih
    document.querySelectorAll('.sidebar a, .sidebar button').forEach(function (item) {
        item.addEventListener('click', function () {
            if (window.innerWidth < 1024) {
                body.classList.remove('mobile-menu-open');
                menuToggle?.setAttribute('aria-expanded', 'false');
            }
        });
    });

    // Sesuaikan sidebar ketika ukuran layar berubah
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            body.classList.remove('mobile-menu-open');
        } else {
            body.classList.remove('sidebar-collapsed');
            body.classList.remove('mobile-menu-open');
        }

        menuToggle?.setAttribute(
            'aria-expanded',
            String(
                window.innerWidth >= 1024
                    ? !body.classList.contains('sidebar-collapsed')
                    : body.classList.contains('mobile-menu-open')
            )
        );
    });

    // Pratinjau foto profil
    const photoInput = document.getElementById('profile_photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');

    if (photoInput && photoPreview) {
        photoInput.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Silakan pilih file gambar.');
                this.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto maksimal 2 MB.');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                photoPreview.src = event.target.result;
                photoPreview.classList.remove('hidden');

                if (photoPlaceholder) {
                    photoPlaceholder.classList.add('hidden');
                }
            };

            reader.readAsDataURL(file);
        });
    }
});
</script>

</body>
</html>