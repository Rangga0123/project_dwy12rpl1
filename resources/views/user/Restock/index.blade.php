@extends('user.layouts.app')

@section('title', 'Pengajuan Restock')

@push('styles')
<style>
    .page-title {
        color: var(--brown);
        letter-spacing: -.45px;
    }

    .restock-card {
        background: white;
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: 0 2px 7px rgba(55,35,24,.035);
        transition: transform .2s ease, box-shadow .2s ease,
                    border-color .2s ease;
        animation: rise-in .45s both;
    }

    .restock-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(55,35,24,.075);
        border-color: #ddc9ba;
    }

    .info-icon {
        width: 43px;
        height: 43px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        font-size: 21px;
        background: #f5eee8;
        color: var(--brown);
        flex-shrink: 0;
    }

    .primary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        background: var(--brown);
        color: white;
        border-radius: 8px;
        padding: 12px 18px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: background .2s ease, transform .2s ease;
    }

    .primary-btn:hover {
        background: var(--brown-dark);
        transform: translateY(-1px);
    }

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

    @media (prefers-reduced-motion: reduce) {
        .restock-card {
            animation: none;
            transition: none;
        }
    }
</style>
@endpush

@section('content')

<section class="content-area p-7 lg:p-8">

    {{-- JUDUL HALAMAN --}}
    <div
        class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6"
        style="animation: rise-in .4s both;"
    >
        <div>
            <p class="text-xs uppercase tracking-wider text-stone-500 mb-2">
                Sistem Informasi Perpustakaan
            </p>

            <h2 class="page-title text-3xl font-bold">
                Pengajuan Restock
            </h2>

            <p class="text-sm text-stone-600 mt-2">
                Halo,
                <span class="font-semibold brown">
                    {{ Auth::user()->name ?? 'User' }}
                </span>.
                Ajukan penambahan stok buku perpustakaan di sini.
            </p>
        </div>

        <div>
            <p class="text-xs text-stone-500">Hari ini</p>

            <p class="text-sm font-semibold brown mt-1">
                {{ now()->translatedFormat('d F Y') }}
            </p>
        </div>
    </div>

    {{-- PESAN BERHASIL --}}
    @if (session('success'))
        <div
            class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
            role="status"
        >
            {{ session('success') }}
        </div>
    @endif

    {{-- PESAN ERROR --}}
    @if (session('error'))
        <div
            class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
            role="alert"
        >
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDASI --}}
    @if ($errors->any())
        <div
            class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
            role="alert"
        >
            <p class="font-bold mb-2">
                Ada data yang perlu diperbaiki:
            </p>

            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- BANNER PENGAJUAN --}}
    <div class="restock-card p-6 sm:p-8 mb-7">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

            <div class="flex items-start gap-4">
                <div class="info-icon">▤</div>

                <div class="max-w-2xl">
                    <p
                        class="text-xs font-bold uppercase tracking-wider"
                        style="color: var(--orange);"
                    >
                        Layanan Perpustakaan
                    </p>

                    <h3 class="text-xl sm:text-2xl font-bold brown mt-2">
                        Ajukan Penambahan Stok Buku
                    </h3>

                    <p class="text-sm text-stone-600 mt-3 leading-6">
                        Pilih buku yang membutuhkan penambahan stok,
                        tentukan jumlah yang dibutuhkan, lalu kirim
                        pengajuan kepada admin untuk ditinjau.
                    </p>
                </div>
            </div>

            <div class="flex shrink-0">
                <a
                    href="{{ route('user.restock.create') }}"
                    class="primary-btn"
                >
                    <span class="text-lg leading-none">＋</span>
                    Buat Pengajuan
                </a>
            </div>

        </div>
    </div>

    {{-- PETUNJUK PENGAJUAN --}}
    <div class="mb-4">
        <h3 class="text-lg font-bold brown">
            Cara Mengajukan Restock
        </h3>

        <p class="text-sm text-stone-500 mt-1">
            Ikuti tiga langkah sederhana berikut.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- LANGKAH 1 --}}
        <div class="restock-card p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="info-icon">01</div>

                <h4 class="font-bold brown">
                    Pilih Buku
                </h4>
            </div>

            <p class="text-sm text-stone-600 leading-6">
                Pilih buku yang terdaftar di Data Buku.
            </p>
        </div>

        {{-- LANGKAH 2 --}}
        <div class="restock-card p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="info-icon">02</div>

                <h4 class="font-bold brown">
                    Isi Pengajuan
                </h4>
            </div>

            <p class="text-sm text-stone-600 leading-6">
                Masukkan jumlah buku dan alasan pengajuan.
            </p>
        </div>

        {{-- LANGKAH 3 --}}
        <div class="restock-card p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="info-icon">03</div>

                <h4 class="font-bold brown">
                    Kirim Pengajuan
                </h4>
            </div>

            <p class="text-sm text-stone-600 leading-6">
                Kirim permintaan kepada admin untuk ditinjau
                dan mendapatkan keputusan.
            </p>
        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="text-center text-xs text-stone-400 mt-7">
        © {{ date('Y') }} Book Stock SMKN 5 ·
        Sistem Restock Buku Perpustakaan
    </footer>

</section>

@endsection