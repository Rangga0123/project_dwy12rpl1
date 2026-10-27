@extends('user.layouts.app')

@section('title', 'Riwayat Restock')

@push('styles')
<style>
    .card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: 0 2px 7px rgba(55,35,24,.035);
    }

    .table-head {
        background: #f8f5f2;
        color: var(--brown);
    }

    .status-badge {
        display: inline-block;
        border-radius: 999px;
        padding: 5px 11px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #ffedd5;
        color: #c2410c;
    }

    .status-disetujui {
        background: #dcfce7;
        color: #15803d;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #b91c1c;
    }

    @keyframes rise-in {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .page-content {
        animation: rise-in .4s ease both;
    }
</style>
@endpush

@section('content')
<section class="content-area p-7 lg:p-8 page-content">

    <div class="mb-6">
        <h2 class="text-3xl font-bold brown tracking-tight">
            Riwayat Restock
        </h2>
        <p class="text-sm text-stone-500 mt-2">
            Lihat semua pengajuan restock yang pernah Anda kirim.
        </p>
    </div>

    @if (session('success'))
        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="card overflow-hidden">

        <div class="px-5 sm:px-6 py-5 border-b border-stone-200
                    flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-3">
            <div>
                <h3 class="text-lg font-bold brown">
                    Daftar Pengajuan Restock
                </h3>
                <p class="text-sm text-stone-500 mt-1">
                    Riwayat pengajuan yang telah Anda buat.
                </p>
            </div>

            <a href="{{ route('user.restock.create') }}"
               class="inline-flex items-center justify-center px-4 py-2.5
                      rounded-lg bg-[#70432d] text-white text-sm font-semibold
                      hover:bg-[#5d3523] transition">
                + Pengajuan Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] text-sm">

                <thead class="table-head">
                    <tr class="text-left text-xs uppercase tracking-wide">
                        <th class="px-4 py-4">No</th>
                        <th class="px-4 py-4">Buku</th>
                        <th class="px-4 py-4">Jumlah</th>
                        <th class="px-4 py-4">Alasan</th>
                        <th class="px-4 py-4">Tanggal</th>
                        <th class="px-4 py-4">Status</th>
                        <th class="px-4 py-4">Catatan Admin</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-stone-100">

                    @forelse ($requests as $request)
                        <tr class="hover:bg-stone-50 transition-colors">

                            <td class="px-4 py-4 text-stone-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-4 font-semibold brown">
                                {{ $request->book->title ?? 'Buku tidak ditemukan' }}
                            </td>

                            <td class="px-4 py-4">
                                {{ $request->jumlah }}
                                buku
                            </td>

                            <td class="px-4 py-4 text-stone-600">
                                {{ $request->alasan ?: '-' }}
                            </td>

                            <td class="px-4 py-4 text-stone-600 whitespace-nowrap">
                                {{ $request->created_at?->format('d/m/Y H:i') ?? '-' }}
                            </td>

                            <td class="px-4 py-4">
                                @if ($request->status === 'menunggu')
                                    <span class="status-badge status-menunggu">
                                        Menunggu
                                    </span>
                                @elseif ($request->status === 'disetujui')
                                    <span class="status-badge status-disetujui">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="status-badge status-ditolak">
                                        Ditolak
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4 text-stone-600">
                                {{ $request->catatan_admin ?: '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-14 text-center">
                                <div class="text-3xl mb-3">▤</div>
                                <p class="font-semibold brown">
                                    Belum ada pengajuan restock
                                </p>
                                <p class="text-sm text-stone-500 mt-2">
                                    Pengajuan yang kamu buat akan muncul di sini.
                                </p>
                                <a href="{{ route('user.restock.create') }}"
                                   class="inline-flex mt-5 px-4 py-2.5 rounded-lg
                                          bg-[#70432d] text-white text-sm font-semibold
                                          hover:bg-[#5d3523] transition">
                                    + Ajukan Restock
                                </a>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <footer class="text-center text-xs text-stone-400 mt-7">
        © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
    </footer>

</section>
@endsection