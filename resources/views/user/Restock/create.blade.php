<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengajuan Restock</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-950 text-white min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-black/80 border-b border-white/10 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <div class="font-bold text-xl tracking-wider">
                BOOK STOCK
            </div>

            <div class="flex items-center gap-6 text-sm">

                <a href="{{ route('dashboard') }}"
                   class="text-gray-400 hover:text-white">
                    Dashboard
                </a>

                <a href="{{ route('books.index') }}"
                   class="text-gray-400 hover:text-white">
                    Data Buku
                </a>

                <a href="{{ route('user.restock.create') }}"
                   class="text-white font-semibold">
                    Pengajuan Restock
                </a>

                <a href="{{ route('user.restock.history') }}"
                   class="text-gray-400 hover:text-white">
                    Riwayat Restock
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="text-gray-400 hover:text-white">
                    Profil
                </a>

            </div>

        </div>
    </nav>


    <!-- CONTENT -->
    <main class="max-w-3xl mx-auto px-6 py-10">

        <div class="mb-8">
            <p class="text-blue-400 text-sm uppercase tracking-widest">
                USER
            </p>

            <h1 class="text-3xl font-bold mt-2">
                Pengajuan Restock
            </h1>

            <p class="text-gray-400 mt-2">
                Ajukan penambahan stok buku yang dibutuhkan.
            </p>
        </div>


        @if(session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500/30
                        text-green-400 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif


        @if($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/30
                        text-red-400 px-4 py-3 rounded-lg">

                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        <!-- FORM -->
        <div class="bg-white/5 border border-white/10
                    rounded-2xl p-7 shadow-xl">

            <form action="{{ route('user.restock.store') }}"
                  method="POST">

                @csrf


                <!-- PILIH BUKU -->
<div class="mb-6">

    <label class="block text-sm font-semibold mb-2">
        Pilih Buku
    </label>

    <select name="book_id"
            required
            class="w-full bg-gray-900 border border-gray-700
                   rounded-lg px-4 py-3
                   text-white focus:border-blue-500
                   focus:outline-none">

        <option value="">
            -- Pilih Buku --
        </option>

        @forelse($books as $book)

            <option value="{{ $book->id }}"
                {{ old('book_id') == $book->id ? 'selected' : '' }}>

                {{ $book->title }} — Stok: {{ $book->stock }}

            </option>

        @empty

            <option value="" disabled>
                Belum ada data buku
            </option>

        @endforelse

    </select>

</div>