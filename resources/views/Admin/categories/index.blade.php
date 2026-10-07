<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kategori Buku - Book Stock SMKN 5</title>

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
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateX(4px);
        }

        .card {
            background: #ffffff;
            border: 1px solid #e2ddd9;
            box-shadow: 0 3px 12px rgba(70, 45, 30, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(74, 45, 30, 0.12);
        }

        .input-field {
            transition: all 0.2s ease;
        }

        .input-field:focus {
            border-color: #6b3f28;
            box-shadow: 0 0 0 3px rgba(107, 63, 40, 0.08);
            outline: none;
        }

        .save-button {
            transition: all 0.2s ease;
        }

        .save-button:hover {
            background: #56321f;
            transform: translateY(-1px);
        }

        .table-row {
            transition: background 0.2s ease;
        }

        .table-row:hover {
            background: #faf7f4;
        }

        .delete-button {
            transition: all 0.2s ease;
        }

        .delete-button:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        .page-enter {
            animation: pageEnter 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
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

        .success-message {
            animation: successIn 0.3s ease;
        }

        @keyframes successIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .school-logo {
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .school-logo:hover {
            transform: scale(1.06) rotate(2deg);
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
            <a
                href="{{ route('dashboard') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 10.5L12 3l9 7.5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 9.5V21h14V9.5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 21v-6h6v6"
                    />
                </svg>

                <span class="text-sm">
                    Dashboard
                </span>

            </a>


            <!-- Data Buku -->
            <a
                href="{{ route('books.index') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 17a2 2 0 012-2h12"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 7h6M9 10h5"
                    />
                </svg>

                <span class="text-sm">
                    Data Buku
                </span>

            </a>


            <!-- Kategori Buku -->
            <a
                href="{{ route('categories.index') }}"
                class="menu-item menu-active flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"
                    />
                </svg>

                <span class="text-sm">
                    Kategori Buku
                </span>

            </a>


            <!-- Supplier -->
            <a
                href="#"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 21h18"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 21V7l7-4 7 4v14"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 21v-5h6v5M9 9h.01M12 9h.01M15 9h.01"
                    />
                </svg>

                <span class="text-sm">
                    Supplier
                </span>

            </a>


            <!-- Pengajuan Restock -->
            <a
                href="#"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 3h9l3 3v15H6V3z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14 3v4h4M9 12h6M9 15h6"
                    />
                </svg>

                <span class="text-sm">
                    Pengajuan Restock
                </span>

            </a>


            <!-- Riwayat Restock -->
            <a
                href="#"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 5h16v14H4z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 9h8M8 12h8M8 15h5"
                    />
                </svg>

                <span class="text-sm">
                    Riwayat Restock
                </span>

            </a>


            <!-- Laporan -->
            <a
                href="#"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 20V10M12 20V4M19 20v-7"
                    />
                </svg>

                <span class="text-sm">
                    Laporan
                </span>

            </a>


            <!-- Profil -->
            <a
                href="{{ route('profile.edit') }}"
                class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <circle
                        cx="12"
                        cy="8"
                        r="3"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 20a7 7 0 0114 0"
                    />
                </svg>

                <span class="text-sm">
                    Profil
                </span>

            </a>

        </nav>


        <!-- LOGOUT -->
        <div class="absolute bottom-5 left-3 right-3">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="menu-item w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600/80 text-left"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 17l5-5-5-5M15 12H3"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 19V5a2 2 0 00-2-2h-5"
                        />
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
                    Dashboard
                </h2>

                <p id="greeting-text" class="text-sm text-gray-500 mt-1">
                    Selamat datang kembali, {{ Auth::user()->name }}.
                </p>

            </div>


            <div class="flex items-center gap-3">

                <div class="text-right">

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
                        class="w-10 h-10 rounded-full object-cover border-2 border-[#6b3f28]"
                    >

                @else

                    <div class="w-10 h-10 rounded-full bg-[#f4eee9] brown flex items-center justify-center shadow-inner">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >

                            <circle
                                cx="12"
                                cy="8"
                                r="3"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 20a7 7 0 0114 0"
                            />

                        </svg>

                    </div>

                @endif

            </div>

        </header>


        <!-- CONTENT -->
        <section class="p-8 page-enter">


            <!-- SUCCESS -->
            @if(session('success'))

                <div class="success-message mb-6 px-5 py-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-semibold">

                    {{ session('success') }}

                </div>

            @endif


            <!-- CONTENT GRID -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


                <!-- TAMBAH KATEGORI -->
                <div class="card rounded-xl p-6 h-fit">

                    <div class="flex items-center justify-between mb-6">

                        <div>

                            <h3 class="text-xl font-bold brown">
                                Tambah Kategori
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Tambahkan kategori buku baru
                            </p>

                        </div>


                        <div class="w-10 h-10 rounded-lg bg-[#f4e9df] flex items-center justify-center brown text-xl">

                            +

                        </div>

                    </div>


                    <!-- FORM -->
                    <form
                        action="{{ route('categories.store') }}"
                        method="POST"
                    >

                        @csrf


                        <!-- NAMA KATEGORI -->
                        <div class="mb-5">

                            <label class="block text-sm font-semibold brown mb-2">
                                Nama Kategori
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                placeholder="Contoh: Pelajaran"
                                class="input-field w-full h-11 px-4 rounded-lg border border-gray-300 text-sm text-gray-700"
                            >

                            @error('name')
                                <p class="text-red-500 text-xs mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- DESKRIPSI -->
                        <div class="mb-6">

                            <label class="block text-sm font-semibold brown mb-2">

                                Deskripsi

                                <span class="font-normal text-gray-400">
                                    (Opsional)
                                </span>

                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                placeholder="Masukkan deskripsi kategori..."
                                class="input-field w-full px-4 py-3 rounded-lg border border-gray-300 text-sm text-gray-700 resize-none"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="text-red-500 text-xs mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- SIMPAN -->
                        <button
                            type="submit"
                            class="save-button w-full h-11 rounded-lg bg-[#6b3f28] text-white text-sm font-semibold"
                        >
                            Simpan Kategori
                        </button>

                    </form>

                </div>


                <!-- DAFTAR KATEGORI -->
                <div class="card rounded-xl overflow-hidden xl:col-span-2">


                    <!-- TABLE HEADER -->
                    <div class="p-6 border-b border-gray-200">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="text-xl font-bold brown">
                                    Daftar Kategori
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Data kategori buku yang tersedia
                                </p>

                            </div>


                            <div class="px-3 py-2 rounded-lg bg-[#f4e9df] brown text-sm font-semibold">

                                {{ $categories->count() }} Kategori

                            </div>

                        </div>

                    </div>


                    <!-- TABLE -->
                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-[#f7f4f1]">

                                <tr class="border-b border-gray-200">

                                    <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">
                                        No
                                    </th>

                                    <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">
                                        Nama Kategori
                                    </th>

                                    <th class="px-5 py-4 text-left text-xs font-bold brown uppercase">
                                        Deskripsi
                                    </th>

                                    <th class="px-5 py-4 text-center text-xs font-bold brown uppercase">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @forelse ($categories as $index => $category)

                                    <tr class="table-row">


                                        <!-- NOMOR -->
                                        <td class="px-5 py-5 text-sm text-gray-500">
                                            {{ $index + 1 }}
                                        </td>


                                        <!-- NAMA -->
                                        <td class="px-5 py-5">

                                            <span class="text-sm font-bold brown">
                                                {{ $category->name }}
                                            </span>

                                        </td>


                                        <!-- DESKRIPSI -->
                                        <td class="px-5 py-5 text-sm text-gray-600">

                                            {{ $category->description ?? '-' }}

                                        </td>


                                        <!-- AKSI -->
                                        <td class="px-5 py-5 text-center">

                                            <form
                                                action="{{ route('categories.destroy', $category->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="delete-button px-4 py-2 rounded-lg border border-red-200 bg-red-50 text-red-600 text-sm font-semibold"
                                                >
                                                    Hapus
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="4"
                                            class="px-5 py-14 text-center"
                                        >

                                            <p class="text-sm font-semibold text-gray-500">
                                                Belum ada kategori buku.
                                            </p>

                                            <p class="text-xs text-gray-400 mt-1">
                                                Tambahkan kategori melalui form di sebelah kiri.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>


            <!-- FOOTER -->
            <div class="text-center text-xs text-gray-400 mt-8">

                © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan

            </div>

        </section>

    </main>

</div>

</body>
</html>