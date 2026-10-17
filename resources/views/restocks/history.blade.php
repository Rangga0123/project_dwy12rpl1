<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Restock - Book Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-stone-100 p-4 text-stone-800 sm:p-8">
    <main class="mx-auto max-w-5xl">
        <a href="{{ route('restock.create') }}"
           class="text-sm font-semibold text-blue-700">← Buat Pengajuan</a>

        <h1 class="mt-4 text-2xl font-bold">Riwayat Pengajuan Restock</h1>

        @if (session('success'))
            <p class="mt-4 rounded-lg bg-green-50 p-3 text-green-700">
                {{ session('success') }}
            </p>
        @endif

        <div class="mt-5 space-y-4">
            @forelse ($requests as $item)
                <article class="rounded-xl border border-stone-200 bg-white p-5 shadow-sm">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <h2 class="font-bold">
                                {{ $item->book->judul ?? $item->book->title ?? $item->book->nama_buku ?? 'Buku' }}
                            </h2>
                            <p class="mt-1 text-sm text-stone-500">
                                Jumlah: {{ $item->jumlah }}
                                · {{ $item->created_at->format('d-m-Y H:i') }}
                            </p>
                        </div>
                        <span class="rounded-full bg-stone-100 px-3 py-1 text-sm font-semibold">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>

                    <p class="mt-3 text-sm">
                        <strong>Alasan:</strong> {{ $item->alasan }}
                    </p>

                    @if ($item->catatan_admin)
                        <p class="mt-2 text-sm text-stone-600">
                            <strong>Catatan Admin:</strong> {{ $item->catatan_admin }}
                        </p>
                    @endif
                </article>
            @empty
                <div class="rounded-xl bg-white p-8 text-center text-stone-500">
                    Belum ada pengajuan restock.
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>