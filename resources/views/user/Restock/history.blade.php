<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Restock</title>

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
                   class="text-gray-400 hover:text-white">
                    Pengajuan Restock
                </a>

                <a href="{{ route('user.restock.history') }}"
                   class="text-white font-semibold">
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
    <main class="max-w-6xl mx-auto px-6 py-10">

        <div class="mb-8">

            <p class="text-blue-400 text-sm uppercase tracking-widest">
                USER
            </p>

            <h1 class="text-3xl font-bold mt-2">
                Riwayat Pengajuan Restock
            </h1>

            <p class="text-gray-400 mt-2">
                Daftar pengajuan restock yang pernah kamu kirim.
            </p>

        </div>


        <!-- TABLE -->
        <div class="bg-white/5 border border-white/10
                    rounded-2xl overflow-hidden shadow-xl">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-white/5">

                        <tr class="text-left text-gray-400">

                            <th class="px-6 py-4">
                                No
                            </th>

                            <th class="px-6 py-4">
                                Buku
                            </th>

                            <th class="px-6 py-4">
                                Jumlah
                            </th>

                            <th class="px-6 py-4">
                                Alasan
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                            <th class="px-6 py-4">
                                Tanggal
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-white/10">

                        @forelse($requests as $request)

                            <tr class="hover:bg-white/5 transition">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-semibold">

                                    {{ $request->book->title ?? 'Buku tidak ditemukan' }}

                                </td>

                                <td class="px-6 py-4">

                                    {{ $request->jumlah }}

                                </td>

                                <td class="px-6 py-4 text-gray-400">

                                    {{ $request->alasan ?? '-' }}

                                </td>

                                <td class="px-6 py-4">

                                    @if($request->status === 'menunggu')

                                        <span class="px-3 py-1 rounded-full
                                                     text-xs bg-yellow-500/10
                                                     text-yellow-400
                                                     border border-yellow-500/20">

                                            Menunggu

                                        </span>

                                    @elseif($request->status === 'disetujui')

                                        <span class="px-3 py-1 rounded-full
                                                     text-xs bg-green-500/10
                                                     text-green-400
                                                     border border-green-500/20">

                                            Disetujui

                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full
                                                     text-xs bg-red-500/10
                                                     text-red-400
                                                     border border-red-500/20">

                                            Ditolak

                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4 text-gray-400">

                                    {{ $request->created_at->format('d/m/Y H:i') }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="px-6 py-12 text-center text-gray-500">

                                    Belum ada pengajuan restock.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <!-- BUTTON -->
        <div class="mt-6">

            <a href="{{ route('user.restock.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-500
                      px-5 py-3 rounded-lg font-semibold transition">

                + Buat Pengajuan Baru

            </a>

        </div>

    </main>

</body>
</html>