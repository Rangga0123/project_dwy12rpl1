@extends('user.layouts.app')

@section('title', 'Dashboard User')

@push('styles')
<style>
    .page-title {
        color: var(--brown);
        letter-spacing: -.45px;
    }

    /* CARDS */
    .card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: 0 2px 7px rgba(55,35,24,.035);
        transition: transform .2s ease,
                    box-shadow .2s ease,
                    border-color .2s ease;
        animation: rise-in .45s both;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(55,35,24,.075);
        border-color: #ddc9ba;
    }

    .stat-card:nth-child(2) { animation-delay: .05s; }
    .stat-card:nth-child(3) { animation-delay: .10s; }
    .stat-card:nth-child(4) { animation-delay: .15s; }

    .stat-label {
        font-size: 12px;
        color: #737373;
        font-weight: 600;
    }

    .stat-number {
        font-size: 29px;
        line-height: 1.15;
        font-weight: 700;
        color: var(--brown);
        margin-top: 9px;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 21px;
        background: #f5eee8;
        color: var(--brown);
        transition: transform .2s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.06);
    }

    .table-head {
        background: #f8f5f2;
        color: var(--brown);
    }

    .soft-link {
        color: var(--brown);
        transition: color .18s ease;
        text-decoration: none;
    }

    .soft-link:hover {
        color: var(--orange);
    }

    .empty-icon {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: #f5eee8;
        display: grid;
        place-items: center;
        font-size: 23px;
    }

    /* ANIMASI */
    @keyframes rise-in {
        from {
            opacity: 0;
            transform: translateY(9px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<section class="content-area p-7 lg:p-8">

    <!-- JUDUL -->
    <div
        class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6"
        style="animation: rise-in .4s both;">

        <div>
            <p class="text-xs uppercase tracking-wider text-stone-500 mb-2">
                Sistem Informasi Perpustakaan
            </p>

            <h2 class="page-title text-3xl font-bold">
                Dashboard
            </h2>

            <p class="text-sm text-stone-600 mt-2">
                Selamat datang kembali,
                <span class="font-semibold brown">
                    {{ Auth::user()->name ?? 'User' }}
                </span>
            </p>
        </div>

        <div>
            <p class="text-xs text-stone-500">
                Hari ini
            </p>

            <p class="text-sm font-semibold brown mt-1">
                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </p>
        </div>

    </div>

    <!-- KARTU STATISTIK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <div class="card stat-card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="stat-label">TOTAL BUKU</p>
                    <h3 class="stat-number count-up"
                        data-value="{{ $totalBuku ?? 0 }}">
                        {{ $totalBuku ?? 0 }}
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Buku tersedia di perpustakaan
                    </p>
                </div>
                <div class="stat-icon">▤</div>
            </div>
        </div>

        <div class="card stat-card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="stat-label">PENGAJUAN SAYA</p>
                    <h3 class="stat-number count-up"
                        data-value="{{ $totalPengajuan ?? 0 }}">
                        {{ $totalPengajuan ?? 0 }}
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Total pengajuan restock
                    </p>
                </div>
                <div class="stat-icon">▧</div>
            </div>
        </div>

        <div class="card stat-card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="stat-label">DISETUJUI</p>
                    <h3 class="stat-number count-up"
                        data-value="{{ $totalDisetujui ?? 0 }}">
                        {{ $totalDisetujui ?? 0 }}
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Pengajuan yang disetujui
                    </p>
                </div>
                <div class="stat-icon">✓</div>
            </div>
        </div>

        <div class="card stat-card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="stat-label">MENUNGGU</p>
                    <h3 class="stat-number count-up"
                        data-value="{{ $totalMenunggu ?? 0 }}">
                        {{ $totalMenunggu ?? 0 }}
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Pengajuan menunggu proses
                    </p>
                </div>
                <div class="stat-icon">◷</div>
            </div>
        </div>

    </div>

    <!-- STATUS RESTOCK TERBARU -->
    <div class="card overflow-hidden">

        <div class="px-5 sm:px-6 py-5 border-b border-stone-200
                    flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-3">

            <div>
                <h3 class="text-lg font-bold brown">
                    Status Restock Terbaru
                </h3>

                <p class="text-sm text-stone-500 mt-1">
                    Informasi terbaru mengenai pengajuan restock Anda
                </p>
            </div>

            <a href="{{ route('user.restock.history') }}"
               class="soft-link text-sm font-semibold">
                Lihat Semua <span aria-hidden="true">→</span>
            </a>

        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[620px]">

                <thead class="table-head">
                    <tr class="text-left text-xs uppercase tracking-wide">
                        <th class="px-5 sm:px-6 py-4 font-bold">No</th>
                        <th class="px-5 sm:px-6 py-4 font-bold">Buku</th>
                        <th class="px-5 sm:px-6 py-4 font-bold">Jumlah</th>
                        <th class="px-5 sm:px-6 py-4 font-bold">Tanggal Pengajuan</th>
                        <th class="px-5 sm:px-6 py-4 font-bold">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @if (isset($pengajuanTerbaru) && $pengajuanTerbaru->count())
                        @foreach ($pengajuanTerbaru as $item)
                            <tr class="border-t border-stone-100">
                                <td class="px-5 sm:px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-5 sm:px-6 py-4 font-medium">
                                    {{ $item->book->title ?? 'Buku tidak ditemukan' }}
                                </td>

                                <td class="px-5 sm:px-6 py-4">
                                    {{ $item->jumlah }}
                                </td>

                                <td class="px-5 sm:px-6 py-4">
                                    {{ $item->created_at?->format('d-m-Y') ?? '-' }}
                                </td>

                                <td class="px-5 sm:px-6 py-4">
                                    @if ($item->status === 'menunggu')
                                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                            Menunggu
                                        </span>
                                    @elseif ($item->status === 'disetujui')
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Disetujui
                                        </span>
                                    @else
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="empty-icon mb-4">▤</div>

                                    <h4 class="font-semibold text-base brown">
                                        Belum ada pengajuan restock
                                    </h4>

                                    <p class="text-sm text-stone-500 mt-2 max-w-md">
                                        Pengajuan restock yang Anda buat akan muncul
                                        di bagian ini.
                                    </p>

                                    <a
                                        href="{{ route('user.restock.create') }}"
                                        class="mt-5 inline-flex items-center gap-2
                                               px-4 py-2.5 bg-[#70432d] text-white
                                               rounded-lg text-sm font-semibold
                                               hover:bg-[#5d3523] transition">
                                        <span class="text-lg leading-none">＋</span>
                                        Ajukan Restock
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>

            </table>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="text-center text-xs text-stone-400 mt-7">
        © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
    </footer>

</section>
@endsection

@push('scripts')
<script>
    // Animasi angka statistik
    document.querySelectorAll('.count-up').forEach((element) => {
        const target = Number(element.dataset.value || 0);

        if (
            !Number.isFinite(target) ||
            target <= 0 ||
            window.matchMedia('(prefers-reduced-motion: reduce)').matches
        ) {
            return;
        }

        const duration = 550;
        const startTime = performance.now();

        const animate = (now) => {
            const progress = Math.min((now - startTime) / duration, 1);

            element.textContent = Math.round(
                target * progress
            ).toLocaleString('id-ID');

            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };

        requestAnimationFrame(animate);
    });
</script>
@endpush