@extends('admin.layouts.app')

@section('content')

<style>
    .books-page {
        padding: 24px;
        color: #33271f;
        font-family: Arial, Helvetica, sans-serif;
    }

    .books-page * {
        box-sizing: border-box;
    }

    .books-page .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
    }

    .books-page .page-title {
        margin: 0;
        color: #6b3f28;
        font-size: 27px;
        font-weight: 800;
    }

    .books-page .page-subtitle {
        margin: 7px 0 0;
        color: #81756d;
        font-size: 13px;
    }

    .books-page .header-actions,
    .books-page .toolbar-left,
    .books-page .toolbar-right {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-wrap: wrap;
    }

    .books-page .btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        padding: 10px 14px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
        white-space: nowrap;
    }

    .books-page .btn:hover {
        filter: brightness(.95);
        transform: translateY(-1px);
    }

    .books-page .btn-brown {
        background: #6b3f28;
        color: #fff;
    }

    .books-page .btn-green {
        background: #198754;
        color: #fff;
    }

    .books-page .btn-red {
        background: #dc3545;
        color: #fff;
    }

    .books-page .btn-outline {
        border-color: #d5d0ca;
        background: #fff;
        color: #51443b;
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
        box-shadow: 0 4px 15px rgba(69, 43, 26, .05);
    }

    .books-page .card-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 20px 22px;
        border-bottom: 1px solid #eee7e1;
    }

    .books-page .card-heading h2 {
        margin: 0;
        color: #6b3f28;
        font-size: 17px;
        font-weight: 800;
    }

    .books-page .card-heading p {
        margin: 6px 0 0;
        color: #85786e;
        font-size: 12px;
    }

    .books-page .table-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 17px 22px;
    }

    .books-page .search-input {
        width: 260px;
        max-width: 100%;
        padding: 10px 12px;
        border: 1px solid #d5d0ca;
        border-radius: 8px;
        outline: none;
        font-size: 12px;
    }

    .books-page .search-input:focus {
        border-color: #d96b24;
        box-shadow: 0 0 0 3px rgba(217, 107, 36, .12);
    }

    .books-page .table-wrapper {
        width: 100%;
        overflow-x: auto;
        padding: 0 22px 20px;
    }

    .books-page .book-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse !important;
        border-spacing: 0 !important;
        border: 1px solid #d5d0ca !important;
        background: #fff;
        font-size: 12px;
    }

    .books-page .book-table th,
    .books-page .book-table td {
        padding: 12px;
        border: 1px solid #d5d0ca !important;
        text-align: left;
        vertical-align: middle;
    }

    .books-page .book-table thead th {
        background: #f4e9df;
        color: #6b3f28;
        font-weight: 800;
        white-space: nowrap;
    }

    .books-page .book-table tbody tr:nth-child(even) {
        background: #fcfaf8;
    }

    .books-page .book-table tbody tr:hover {
        background: #fff2e8;
    }

    .books-page .text-center {
        text-align: center !important;
    }

    .books-page .book-title {
        min-width: 170px;
        color: #392a20;
        font-weight: 700;
    }

    .books-page .stock-badge {
        display: inline-block;
        min-width: 38px;
        padding: 5px 9px;
        border-radius: 6px;
        background: #e8f7ee;
        color: #187443;
        text-align: center;
        font-size: 11px;
        font-weight: 800;
    }

    .books-page .stock-low {
        background: #fff0df;
        color: #b45309;
    }

    .books-page .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
    }

    .books-page .action-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        padding: 7px 9px;
        border: none;
        border-radius: 6px;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .books-page .action-btn:hover {
        filter: brightness(.93);
    }

    .books-page .action-detail {
        background: #6b3f28;
    }

    .books-page .action-edit {
        background: #d96b24;
    }

    .books-page .action-delete {
        background: #dc3545;
    }

    .books-page .action-buttons form {
        margin: 0;
    }

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

    /* Column Visibility */
    .books-page .column-visibility-wrapper {
        position: relative;
    }

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
        box-shadow: 0 8px 25px rgba(0, 0, 0, .14);
    }

    .books-page .column-visibility-menu[hidden] {
        display: none !important;
    }

    .books-page .column-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee5dd;
        color: #6b3f28;
        font-size: 12px;
        font-weight: 800;
    }

    .books-page .column-menu-reset {
        padding: 4px 7px;
        border: none;
        border-radius: 5px;
        background: #fff0e4;
        color: #6b3f28;
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

    .books-page .column-option:hover {
        background: #fff4eb;
    }

    .books-page .column-option input {
        width: 15px;
        height: 15px;
        accent-color: #d96b24;
        cursor: pointer;
    }

    .books-page .column-menu-footer {
        margin-top: 8px;
        padding-top: 9px;
        border-top: 1px solid #eee5dd;
        color: #8a7c70;
        font-size: 10px;
    }

    .books-page .pagination-info {
        padding: 0 22px 20px;
        color: #81756d;
        font-size: 11px;
    }

    .books-page .import-input {
        display: none;
    }

    /* Modal Detail Buku */
    .book-detail-modal[hidden] {
        display: none !important;
    }

    .book-detail-modal {
        position: fixed;
        z-index: 99999;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        background: rgba(31, 23, 18, .55);
        backdrop-filter: blur(3px);
    }

    .book-detail-dialog {
        width: 100%;
        max-width: 760px;
        max-height: 90vh;
        overflow-y: auto;
        border-radius: 13px;
        background: #fff;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .2);
        animation: detailAppear .18s ease-out;
    }

    @keyframes detailAppear {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .book-detail-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        padding: 22px 24px;
        border-bottom: 1px solid #eee7e1;
    }

    .book-detail-heading {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

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
        transition: .2s;
    }

    .book-detail-close:hover {
        border-color: #d96b24;
        background: #fff0e4;
        color: #d96b24;
    }

    .book-detail-body {
        padding: 20px 24px 24px;
    }

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
        vertical-align: middle;
        overflow-wrap: anywhere;
    }

    .book-detail-table th {
        width: 29%;
        background: #fcfaf8;
        color: #392a20;
        font-weight: 700;
    }

    .book-detail-table td {
        color: #51443b;
    }

    .book-detail-stock {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 5px;
        background: #e8f7ee;
        color: #187443;
        font-size: 11px;
        font-weight: 800;
    }

    .book-detail-stock.low {
        background: #fff0df;
        color: #b45309;
    }

    @media (max-width: 768px) {
        .books-page {
            padding: 15px;
        }

        .books-page .page-title {
            font-size: 23px;
        }

        .books-page .table-toolbar {
            align-items: flex-start;
        }

        .books-page .toolbar-left,
        .books-page .toolbar-right {
            width: 100%;
        }

        .books-page .search-input {
            width: 100%;
        }

        .books-page .column-visibility-menu {
            left: auto;
            right: 0;
        }

        .book-detail-modal {
            padding: 10px;
        }

        .book-detail-header,
        .book-detail-body {
            padding: 17px;
        }

        .book-detail-table th,
        .book-detail-table td {
            padding: 10px;
            font-size: 12px;
        }

        .book-detail-table th {
            width: 37%;
        }
    }

    @media print {
        .books-page .page-header,
        .books-page .table-toolbar,
        .books-page .action-buttons,
        .book-detail-modal {
            display: none !important;
        }

        .books-page {
            padding: 0;
        }

        .books-page .table-wrapper {
            overflow: visible;
            padding: 0;
        }

        .books-page .book-table {
            min-width: 0;
            font-size: 10px;
        }
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
                    <svg viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                </span>
                Tambah Buku
            </a>

            <a href="{{ route('books.trash') }}" class="btn btn-red">
                <span class="icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 6h18M8 6V4h8v2m3 0-1 14H6L5 6m4 4v6m6-6v6"/>
                    </svg>
                </span>
                Trash
            </a>

            <button type="button" id="importExcelBtn" class="btn btn-green">
                <span class="icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 16V4m-5 5 5-5 5 5M4 16v4h16v-4"/>
                    </svg>
                </span>
                Import Excel
            </button>

            <input type="file" id="excelFile" class="import-input"
                   accept=".xlsx,.xls,.csv">
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
                <strong style="color:#6b3f28;">{{ $books->count() }}</strong>
            </div>
        </div>

        <div class="table-toolbar">
            <div class="toolbar-left">
                <button type="button" id="copyTableBtn" class="btn btn-outline">
                    Copy
                </button>

                <button type="button" id="exportPdfBtn" class="btn btn-outline">
                    Export PDF
                </button>

                <div class="column-visibility-wrapper">
                    <button type="button"
                            id="columnVisibilityBtn"
                            class="btn btn-outline"
                            aria-expanded="false"
                            aria-controls="columnVisibilityMenu">
                        Column Visibility
                    </button>

                    <div id="columnVisibilityMenu"
                         class="column-visibility-menu"
                         hidden>

                        <div class="column-menu-header">
                            <span>Tampilkan Kolom</span>
                            <button type="button" id="resetColumnsBtn"
                                    class="column-menu-reset">Reset</button>
                        </div>

                        <label class="column-option">
                            <input type="checkbox" data-column="0" checked> No
                        </label>

                        <label class="column-option">
                            <input type="checkbox" data-column="1" checked> Judul Buku
                        </label>

                        <label class="column-option">
                            <input type="checkbox" data-column="2" checked> Penerbit
                        </label>

                        <label class="column-option">
                            <input type="checkbox" data-column="3" checked> Pengarang
                        </label>

                        <label class="column-option">
                            <input type="checkbox" data-column="4" checked> Tahun Terbit
                        </label>

                        <label class="column-option">
                            <input type="checkbox" data-column="5" checked> Tahun Bantuan
                        </label>

                        <label class="column-option">
                            <input type="checkbox" data-column="6" checked> Kategori
                        </label>

                        <label class="column-option">
                            <input type="checkbox" data-column="7" checked> Stok
                        </label>

                        <label class="column-option">
                            <input type="checkbox" data-column="8" checked> Aksi
                        </label>

                        <div class="column-menu-footer">
                            Centang untuk menampilkan kolom.
                        </div>
                    </div>
                </div>
            </div>

            <div class="toolbar-right">
                <input type="search" id="searchInput"
                       class="search-input"
                       placeholder="Cari judul, penerbit, pengarang..."
                       autocomplete="off">
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

                <tbody id="booksTableBody">
                @forelse($books as $book)
                    <tr>
                        <td data-col="0" class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td data-col="1" class="book-title">
                            {{ $book->title }}
                        </td>

                        <td data-col="2">
                            {{ $book->penerbit ?? '-' }}
                        </td>

                        <td data-col="3">
                            {{ $book->pengarang ?? '-' }}
                        </td>

                        <td data-col="4" class="text-center">
                            {{ $book->tahun_terbit ?? '-' }}
                        </td>

                        <td data-col="5" class="text-center">
                            {{ $book->tahun_bantuan ?? '-' }}
                        </td>

                        <td data-col="6">
                            {{ $book->category->name ?? $book->category->nama_kategori ?? '-' }}
                        </td>

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
                                        data-kategori="{{ $book->category->name ?? $book->category->nama_kategori ?? '-' }}"
                                        data-stock="{{ $book->stock }}">
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

                                    <button type="submit"
                                            class="action-btn action-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="emptyBooksRow">
                        <td colspan="9" class="empty-message">
                            Belum ada data buku yang tersedia.
                        </td>
                    </tr>
                @endforelse

                <tr id="noSearchResult" hidden>
                    <td colspan="9" class="empty-message">
                        Data buku yang dicari tidak ditemukan.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination-info" id="tableInfo">
            Menampilkan {{ $books->count() }} data buku.
        </div>

    </section>
</div>

{{-- Modal detail: hanya menggunakan tombol X di pojok kanan atas --}}
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
    const tableInfo = document.getElementById('tableInfo');
    const noSearchResult = document.getElementById('noSearchResult');

    if (!table) return;

    // COLUMN VISIBILITY
    const columnCheckboxes = menu.querySelectorAll('input[data-column]');

    function setColumnVisibility(columnIndex, visible) {
        table.querySelectorAll('[data-col="' + columnIndex + '"]')
            .forEach(function (cell) {
                cell.hidden = !visible;
            });
    }

    function applyColumnVisibility() {
        columnCheckboxes.forEach(function (checkbox) {
            setColumnVisibility(checkbox.dataset.column, checkbox.checked);
        });
    }

    columnCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            setColumnVisibility(this.dataset.column, this.checked);
        });
    });

    toggleButton.addEventListener('click', function (event) {
        event.stopPropagation();
        menu.hidden = !menu.hidden;
        toggleButton.setAttribute('aria-expanded', String(!menu.hidden));
    });

    menu.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    document.addEventListener('click', function (event) {
        if (!menu.hidden &&
            !menu.contains(event.target) &&
            !toggleButton.contains(event.target)) {
            menu.hidden = true;
            toggleButton.setAttribute('aria-expanded', 'false');
        }
    });

    resetButton.addEventListener('click', function () {
        columnCheckboxes.forEach(function (checkbox) {
            checkbox.checked = true;
        });

        applyColumnVisibility();
    });

    applyColumnVisibility();

    // SEARCH
    function filterBooks() {
        const query = searchInput.value.trim().toLocaleLowerCase('id');

        const rows = Array.from(table.querySelectorAll('tbody tr'))
            .filter(function (row) {
                return row.id !== 'noSearchResult' &&
                       row.id !== 'emptyBooksRow';
            });

        let visibleCount = 0;

        rows.forEach(function (row) {
            const matches = row.textContent.toLocaleLowerCase('id').includes(query);
            row.hidden = !matches;

            if (matches) visibleCount++;
        });

        const emptyBooksRow = document.getElementById('emptyBooksRow');

        if (emptyBooksRow) {
            emptyBooksRow.hidden = rows.length > 0;
        }

        noSearchResult.hidden = !(rows.length > 0 && visibleCount === 0);

        tableInfo.textContent = 'Menampilkan ' + visibleCount +
            ' dari ' + rows.length + ' data buku.';
    }

    searchInput.addEventListener('input', filterBooks);

    // COPY TABLE
    copyButton.addEventListener('click', async function () {
        const headers = Array.from(table.querySelectorAll('thead th'))
            .filter(cell => !cell.hidden)
            .map(cell => cell.innerText.trim());

        const rows = Array.from(table.querySelectorAll('tbody tr'))
            .filter(row => !row.hidden &&
                row.id !== 'noSearchResult' &&
                row.id !== 'emptyBooksRow');

        const output = [headers.join('\t')];

        rows.forEach(function (row) {
            const cells = Array.from(row.children)
                .filter(cell => !cell.hidden)
                .map(cell => cell.innerText.trim().replace(/\s+/g, ' '));

            output.push(cells.join('\t'));
        });

        try {
            await navigator.clipboard.writeText(output.join('\n'));
            alert('Data tabel berhasil disalin.');
        } catch (error) {
            const textarea = document.createElement('textarea');
            textarea.value = output.join('\n');
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';

            document.body.appendChild(textarea);
            textarea.select();

            const success = document.execCommand('copy');
            textarea.remove();

            alert(success
                ? 'Data tabel berhasil disalin.'
                : 'Gagal menyalin data tabel.');
        }
    });

    // EXPORT PDF melalui dialog cetak browser
    pdfButton.addEventListener('click', function () {
        window.print();
    });

    // IMPORT EXCEL: membaca pratinjau, belum menyimpan ke database
    importButton.addEventListener('click', function () {
        fileInput.click();
    });

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        if (typeof XLSX === 'undefined') {
            alert('Library Excel gagal dimuat. Periksa koneksi internet.');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            try {
                const workbook = XLSX.read(event.target.result, { type: 'array' });
                const sheet = workbook.Sheets[workbook.SheetNames[0]];
                const data = XLSX.utils.sheet_to_json(sheet, { defval: '' });

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
                alert('File Excel gagal dibaca. Pastikan format file benar.');
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

    // DETAIL MODAL
    const detailModal = document.getElementById('bookDetailModal');
    const closeDetailButton = document.getElementById('closeBookDetail');

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

        detailFields.title.textContent = button.dataset.title || '-';
        detailFields.penerbit.textContent = button.dataset.penerbit || '-';
        detailFields.pengarang.textContent = button.dataset.pengarang || '-';
        detailFields.tahunTerbit.textContent = button.dataset.tahunTerbit || '-';
        detailFields.tahunBantuan.textContent = button.dataset.tahunBantuan || '-';
        detailFields.kategori.textContent = button.dataset.kategori || '-';

        const stock = Number(button.dataset.stock || 0);

        detailFields.stock.textContent = stock + ' Buku';
        detailFields.stock.classList.toggle('low', stock <= 5);

        detailModal.hidden = false;
        document.body.style.overflow = 'hidden';
        closeDetailButton.focus();
    }

    function closeDetail() {
        detailModal.hidden = true;
        document.body.style.overflow = '';

        if (previousFocus) {
            previousFocus.focus();
        }
    }

    document.querySelectorAll('[data-book-detail]').forEach(function (button) {
        button.addEventListener('click', function () {
            showDetail(this);
        });
    });

    // Hanya tombol X yang terlihat untuk menutup modal
    closeDetailButton.addEventListener('click', closeDetail);

    // Klik area gelap di luar detail juga menutup modal
    detailModal.addEventListener('click', function (event) {
        if (event.target === detailModal) {
            closeDetail();
        }
    });

    // Tombol Escape juga bisa digunakan untuk menutup modal
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !detailModal.hidden) {
            closeDetail();
        }
    });
});
</script>

@endsection