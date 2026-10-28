@extends('admin.layouts.app')

@section('title', 'Data Buku - Book Stock SMKN 5')

@section('content')
<style>
    .books-page {
        --brown: #6b3f28;
        --dark: #4f2d1d;
        --orange: #d96b24;
        --muted: #81756d;
        padding: 24px;
        color: #33271f;
        font-family: Arial, Helvetica, sans-serif;
    }

    .books-page * { box-sizing: border-box; }

    .books-page .page-header,
    .books-page .card-heading,
    .books-page .table-toolbar,
    .books-page .pagination-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
    }

    .books-page .page-header { margin-bottom: 24px; }

    .books-page .page-title {
        margin: 0;
        color: var(--brown);
        font-size: 27px;
        font-weight: 800;
    }

    .books-page .page-subtitle {
        margin: 7px 0 0;
        color: var(--muted);
        font-size: 13px;
    }

    .books-page .header-actions,
    .books-page .toolbar-left,
    .books-page .toolbar-right,
    .books-page .action-buttons,
    .books-page .books-pagination {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .books-page .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 13px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
        white-space: nowrap;
    }

    .books-page .btn:hover,
    .books-page .action-btn:hover {
        filter: brightness(.95);
    }

    .books-page .btn-brown { background: var(--brown); color: #fff; }
    .books-page .btn-green { background: #198754; color: #fff; }
    .books-page .btn-red { background: #dc3545; color: #fff; }

    .books-page .btn-outline {
        background: #fff;
        color: #51443b;
        border-color: #d5d0ca;
    }

    .books-page .icon {
        display: inline-flex;
        width: 16px;
        height: 16px;
        align-items: center;
        justify-content: center;
    }

    .books-page .icon svg {
        width: 16px;
        height: 16px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.9;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .books-page .books-card {
        overflow: visible;
        background: #fff;
        border: 1px solid #e8e1db;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(69,43,26,.05);
    }

    .books-page .card-heading {
        padding: 20px 22px;
        border-bottom: 1px solid #eee7e1;
    }

    .books-page .card-heading h2 {
        margin: 0;
        color: var(--brown);
        font-size: 17px;
        font-weight: 800;
    }

    .books-page .card-heading p {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 12px;
    }

    .books-page .table-toolbar { padding: 17px 22px; }

    .books-page .search-input {
        width: 280px;
        max-width: 100%;
        padding: 10px 12px;
        border: 1px solid #d5d0ca;
        border-radius: 8px;
        outline: none;
        font-size: 12px;
    }

    .books-page .search-input:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(217,107,36,.12);
    }

    .books-page .table-wrapper {
        width: 100%;
        overflow-x: auto;
        padding: 0 22px 20px;
    }

    .books-page .book-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
        border: 1px solid #d5d0ca;
        background: #fff;
        font-size: 12px;
    }

    .books-page .book-table th,
    .books-page .book-table td {
        padding: 12px;
        border: 1px solid #d5d0ca;
        text-align: left;
        vertical-align: middle;
    }

    .books-page .book-table thead th {
        background: #f4e9df;
        color: var(--brown);
        font-weight: 800;
        white-space: nowrap;
    }

    .books-page .book-table tbody tr:nth-child(even) { background: #fcfaf8; }
    .books-page .book-table tbody tr:hover { background: #fff2e8; }
    .books-page .book-table tr[hidden] { display: none !important; }
    .books-page .book-table [data-col][hidden] { display: none !important; }
    .books-page .text-center { text-align: center !important; }

    .books-page .book-title {
        min-width: 170px;
        color: #392a20;
        font-weight: 700;
    }

    .books-page .stock-badge,
    .book-detail-stock {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 6px;
        background: #e8f7ee;
        color: #187443;
        text-align: center;
        font-size: 11px;
        font-weight: 800;
    }

    .books-page .stock-low,
    .book-detail-stock.low {
        background: #fff0df;
        color: #b45309;
    }

    .books-page .action-buttons { justify-content: center; gap: 5px; }
    .books-page .action-buttons form { margin: 0; }

    .books-page .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 9px;
        border: none;
        border-radius: 6px;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .books-page .action-detail { background: var(--brown); }
    .books-page .action-edit { background: var(--orange); }
    .books-page .action-delete { background: #dc3545; }

    .books-page .empty-message {
        padding: 35px !important;
        color: #887d74;
        text-align: center !important;
    }

    .books-page .alert {
        margin-bottom: 18px;
        padding: 13px 16px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 13px;
    }

    .books-page .alert-success {
        border-color: #a7dfbb;
        background: #e9f8ee;
        color: #176c38;
    }

    .books-page .alert-error {
        border-color: #f1b9bd;
        background: #fff0f1;
        color: #a5222b;
    }

    /* Pengaturan kolom */
    .books-page .column-visibility-wrapper { position: relative; }

    .books-page .column-visibility-menu {
        position: absolute;
        z-index: 1000;
        top: calc(100% + 8px);
        left: 0;
        width: 220px;
        max-height: 330px;
        overflow-y: auto;
        padding: 12px;
        border: 1px solid #e3d8ce;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 8px 25px rgba(0,0,0,.14);
    }

    .books-page .column-visibility-menu[hidden] { display: none !important; }

    .books-page .column-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee5dd;
        color: var(--brown);
        font-size: 12px;
        font-weight: 800;
    }

    .books-page .column-menu-reset {
        padding: 4px 7px;
        border: none;
        border-radius: 5px;
        background: #fff0e4;
        color: var(--brown);
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
    }

    .books-page .column-option {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 8px 5px;
        border-radius: 5px;
        color: #51443b;
        font-size: 12px;
        cursor: pointer;
    }

    .books-page .column-option:hover { background: #fff4eb; }

    .books-page .column-option input {
        width: 15px;
        height: 15px;
        accent-color: var(--orange);
    }

    .books-page .column-menu-footer {
        margin-top: 8px;
        padding-top: 9px;
        border-top: 1px solid #eee5dd;
        color: #8a7c70;
        font-size: 10px;
    }

    /* Pagination */
    .books-page .pagination-info {
        padding: 0 22px 20px;
        color: var(--muted);
        font-size: 12px;
    }

    .books-page .books-pagination {
        gap: 0;
        justify-content: flex-end;
    }

    .books-page .page-button {
        display: inline-flex;
        min-width: 36px;
        height: 38px;
        padding: 0 12px;
        align-items: center;
        justify-content: center;
        border: 1px solid #ded8d2;
        border-right: 0;
        background: #fff;
        color: #6b3f28;
        font-size: 13px;
        text-decoration: none;
        cursor: pointer;
    }

    .books-page .page-button:first-child { border-radius: 5px 0 0 5px; }

    .books-page .page-button:last-child {
        border-right: 1px solid #ded8d2;
        border-radius: 0 5px 5px 0;
    }

    .books-page .page-button:hover:not(.disabled):not(.active) {
        background: #fff2e8;
    }

    .books-page .page-button.active {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .books-page .page-button.disabled {
        color: #9b918a;
        background: #fff;
        cursor: not-allowed;
    }

    .books-page .import-input { display: none; }

    /* Modal detail buku */
    .book-detail-modal[hidden] { display: none !important; }

    .book-detail-modal {
        position: fixed;
        z-index: 99999;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        background: rgba(31,23,18,.58);
        backdrop-filter: blur(3px);
    }

    .book-detail-dialog {
        width: 100%;
        max-width: 980px;
        max-height: 92vh;
        overflow-y: auto;
        border-radius: 13px;
        background: #fff;
        box-shadow: 0 20px 60px rgba(0,0,0,.2);
        animation: detailAppear .18s ease-out;
    }

    @keyframes detailAppear {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .book-detail-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        padding: 20px 24px;
        border-bottom: 1px solid #eee7e1;
    }

    .book-detail-heading { display: flex; align-items: flex-start; gap: 12px; }

    .book-detail-symbol {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #fff0e4;
        color: #6b3f28;
    }

    .book-detail-symbol svg {
        width: 22px;
        height: 22px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .book-detail-header h2 {
        margin: 0;
        color: #6b3f28;
        font-size: 20px;
        font-weight: 800;
    }

    .book-detail-header p {
        margin: 6px 0 0;
        color: #81756d;
        font-size: 12px;
    }

    .book-detail-close {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        width: 33px;
        height: 33px;
        border: 1px solid #d5d0ca;
        border-radius: 8px;
        background: #fff;
        color: #6b3f28;
        font-size: 23px;
        line-height: 1;
        cursor: pointer;
    }

    .book-detail-close:hover { background: #fff0e4; color: #d96b24; }

    .book-detail-body { padding: 22px 24px 24px; }

    /* Layout foto di kiri dan tabel di kanan.
       Container foto otomatis hilang jika buku tidak memiliki gambar. */
    .book-detail-layout {
        display: grid;
        grid-template-columns: 285px minmax(0, 1fr);
        gap: 22px;
        align-items: start;
    }

    .book-detail-image-panel {
        min-width: 0;
        padding: 12px;
        border: 1px solid #eadfd5;
        border-radius: 11px;
        background: #fcfaf8;
    }

    .book-detail-image-panel[hidden] { display: none !important; }

    .book-detail-image {
        display: block;
        width: 100%;
        height: 390px;
        object-fit: contain;
        object-position: center;
        border: 1px solid #e4d7cb;
        border-radius: 8px;
        background: #fff;
    }

    .book-detail-image-caption {
        margin: 9px 0 0;
        color: #81756d;
        text-align: center;
        font-size: 11px;
    }

    .book-detail-table-wrapper { min-width: 0; }

    .book-detail-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #d9dfe5;
        font-size: 13px;
    }

    .book-detail-table th,
    .book-detail-table td {
        padding: 13px 14px;
        border: 1px solid #d9dfe5;
        text-align: left;
        overflow-wrap: anywhere;
    }

    .book-detail-table th {
        width: 30%;
        background: #fcfaf8;
        color: #392a20;
    }

    .book-detail-table td { color: #51443b; }

    @media (max-width: 768px) {
        .books-page { padding: 15px; }
        .books-page .page-title { font-size: 23px; }
        .books-page .toolbar-left,
        .books-page .toolbar-right { width: 100%; }
        .books-page .search-input { width: 100%; }
        .books-page .column-visibility-menu { left: auto; right: 0; }
        .books-page .pagination-info { padding: 0 14px 16px; }

        .book-detail-modal { padding: 10px; }

        .book-detail-header,
        .book-detail-body { padding: 17px; }

        .book-detail-layout { grid-template-columns: 1fr; }

        .book-detail-image-panel {
            width: 100%;
            max-width: 360px;
            margin: 0 auto;
        }

        .book-detail-image { height: 360px; }

        .book-detail-table th,
        .book-detail-table td { padding: 10px; font-size: 12px; }

        .book-detail-table th { width: 37%; }
    }

    @media print {
        .books-page .page-header,
        .books-page .table-toolbar,
        .books-page .action-buttons,
        .books-page .pagination-info,
        .book-detail-modal { display: none !important; }

        .books-page { padding: 0; }
        .books-page .table-wrapper { overflow: visible; padding: 0; }
        .books-page .book-table { min-width: 0; font-size: 10px; }
    }
</style>

<div class="books-page">
    <header class="page-header">
        <div>
            <h1 class="page-title">Data Buku</h1>
            <p class="page-subtitle">
                Kelola data dan persediaan buku perpustakaan SMKN 5 Kabupaten Tangerang.
            </p>
        </div>

        <div class="header-actions">
            <a href="{{ route('books.create') }}" class="btn btn-brown">
                <span class="icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                </span>
                Tambah Buku
            </a>

            <a href="{{ route('books.trash') }}" class="btn btn-red">
                <span class="icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2m3 0-1 14H6L5 6m4 4v6m6-6v6"/></svg>
                </span>
                Trash
            </a>

            <button type="button" id="importExcelBtn" class="btn btn-green">
                <span class="icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M12 16V4m-5 5 5-5 5 5M4 16v4h16v-4"/></svg>
                </span>
                Import Excel
            </button>

            <input type="file" id="excelFile" class="import-input" accept=".xlsx,.xls,.csv">
        </div>
    </header>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin:7px 0 0 20px;list-style:disc;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="books-card">
        <div class="card-heading">
            <div>
                <h2>Daftar Buku Perpustakaan</h2>
                <p>Data buku yang tersimpan di sistem Book Stock SMKN 5.</p>
            </div>

            <div style="font-size:12px;color:#796b60;">
                Total buku:
                <strong style="color:#6b3f28;">{{ $books->total() }}</strong>
            </div>
        </div>

        <div class="table-toolbar">
            <div class="toolbar-left">
                <button type="button" id="copyTableBtn" class="btn btn-outline">Copy</button>
                <button type="button" id="exportPdfBtn" class="btn btn-outline">Export PDF</button>

                <div class="column-visibility-wrapper">
                    <button type="button" id="columnVisibilityBtn"
                            class="btn btn-outline"
                            aria-expanded="false"
                            aria-controls="columnVisibilityMenu">
                        Column Visibility
                    </button>

                    <div id="columnVisibilityMenu" class="column-visibility-menu" hidden>
                        <div class="column-menu-header">
                            <span>Tampilkan Kolom</span>
                            <button type="button" id="resetColumnsBtn" class="column-menu-reset">Reset</button>
                        </div>

                        <label class="column-option"><input type="checkbox" data-column="0" checked> No</label>
                        <label class="column-option"><input type="checkbox" data-column="1" checked> Judul Buku</label>
                        <label class="column-option"><input type="checkbox" data-column="2" checked> Penerbit</label>
                        <label class="column-option"><input type="checkbox" data-column="3" checked> Pengarang</label>
                        <label class="column-option"><input type="checkbox" data-column="4" checked> Tahun Terbit</label>
                        <label class="column-option"><input type="checkbox" data-column="5" checked> Tahun Bantuan</label>
                        <label class="column-option"><input type="checkbox" data-column="6" checked> Kategori</label>
                        <label class="column-option"><input type="checkbox" data-column="7" checked> Stok</label>
                        <label class="column-option"><input type="checkbox" data-column="8" checked> Aksi</label>

                        <div class="column-menu-footer">Centang untuk menampilkan kolom.</div>
                    </div>
                </div>
            </div>

            <div class="toolbar-right">
                <input type="search" id="searchInput" class="search-input"
                       placeholder="Cari judul, penerbit, pengarang..."
                       autocomplete="off"
                       value="{{ request('search') }}">
            </div>
        </div>

        <div class="table-wrapper">
            <table class="book-table" id="booksTable">
                <thead>
                    <tr>
                        <th data-col="0" class="text-center">No</th>
                        <th data-col="1">Judul Buku</th>
                        <th data-col="2">Penerbit</th>
                        <th data-col="3">Pengarang</th>
                        <th data-col="4" class="text-center">Tahun Terbit</th>
                        <th data-col="5" class="text-center">Tahun Bantuan</th>
                        <th data-col="6">Kategori</th>
                        <th data-col="7" class="text-center">Stok</th>
                        <th data-col="8" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($books as $book)
                        @php
                            $kategori = optional($book->category)->name
                                ?? optional($book->category)->nama_kategori
                                ?? '-';

                            $fotoBuku = $book->image
                                ? asset('storage/' . $book->image)
                                : '';
                        @endphp

                        <tr>
                            <td data-col="0" class="text-center">
                                {{ $books->firstItem() + $loop->index }}
                            </td>

                            <td data-col="1" class="book-title">{{ $book->title }}</td>
                            <td data-col="2">{{ $book->penerbit ?? '-' }}</td>
                            <td data-col="3">{{ $book->pengarang ?? '-' }}</td>
                            <td data-col="4" class="text-center">{{ $book->tahun_terbit ?? '-' }}</td>
                            <td data-col="5" class="text-center">{{ $book->tahun_bantuan ?? '-' }}</td>
                            <td data-col="6">{{ $kategori }}</td>

                            <td data-col="7" class="text-center">
                                <span class="stock-badge {{ $book->stock <= 5 ? 'stock-low' : '' }}">
                                    {{ $book->stock }} Buku
                                </span>
                            </td>

                            <td data-col="8">
                                <div class="action-buttons">
                                    <button type="button"
                                            class="action-btn action-detail"
                                            data-book-detail
                                            data-title="{{ $book->title }}"
                                            data-penerbit="{{ $book->penerbit ?? '-' }}"
                                            data-pengarang="{{ $book->pengarang ?? '-' }}"
                                            data-tahun-terbit="{{ $book->tahun_terbit ?? '-' }}"
                                            data-tahun-bantuan="{{ $book->tahun_bantuan ?? '-' }}"
                                            data-kategori="{{ $kategori }}"
                                            data-stock="{{ $book->stock }}"
                                            data-image="{{ $fotoBuku }}">
                                        Detail
                                    </button>

                                    <a href="{{ route('books.edit', $book->id) }}"
                                       class="action-btn action-edit">
                                        Edit
                                    </a>

                                    <form action="{{ route('books.destroy', $book->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin memindahkan buku ini ke Trash?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="action-btn action-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="empty-message">
                                Belum ada data buku yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-info">
            <div>
                @if($books->total() > 0)
                    Menampilkan {{ $books->firstItem() }}–{{ $books->lastItem() }}
                    dari {{ $books->total() }} buku.
                @else
                    Belum ada data buku.
                @endif
            </div>

            @if($books->hasPages())
                <nav class="books-pagination" aria-label="Navigasi halaman buku">
                    @if($books->onFirstPage())
                        <span class="page-button disabled">Sebelumnya</span>
                    @else
                        <a href="{{ $books->previousPageUrl() }}" class="page-button">
                            Sebelumnya
                        </a>
                    @endif

                    @foreach($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                        @if($page == $books->currentPage())
                            <span class="page-button active" aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="page-button">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($books->hasMorePages())
                        <a href="{{ $books->nextPageUrl() }}" class="page-button">
                            Selanjutnya
                        </a>
                    @else
                        <span class="page-button disabled">Selanjutnya</span>
                    @endif
                </nav>
            @endif
        </div>
    </section>
</div>

{{-- Modal Detail Buku --}}
<div id="bookDetailModal"
     class="book-detail-modal"
     role="dialog"
     aria-modal="true"
     aria-labelledby="bookDetailTitle"
     hidden>

    <div class="book-detail-dialog">
        <div class="book-detail-header">
            <div class="book-detail-heading">
                <div class="book-detail-symbol" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
                        <path d="M8 7h8M8 11h8"/>
                    </svg>
                </div>

                <div>
                    <h2 id="bookDetailTitle">Detail Buku</h2>
                    <p>Informasi lengkap buku perpustakaan.</p>
                </div>
            </div>

            <button type="button"
                    id="closeBookDetail"
                    class="book-detail-close"
                    aria-label="Tutup detail buku"
                    title="Tutup">
                &times;
            </button>
        </div>

        <div class="book-detail-body">
            <div class="book-detail-layout">

                {{-- PANEL FOTO: disembunyikan jika tidak ada foto --}}
                <div id="detailImagePanel" class="book-detail-image-panel" hidden>
                    <img id="detailImage"
                         class="book-detail-image"
                         src=""
                         alt="Foto sampul buku">

                    <p class="book-detail-image-caption">Foto sampul buku</p>
                </div>

                <div class="book-detail-table-wrapper">
                    <table class="book-detail-table">
                        <tbody>
                            <tr>
                                <th scope="row">Judul Buku</th>
                                <td id="detailTitle">-</td>
                            </tr>
                            <tr>
                                <th scope="row">Pengarang</th>
                                <td id="detailPengarang">-</td>
                            </tr>
                            <tr>
                                <th scope="row">Penerbit</th>
                                <td id="detailPenerbit">-</td>
                            </tr>
                            <tr>
                                <th scope="row">Tahun Terbit</th>
                                <td id="detailTahunTerbit">-</td>
                            </tr>
                            <tr>
                                <th scope="row">Tahun Bantuan</th>
                                <td id="detailTahunBantuan">-</td>
                            </tr>
                            <tr>
                                <th scope="row">Kategori</th>
                                <td id="detailKategori">-</td>
                            </tr>
                            <tr>
                                <th scope="row">Stok</th>
                                <td>
                                    <span id="detailStock" class="book-detail-stock">-</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('booksTable');
    const menu = document.getElementById('columnVisibilityMenu');
    const toggleButton = document.getElementById('columnVisibilityBtn');
    const resetButton = document.getElementById('resetColumnsBtn');
    const searchInput = document.getElementById('searchInput');
    const copyButton = document.getElementById('copyTableBtn');
    const pdfButton = document.getElementById('exportPdfBtn');
    const fileInput = document.getElementById('excelFile');
    const importButton = document.getElementById('importExcelBtn');

    if (!table) return;

    // ==========================================
    // COLUMN VISIBILITY - PERBAIKAN
    // ==========================================
    const columnCheckboxes = menu
        ? menu.querySelectorAll('input[data-column]')
        : [];

    function setColumnVisibility(columnIndex, visible) {
        const cells = table.querySelectorAll(
            '[data-col="' + columnIndex + '"]'
        );

        cells.forEach(function (cell) {
            if (visible) {
                cell.hidden = false;
                cell.style.removeProperty('display');
            } else {
                cell.hidden = true;
                cell.style.setProperty('display', 'none', 'important');
            }
        });
    }

    function applyColumnVisibility() {
        columnCheckboxes.forEach(function (checkbox) {
            setColumnVisibility(
                checkbox.dataset.column,
                checkbox.checked
            );
        });
    }

    columnCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            setColumnVisibility(
                this.dataset.column,
                this.checked
            );
        });
    });

    if (toggleButton && menu) {
        toggleButton.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();

            menu.hidden = !menu.hidden;

            toggleButton.setAttribute(
                'aria-expanded',
                String(!menu.hidden)
            );
        });

        menu.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        document.addEventListener('click', function (event) {
            if (
                !menu.hidden &&
                !menu.contains(event.target) &&
                !toggleButton.contains(event.target)
            ) {
                menu.hidden = true;
                toggleButton.setAttribute('aria-expanded', 'false');
            }
        });
    }

    if (resetButton) {
        resetButton.addEventListener('click', function () {
            columnCheckboxes.forEach(function (checkbox) {
                checkbox.checked = true;
            });

            applyColumnVisibility();
        });
    }

    // Terapkan pengaturan awal pada semua kolom.
    applyColumnVisibility();

    // ==========================================
    // PENCARIAN SERVER
    // ==========================================
    let searchTimer;

    if (searchInput) {
        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                clearTimeout(searchTimer);
                submitSearch();
            }
        });

        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(submitSearch, 600);
        });
    }

    function submitSearch() {
        if (!searchInput) return;

        const url = new URL(window.location.href);
        const value = searchInput.value.trim();

        if (value) {
            url.searchParams.set('search', value);
        } else {
            url.searchParams.delete('search');
        }

        url.searchParams.delete('page');

        if (url.toString() !== window.location.href) {
            window.location.href = url.toString();
        }
    }

    // ==========================================
    // COPY DATA TABEL
    // ==========================================
    if (copyButton) {
        copyButton.addEventListener('click', async function () {
            const headers = Array.from(
                table.querySelectorAll('thead th[data-col]')
            )
                .filter(function (cell) {
                    return !cell.hidden;
                })
                .map(function (cell) {
                    return cell.innerText.trim();
                });

            const rows = Array.from(
                table.querySelectorAll('tbody tr')
            ).filter(function (row) {
                return !row.hidden &&
                    row.querySelector('td[data-col]');
            });

            const output = [headers.join('\t')];

            rows.forEach(function (row) {
                const cells = Array.from(
                    row.querySelectorAll('td[data-col]')
                )
                    .filter(function (cell) {
                        return !cell.hidden;
                    })
                    .map(function (cell) {
                        return cell.innerText
                            .trim()
                            .replace(/\s+/g, ' ');
                    });

                output.push(cells.join('\t'));
            });

            try {
                await navigator.clipboard.writeText(
                    output.join('\n')
                );

                alert('Data pada halaman ini berhasil disalin.');
            } catch (error) {
                const textarea = document.createElement('textarea');

                textarea.value = output.join('\n');
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';

                document.body.appendChild(textarea);
                textarea.select();

                const success = document.execCommand('copy');
                textarea.remove();

                alert(
                    success
                        ? 'Data berhasil disalin.'
                        : 'Gagal menyalin data.'
                );
            }
        });
    }

    // ==========================================
    // EXPORT PDF MELALUI DIALOG CETAK
    // ==========================================
    if (pdfButton) {
        pdfButton.addEventListener('click', function () {
            window.print();
        });
    }

    // ==========================================
    // IMPORT EXCEL: PRATINJAU SAJA
    // ==========================================
    if (importButton && fileInput) {
        importButton.addEventListener('click', function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) return;

            if (typeof XLSX === 'undefined') {
                alert(
                    'Library Excel gagal dimuat. Periksa koneksi internet.'
                );
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                try {
                    const workbook = XLSX.read(
                        event.target.result,
                        { type: 'array' }
                    );

                    const sheet = workbook.Sheets[
                        workbook.SheetNames[0]
                    ];

                    const data = XLSX.utils.sheet_to_json(
                        sheet,
                        { defval: '' }
                    );

                    if (!data.length) {
                        alert('File Excel tidak memiliki data.');
                        return;
                    }

                    alert(
                        'File berhasil dibaca: ' + file.name +
                        '\nJumlah baris data: ' + data.length +
                        '\n\nIni hanya pratinjau. Data belum disimpan ke database.'
                    );

                    console.log('Pratinjau Excel:', data);
                } catch (error) {
                    console.error(error);

                    alert(
                        'File Excel gagal dibaca. Pastikan format file benar.'
                    );
                } finally {
                    fileInput.value = '';
                }
            };

            reader.onerror = function () {
                alert('File gagal dibaca.');
                fileInput.value = '';
            };

            reader.readAsArrayBuffer(file);
        });
    }

    // ==========================================
    // MODAL DETAIL BUKU
    // ==========================================
    const detailModal = document.getElementById('bookDetailModal');
    const closeDetailButton = document.getElementById('closeBookDetail');
    const imagePanel = document.getElementById('detailImagePanel');
    const detailImage = document.getElementById('detailImage');

    const detailFields = {
        title: document.getElementById('detailTitle'),
        penerbit: document.getElementById('detailPenerbit'),
        pengarang: document.getElementById('detailPengarang'),
        tahunTerbit: document.getElementById('detailTahunTerbit'),
        tahunBantuan: document.getElementById('detailTahunBantuan'),
        kategori: document.getElementById('detailKategori'),
        stock: document.getElementById('detailStock')
    };

    let previousFocus = null;

    function showDetail(button) {
        previousFocus = button;

        detailFields.title.textContent =
            button.dataset.title || '-';

        detailFields.penerbit.textContent =
            button.dataset.penerbit || '-';

        detailFields.pengarang.textContent =
            button.dataset.pengarang || '-';

        detailFields.tahunTerbit.textContent =
            button.dataset.tahunTerbit || '-';

        detailFields.tahunBantuan.textContent =
            button.dataset.tahunBantuan || '-';

        detailFields.kategori.textContent =
            button.dataset.kategori || '-';

        const stock = Number(button.dataset.stock || 0);

        detailFields.stock.textContent = stock + ' Buku';
        detailFields.stock.classList.toggle('low', stock <= 5);

        const imageUrl = (button.dataset.image || '').trim();

        detailImage.onerror = function () {
            detailImage.removeAttribute('src');
            imagePanel.hidden = true;
        };

        if (imageUrl) {
            imagePanel.hidden = false;
            detailImage.src = imageUrl;
        } else {
            detailImage.removeAttribute('src');
            imagePanel.hidden = true;
        }

        detailModal.hidden = false;
        document.body.style.overflow = 'hidden';

        closeDetailButton.focus();
    }

    function closeDetail() {
        detailModal.hidden = true;
        document.body.style.overflow = '';

        detailImage.onerror = null;

        if (previousFocus) {
            previousFocus.focus();
        }
    }

    document.querySelectorAll('[data-book-detail]').forEach(
        function (button) {
            button.addEventListener('click', function () {
                showDetail(this);
            });
        }
    );

    if (closeDetailButton) {
        closeDetailButton.addEventListener('click', closeDetail);
    }

    if (detailModal) {
        detailModal.addEventListener('click', function (event) {
            if (event.target === detailModal) {
                closeDetail();
            }
        });
    }

    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape' &&
            detailModal &&
            !detailModal.hidden
        ) {
            closeDetail();
        }
    });
});
</script>
@endsection