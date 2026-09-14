<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Setting Profil - Book Stock SMKN5</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f3ef;
            color: #4a2c1d;
        }

        .sidebar {
            background: #713f24;
        }

        .menu {
            transition: 0.2s;
        }

        .menu:hover {
            background: #8b4d2c;
        }

        .active {
            background: #d86b1f;
        }

        .brown {
            color: #713f24;
        }

        .card {
            background: white;
            border: 1px solid #eaded5;
            box-shadow: 0 5px 18px rgba(76, 45, 29, 0.08);
        }

        input {
            outline: none;
        }

        input:focus {
            border-color: #713f24 !important;
            box-shadow: 0 0 0 3px rgba(113, 63, 36, 0.08);
        }
    </style>
</head>

<body>

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar w-[270px] min-h-screen text-white flex flex-col">

        <!-- LOGO -->
        <div class="px-6 py-7 text-center border-b border-white/20">

            <div class="mx-auto mb-3
                        w-16 h-16
                        rounded-2xl
                        bg-white
                        flex items-center justify-center
                        shadow-lg">

                <span class="text-4xl">📖</span>

            </div>

            <h1 class="text-2xl font-bold">
                Book Stock SMKN5
            </h1>

            <p class="text-sm text-white/75 mt-1">
                Sistem Restock Buku
            </p>

            <p class="text-sm text-white/75">
                Perpustakaan
            </p>

        </div>


        <!-- MENU -->

        <nav class="flex-1 px-4 py-6 space-y-2">

            <a href="{{ route('dashboard') }}"
               class="menu flex items-center gap-4 px-4 py-3 rounded-xl">

                <span class="text-xl">🏠</span>
                <span>Dashboard</span>

            </a>


            <a href="{{ route('books.index') }}"
               class="menu flex items-center gap-4 px-4 py-3 rounded-xl">

                <span class="text-xl">📚</span>
                <span>Data Buku</span>

            </a>


            <a href="{{ route('books.index') }}"
               class="menu flex items-center gap-4 px-4 py-3 rounded-xl">

                <span class="text-xl">📄</span>
                <span>Pengajuan Restock</span>

            </a>


            <a href="#"
               class="menu flex items-center gap-4 px-4 py-3 rounded-xl">

                <span class="text-xl">🕘</span>
                <span>Riwayat Restock</span>

            </a>


            <a href="#"
               class="menu flex items-center gap-4 px-4 py-3 rounded-xl">

                <span class="text-xl">🔄</span>
                <span>Status Restock</span>

            </a>


            <!-- PROFILE -->

            <a href="{{ route('profile.edit') }}"
               class="active flex items-center gap-4
                      px-4 py-3 rounded-xl font-semibold">

                <span class="text-xl">👤</span>
                <span>Profil</span>

            </a>

        </nav>


        <!-- LOGOUT -->

        <div class="px-4 pb-6">

            <form method="POST"
                  action="{{ route('logout') }}">

                @csrf

                <button type="submit"
                        class="menu w-full flex items-center gap-4
                               px-4 py-3 rounded-xl text-left">

                    <span class="text-xl">🚪</span>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    </aside>


    <!-- ================= MAIN ================= -->

    <main class="flex-1">


        <!-- TOPBAR -->

        <header class="h-[76px]
                       bg-white
                       border-b border-[#eaded5]
                       flex items-center
                       justify-between
                       px-8">

            <button class="text-3xl brown">
                ☰
            </button>


            <div class="flex items-center gap-5">

                <span class="text-2xl">🔔</span>


                <div class="flex items-center gap-3">

                    <!-- FOTO HEADER -->

                    @if($user->profile_photo)

                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                             class="w-11 h-11 rounded-full object-cover border-2 border-[#713f24]">

                    @else

                        <div class="w-11 h-11
                                    rounded-full
                                    bg-[#713f24]
                                    text-white
                                    flex items-center
                                    justify-center
                                    text-xl">

                            👤

                        </div>

                    @endif


                    <div>

                        <p class="font-bold brown">
                            {{ $user->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ ucfirst($user->role ?? 'user') }}
                        </p>

                    </div>

                </div>

            </div>

        </header>


        <!-- CONTENT -->

        <section class="p-8 max-w-6xl mx-auto">


            <!-- TITLE -->

            <div class="mb-8">

                <p class="text-sm text-gray-500">
                    Pengaturan akun
                </p>

                <h2 class="text-4xl font-bold brown mt-1">
                    Setting Profil
                </h2>

                <p class="text-gray-600 mt-2">
                    Kelola informasi akun, foto profil, dan keamanan password Anda.
                </p>

            </div>


            <!-- SUCCESS PROFILE -->

            @if(session('success'))

                <div class="mb-6
                            bg-green-50
                            border border-green-200
                            text-green-700
                            px-5 py-4
                            rounded-xl">

                    ✓ {{ session('success') }}

                </div>

            @endif


            <!-- SUCCESS FOTO -->

            @if(session('success_photo'))

                <div class="mb-6
                            bg-green-50
                            border border-green-200
                            text-green-700
                            px-5 py-4
                            rounded-xl">

                    ✓ {{ session('success_photo') }}

                </div>

            @endif


            <!-- SUCCESS PASSWORD -->

            @if(session('success_password'))

                <div class="mb-6
                            bg-green-50
                            border border-green-200
                            text-green-700
                            px-5 py-4
                            rounded-xl">

                    ✓ {{ session('success_password') }}

                </div>

            @endif


            <!-- ERROR -->

            @if($errors->any())

                <div class="mb-6
                            bg-red-50
                            border border-red-200
                            text-red-700
                            px-5 py-4
                            rounded-xl">

                    <p class="font-bold mb-2">
                        Ada kesalahan:
                    </p>

                    <ul class="list-disc ml-5">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- ================= FOTO PROFIL ================= -->

            <div class="card rounded-2xl p-7 mb-6">

                <div class="flex items-center gap-4 mb-7">

                    <div class="w-14 h-14
                                rounded-full
                                bg-[#f7e9dc]
                                flex items-center
                                justify-center
                                text-3xl">

                        📷

                    </div>

                    <div>

                        <h3 class="text-xl font-bold brown">
                            Foto Profil
                        </h3>

                        <p class="text-sm text-gray-500">
                            Ganti foto profil akun Anda.
                        </p>

                    </div>

                </div>


                <!-- FOTO + DATA USER -->

                <div class="flex items-center gap-6 mb-7">

                    @if($user->profile_photo)

                        <img src="{{ asset('storage/' . $user->profile_photo) }}"
                             class="w-28 h-28
                                    rounded-full
                                    object-cover
                                    border-4
                                    border-[#713f24]
                                    shadow">

                    @else

                        <div class="w-28 h-28
                                    rounded-full
                                    bg-[#f7e9dc]
                                    border-4
                                    border-[#713f24]
                                    flex items-center
                                    justify-center
                                    text-5xl">

                            👤

                        </div>

                    @endif


                    <div>

                        <h3 class="text-xl font-bold brown">
                            {{ $user->name }}
                        </h3>

                        <p class="text-gray-500">
                            {{ $user->email }}
                        </p>

                        <p class="text-sm text-gray-400 mt-1">
                            {{ ucfirst($user->role ?? 'user') }}
                        </p>

                    </div>

                </div>


                <!-- FORM UPLOAD FOTO -->

                <form method="POST"
                      action="{{ route('profile.photo.update') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <label class="block font-semibold text-sm brown mb-2">
                        Pilih Foto Baru
                    </label>


                    <input type="file"
                           name="profile_photo"
                           accept="image/jpeg,image/png,image/webp"
                           required
                           class="w-full
                                  border border-gray-300
                                  rounded-xl
                                  px-4 py-3
                                  bg-white">


                    <p class="text-sm text-gray-500 mt-2">
                        JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </p>


                    <button type="submit"
                            class="mt-5
                                   bg-[#713f24]
                                   text-white
                                   px-6 py-3
                                   rounded-xl
                                   font-semibold
                                   hover:bg-[#5c321d]
                                   transition">

                        📷 Ganti Foto

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
                                class="text-red-600
                                       font-semibold
                                       hover:text-red-800">

                            🗑 Hapus Foto Profil

                        </button>

                    </form>

                @endif

            </div>


            <!-- ================= INFORMASI PROFIL ================= -->

            <div class="card rounded-2xl p-7 mb-6">

                <div class="flex items-center gap-4 mb-7">

                    <div class="w-14 h-14
                                rounded-full
                                bg-[#f7e9dc]
                                flex items-center
                                justify-center
                                text-3xl">

                        👤

                    </div>

                    <div>

                        <h3 class="text-xl font-bold brown">
                            Informasi Profil
                        </h3>

                        <p class="text-sm text-gray-500">
                            Ubah nama dan email akun Anda.
                        </p>

                    </div>

                </div>


                <form method="POST"
                      action="{{ route('profile.update') }}">

                    @csrf

                    @method('PATCH')


                    <!-- NAME -->

                    <div class="mb-5">

                        <label class="block
                                      font-semibold
                                      text-sm
                                      brown
                                      mb-2">

                            Nama Lengkap

                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               required
                               class="w-full
                                      border border-gray-300
                                      rounded-xl
                                      px-4 py-3">

                    </div>


                    <!-- EMAIL -->

                    <div class="mb-6">

                        <label class="block
                                      font-semibold
                                      text-sm
                                      brown
                                      mb-2">

                            Email

                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               required
                               class="w-full
                                      border border-gray-300
                                      rounded-xl
                                      px-4 py-3">

                    </div>


                    <button type="submit"
                            class="bg-[#713f24]
                                   text-white
                                   px-6 py-3
                                   rounded-xl
                                   font-semibold
                                   hover:bg-[#5c321d]
                                   transition">

                        Simpan Perubahan

                    </button>

                </form>

            </div>


            <!-- ================= PASSWORD ================= -->

            <div class="card rounded-2xl p-7">

                <div class="flex items-center gap-4 mb-7">

                    <div class="w-14 h-14
                                rounded-full
                                bg-yellow-100
                                flex items-center
                                justify-center
                                text-3xl">

                        🔒

                    </div>

                    <div>

                        <h3 class="text-xl font-bold brown">
                            Keamanan Akun
                        </h3>

                        <p class="text-sm text-gray-500">
                            Ganti password akun Anda.
                        </p>

                    </div>

                </div>


                <form method="POST"
                      action="{{ route('profile.password') }}">

                    @csrf

                    @method('PUT')


                    <!-- PASSWORD LAMA -->

                    <div class="mb-5">

                        <label class="block
                                      font-semibold
                                      text-sm
                                      brown
                                      mb-2">

                            Password Saat Ini

                        </label>

                        <input type="password"
                               name="current_password"
                               required
                               class="w-full
                                      border border-gray-300
                                      rounded-xl
                                      px-4 py-3">

                    </div>


                    <!-- PASSWORD BARU -->

                    <div class="mb-5">

                        <label class="block
                                      font-semibold
                                      text-sm
                                      brown
                                      mb-2">

                            Password Baru

                        </label>

                        <input type="password"
                               name="password"
                               required
                               class="w-full
                                      border border-gray-300
                                      rounded-xl
                                      px-4 py-3">

                    </div>


                    <!-- CONFIRM -->

                    <div class="mb-6">

                        <label class="block
                                      font-semibold
                                      text-sm
                                      brown
                                      mb-2">

                            Konfirmasi Password Baru

                        </label>

                        <input type="password"
                               name="password_confirmation"
                               required
                               class="w-full
                                      border border-gray-300
                                      rounded-xl
                                      px-4 py-3">

                    </div>


                    <button type="submit"
                            class="bg-[#713f24]
                                   text-white
                                   px-6 py-3
                                   rounded-xl
                                   font-semibold
                                   hover:bg-[#5c321d]
                                   transition">

                        Ubah Password

                    </button>

                </form>

            </div>


            <!-- FOOTER -->

            <div class="text-center
                        text-sm
                        text-gray-400
                        mt-8">

                © {{ date('Y') }}
                Book Stock SMKN5 ·
                Sistem Restock Buku Perpustakaan

            </div>

        </section>

    </main>

</div>

</body>
</html>