@extends('user.layouts.app')

@section('title', 'Data Buku')

@push('styles')
<style>
    .page-title {
        color: var(--brown);
        letter-spacing: -.45px;
    }

    /* KARTU */
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

    /* TABEL DATA BUKU */
    .book-search {
        width: 100%;
        max-width: 290px;
        padding: 10px 12px;
        border: 1px solid #e3d9d1;
        border-radius: 8px;
        background: #fff;
        font-size: 13px;
        outline: none;
        color: #292524;
    }

    .book-search:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 2px rgba(217,107,36,.10);
    }

    .book-table {
        width: 100%;
        min-width: 600px;
        border-collapse: collapse;
    }

    .book-table th {
        padding: 14px 18px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        background: #f8f5f2;
        color: var(--brown);
        border-bottom: 1px solid var(--line);
    }

    .book-table td {
        padding: 16px 18px;
        font-size: 13px;
        border-bottom: 1px solid #f0ebe7;
    }

    .book-table tbody tr:last-child td {
        border-bottom: none;
    }

    .book-table tbody tr:hover {
        background: #fcfaf8;
    }

    .stock-badge {
        display: inline-block;
        min-width: 40px;
        padding: 5px 10px;
        border-radius: 20px;
        text-align: center;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-ok {
        background: #dcfce7;
        color: #166534;
    }

    .stock-low {
        background: #fef3c7;
        color: #92400e;
    }

    .stock-empty {
        background: #fee2e2;
        color: #991b1b;
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

    @media (max-width: 1023px) {
        .book-search {
            max-width: none;
        }
    }
</style>
@endpush

@section('content')
<section class="content-area p-7 lg:p-8">

    <!-- JUDUL -->
    <div class="mb-6" style="animation: rise-in .4s both;">
        <p class="text-xs uppercase tracking-wider text-stone-500 mb-2">
            Sistem Informasi Perpustakaan
        </p>

        <h2 class="page-title text-3xl font-bold">
            Data Buku
        </h2>

        <p class="text-sm text-stone-600 mt-2">
            Daftar buku dan ketersediaan stok di perpustakaan.
        </p>
    </div>

    <!-- PESAN SUKSES -->
    @if (session('success'))
        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- PESAN ERROR -->
    @if (session('error'))
        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <!-- KARTU STATISTIK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-6">

        <div class="card stat-card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="stat-label">TOTAL JUDUL BUKU</p>
                    <h3 class="stat-number">
                        {{ $books->count() }}
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Jenis buku terdaftar
                    </p>
                </div>
                <div class="stat-icon">▤</div>
            </div>
        </div>

        <div class="card stat-card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="stat-label">TOTAL STOK</p>
                    <h3 class="stat-number">
                        {{ $books->sum('stock') }}
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Seluruh stok buku
                    </p>
                </div>
                <div class="stat-icon">≡</div>
            </div>
        </div>

        <div class="card stat-card p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="stat-label">STOK HABIS</p>
                    <h3 class="stat-number">
                        {{ $books->filter(fn ($book) => ($book->stock ?? 0) <= 0)->count() }}
                    </h3>
                    <p class="text-xs text-stone-500 mt-2">
                        Buku tanpa stok
                    </p>
                </div>
                <div class="stat-icon">!</div>
            </div>
        </div>

    </div>

    <!-- TABEL BUKU -->
    <div class="card overflow-hidden">

        <div class="px-5 sm:px-6 py-5 border-b border-stone-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold brown">
                        Daftar Buku Perpustakaan
                    </h3>
                    <p class="text-sm text-stone-500 mt-1">
                        Lihat judul, kategori, dan jumlah stok buku.
                    </p>
                </div>

                <input
                    type="search"
                    id="searchBook"
                    class="book-search"
                    placeholder="Cari judul atau kategori buku..."
                    aria-label="Cari judul atau kategori buku">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="book-table">

                <thead>
                    <tr class="table-head">
                        <th style="width:70px">No.</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th style="width:130px">Stok</th>
                    </tr>
                </thead>

                <tbody id="bookTableBody">

                    @forelse ($books as $index => $book)
                        <tr class="book-row">
                            <td class="text-stone-500">
                                {{ $index + 1 }}
                            </td>

                            <td>
                                <p class="font-semibold brown book-title">
                                    {{ $book->title }}
                                </p>
                                <p class="text-xs text-stone-400 mt-1">
                                    ID Buku: {{ $book->id }}
                                </p>
                            </td>

                            <td class="book-category text-stone-600">
                                {{ $book->category->name ?? 'Tanpa Kategori' }}
                            </td>

                            <td>
                                @if (($book->stock ?? 0) <= 0)
                                    <span class="stock-badge stock-empty">
                                        Habis
                                    </span>
                                @elseif (($book->stock ?? 0) <= 5)
                                    <span class="stock-badge stock-low">
                                        {{ $book->stock }} buku
                                    </span>
                                @else
                                    <span class="stock-badge stock-ok">
                                        {{ $book->stock }} buku
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyBooks">
                            <td colspan="4" class="text-center py-12">
                                <p class="font-semibold brown">
                                    Belum ada data buku
                                </p>
                                <p class="text-sm text-stone-500 mt-2">
                                    Data buku akan ditampilkan di sini.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="noSearchResult" class="hidden">
                        <td colspan="4" class="text-center py-10 text-stone-500">
                            Buku yang dicari tidak ditemukan.
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="px-5 sm:px-6 py-4 border-t border-stone-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <p class="text-xs text-stone-500">
                Total <span id="visibleBookCount">{{ $books->count() }}</span>
                buku ditampilkan.
            </p>

            <p class="text-xs text-stone-400">
                Book Stock SMKN 5
            </p>
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
    // PENCARIAN JUDUL DAN KATEGORI
    const searchInput = document.getElementById('searchBook');
    const rows = [...document.querySelectorAll('.book-row')];
    const noResult = document.getElementById('noSearchResult');
    const countLabel = document.getElementById('visibleBookCount');

    searchInput?.addEventListener('input', function () {
        const keyword = this.value.trim().toLowerCase();
        let visibleCount = 0;

        rows.forEach(row => {
            const title = row.querySelector('.book-title')?.textContent.toLowerCase() || '';
            const category = row.querySelector('.book-category')?.textContent.toLowerCase() || '';
            const matched = title.includes(keyword) || category.includes(keyword);

            row.classList.toggle('hidden', !matched);

            if (matched) visibleCount++;
        });

        if (noResult) {
            noResult.classList.toggle(
                'hidden',
                visibleCount > 0 || rows.length === 0
            );
        }

        if (countLabel) {
            countLabel.textContent = visibleCount;
        }
    });
</script>
@endpush