<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil - Book Stock SMKN 5</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7f4f1;
        }

        .sidebar {
            background: #6b3f28;
        }

        .brown {
            color: #6b3f28;
        }

        .menu-active {
            background: #d96b24;
        }

        .menu-item {
            transition: all 0.25s ease;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.12);
            transform: translateX(4px);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(74, 45, 30, 0.10);
        }

        .page-enter {
            animation: pageEnter 0.6s ease forwards;
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
            transition: transform 0.3s ease;
        }

        .school-logo:hover {
            transform: scale(1.05);
        }

        input {
            outline: none;
        }

        input:focus {
            border-color: #6b3f28;
            box-shadow: 0 0 0 3px rgba(107, 63, 40, 0.08);
        }

        .profile-photo {
            transition: all 0.3s ease;
        }

        .profile-photo:hover {
            transform: scale(1.03);
        }

        .btn {
            transition: all 0.25s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body>

<div class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="sidebar w-64 min-h-screen text-white fixed left-0 top-0 z-20 shadow-lg">

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


        <!-- MENU -->
        <nav class="mt-5 px-3">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 10.5L12 3l9 7.5"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 9.5V21h14V9.5"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 21v-6h6v6"/>

                </svg>

                <span class="text-sm">
                    Dashboard
                </span>

            </a>


            <!-- Data Buku -->
            <a href="{{ route('books.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 17a2 2 0 012-2h12"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 7h6M9 10h5"/>

                </svg>

                <span class="text-sm">
                    Data Buku
                </span>

            </a>


            <!-- Kategori -->
            <a href="{{ route('categories.index') }}"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"/>

                </svg>

                <span class="text-sm">
                    Kategori Buku
                </span>

            </a>


            <!-- Supplier -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 21h18"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 21V7l7-4 7 4v14"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 21v-5h6v5M9 9h.01M12 9h.01M15 9h.01"/>

                </svg>

                <span class="text-sm">
                    Supplier
                </span>

            </a>


            <!-- Pengajuan -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M6 3h9l3 3v15H6V3z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M14 3v4h4M9 12h6M9 15h6"/>

                </svg>

                <span class="text-sm">
                    Pengajuan Restock
                </span>

            </a>


            <!-- Riwayat -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 5h16v14H4z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M8 9h8M8 12h8M8 15h5"/>

                </svg>

                <span class="text-sm">
                    Riwayat Restock
                </span>

            </a>


            <!-- Laporan -->
            <a href="#"
               class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 20V10M12 20V4M19 20v-7"/>

                </svg>

                <span class="text-sm">
                    Laporan
                </span>

            </a>


            <!-- Profil -->
            <a href="{{ route('profile.edit') }}"
               class="menu-active flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <circle cx="12"
                            cy="8"
                            r="3"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 20a7 7 0 0114 0"/>

                </svg>

                <span class="text-sm">
                    Profil
                </span>

            </a>

        </nav>


        <!-- LOGOUT -->
        <div class="absolute bottom-5 left-3 right-3">

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="menu-item w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600/80 text-left">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M10 17l5-5-5-5M15 12H3"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M21 19V5a2 2 0 00-2-2h-5"/>

                    </svg>

                    <span class="text-sm">
                        Logout
                    </span>

                </button>

            </form>

        </div>

    </aside>


    <!-- MAIN -->
    <main class="ml-64 w-full min-h-screen">


        <!-- TOPBAR -->
        <header class="bg-white border-b border-gray-200 px-8 py-5 flex justify-between items-center sticky top-0 z-10 shadow-sm">

            <div>

                <h2 class="text-2xl font-bold brown">
                    Profil
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola informasi akun Anda
                </p>

            </div>


            <div class="flex items-center gap-3">

                <div class="text-right">

                    <p class="font-semibold text-gray-800">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Administrator
                    </p>

                </div>


                @if($user->profile_photo)

                    <img src="{{ asset('storage/' . $user->profile_photo) }}"
                         alt="Foto Profil"
                         class="w-10 h-10 rounded-full object-cover border-2 border-[#6b3f28]">

                @else

                    <div class="w-10 h-10 rounded-full bg-[#f4eee9] brown flex items-center justify-center">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             viewBox="0 0 24 24">

                            <circle cx="12"
                                    cy="8"
                                    r="3"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5 20a7 7 0 0114 0"/>

                        </svg>

                    </div>

                @endif

            </div>

        </header>


        <!-- CONTENT -->
        <section class="p-8 page-enter">

            <div class="mb-7">

                <h1 class="text-3xl font-bold brown">
                    Pengaturan Profil
                </h1>

                <p class="text-gray-500 mt-1">
                    Kelola informasi pribadi, foto profil, dan keamanan akun.
                </p>

            </div>


            <!-- PESAN BERHASIL -->
            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('success_photo'))

                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                    {{ session('success_photo') }}
                </div>

            @endif


            @if(session('success_password'))

                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                    {{ session('success_password') }}
                </div>

            @endif


            <!-- ERROR -->
            @if($errors->any())

                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">

                    <p class="font-semibold mb-2">
                        Ada kesalahan:
                    </p>

                    <ul class="list-disc ml-5 text-sm">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


                <!-- FOTO PROFIL -->
                <div class="card bg-white rounded-xl border border-gray-200 p-6">

                    <h3 class="text-xl font-bold brown">
                        Foto Profil
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Gunakan foto untuk profil akun Anda.
                    </p>


                    <div class="flex justify-center mt-7">

                        @if($user->profile_photo)

                            <img id="photoPreview"
                                 src="{{ asset('storage/' . $user->profile_photo) }}"
                                 alt="Foto Profil"
                                 class="profile-photo w-32 h-32 rounded-full object-cover border-4 border-[#6b3f28] shadow-md">

                        @else

                            <div id="photoPlaceholder"
                                 class="profile-photo w-32 h-32 rounded-full bg-[#f4eee9] border-4 border-[#6b3f28] flex items-center justify-center brown">

                                <svg class="w-14 h-14"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.5"
                                     viewBox="0 0 24 24">

                                    <circle cx="12"
                                            cy="8"
                                            r="3"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M5 20a7 7 0 0114 0"/>

                                </svg>

                            </div>

                            <img id="photoPreview"
                                 class="hidden w-32 h-32 rounded-full object-cover border-4 border-[#6b3f28] shadow-md">

                        @endif

                    </div>


                    <div class="text-center mt-5">

                        <h4 class="text-lg font-bold text-gray-800">
                            {{ $user->name }}
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $user->email }}
                        </p>

                    </div>


                    <!-- FORM FOTO -->
                    <form method="POST"
                          action="{{ route('profile.photo.update') }}"
                          enctype="multipart/form-data"
                          class="mt-6">

                        @csrf

                        <label class="block text-sm font-semibold brown mb-2">
                            Pilih Foto Baru
                        </label>

                        <input id="profilePhoto"
                               type="file"
                               name="profile_photo"
                               accept="image/jpeg,image/png,image/webp"
                               required
                               class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 bg-white">

                        <p class="text-xs text-gray-500 mt-2">
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>

                        <button type="submit"
                                class="btn mt-4 w-full bg-[#6b3f28] hover:bg-[#57321f] text-white px-5 py-3 rounded-lg font-semibold">

                            Simpan Foto

                        </button>

                    </form>


                    <!-- HAPUS FOTO -->
                    @if($user->profile_photo)

                        <form method="POST"
                              action="{{ route('profile.photo.delete') }}"
                              class="mt-3">

                            @csrf

                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus foto profil?')"
                                    class="w-full text-sm text-red-600 hover:text-red-800 font-semibold py-2">

                                Hapus Foto Profil

                            </button>

                        </form>

                    @endif

                </div>


                <!-- INFORMASI PROFIL -->
                <div class="xl:col-span-2 card bg-white rounded-xl border border-gray-200 p-6">

                    <h3 class="text-xl font-bold brown">
                        Informasi Profil
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 mb-7">
                        Perbarui nama dan alamat email akun Anda.
                    </p>


                    <form method="POST"
                          action="{{ route('profile.update') }}">

                        @csrf

                        @method('PATCH')


                        <div class="mb-5">

                            <label class="block text-sm font-semibold brown mb-2">
                                Nama Lengkap
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3">

                        </div>


                        <div class="mb-6">

                            <label class="block text-sm font-semibold brown mb-2">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3">

                        </div>


                        <button type="submit"
                                class="btn bg-[#d96b24] hover:bg-[#c45d1b] text-white px-6 py-3 rounded-lg font-semibold">

                            Simpan Perubahan

                        </button>

                    </form>

                </div>


                <!-- KEAMANAN -->
                <div class="xl:col-span-3 card bg-white rounded-xl border border-gray-200 p-6">

                    <h3 class="text-xl font-bold brown">
                        Keamanan Akun
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 mb-7">
                        Ubah password untuk menjaga keamanan akun Anda.
                    </p>


                    <form method="POST"
                          action="{{ route('profile.password') }}">

                        @csrf

                        @method('PATCH')


                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


                            <div>

                                <label class="block text-sm font-semibold brown mb-2">
                                    Password Saat Ini
                                </label>

                                <input type="password"
                                       name="current_password"
                                       required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3">

                            </div>


                            <div>

                                <label class="block text-sm font-semibold brown mb-2">
                                    Password Baru
                                </label>

                                <input type="password"
                                       name="password"
                                       required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3">

                            </div>


                            <div>

                                <label class="block text-sm font-semibold brown mb-2">
                                    Konfirmasi Password Baru
                                </label>

                                <input type="password"
                                       name="password_confirmation"
                                       required
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3">

                            </div>

                        </div>


                        <button type="submit"
                                class="btn mt-6 bg-[#6b3f28] hover:bg-[#57321f] text-white px-6 py-3 rounded-lg font-semibold">

                            Ubah Password

                        </button>

                    </form>

                </div>

            </div>


            <div class="text-center text-sm text-gray-400 mt-8">

                © {{ date('Y') }}
                Book Stock SMKN 5 Kabupaten Tangerang

            </div>

        </section>

    </main>

</div>


<script>

    const photoInput = document.getElementById('profilePhoto');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');

    if (photoInput) {

        photoInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {

                photoPreview.src = e.target.result;
                photoPreview.classList.remove('hidden');

                if (photoPlaceholder) {
                    photoPlaceholder.classList.add('hidden');
                }

            };

            reader.readAsDataURL(file);

        });

    }

</script>

</body>
</html>