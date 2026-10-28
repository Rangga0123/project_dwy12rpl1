@extends('admin.layouts.app')

@section('title', 'Kategori Buku')
@section('subtitle', 'Kelola kategori buku perpustakaan')

@push('styles')
<style>
    .category-page {
        --brown: #6b3f28;
        --brown-dark: #4f2d1d;
        --orange: #d96b24;
        --muted: #81756d;
        color: #33271f;
    }

    .category-page * {
        box-sizing: border-box;
    }

    .category-page .card {
        background: #fff;
        border: 1px solid #e2ddd9;
        box-shadow: 0 3px 12px rgba(70, 45, 30, .06);
    }

    .category-page .input-field {
        width: 100%;
        transition: all .2s ease;
        outline: none;
        background: #fff;
    }

    .category-page .input-field:focus {
        border-color: var(--brown);
        box-shadow: 0 0 0 3px rgba(107, 63, 40, .10);
    }

    .category-page .save-button {
        transition: all .2s ease;
        cursor: pointer;
    }

    .category-page .save-button:hover {
        background: var(--brown-dark);
        transform: translateY(-1px);
    }

    .category-page .table-row {
        transition: background .2s ease;
    }

    .category-page .table-row:hover {
        background: #fff5ed;
    }

    .category-page .delete-button {
        transition: all .2s ease;
        cursor: pointer;
    }

    .category-page .delete-button:hover {
        background: #fee2e2;
        transform: translateY(-1px);
    }

    .category-page .success-message {
        animation: categorySuccessIn .3s ease;
    }

    @keyframes categorySuccessIn {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Header daftar kategori */
    .category-page .list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        padding: 22px 20px;
        border-bottom: 1px solid #e5e0dc;
    }

    .category-page .list-title {
        margin: 0;
        color: var(--brown);
        font-size: 18px;
        font-weight: 800;
    }

    .category-page .list-description {
        margin-top: 5px;
        color: #6b7280;
        font-size: 12px;
    }

    .category-page .category-count {
        padding: 9px 12px;
        border-radius: 8px;
        background: #f4e9df;
        color: var(--brown);
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Pencarian */
    .category-page .table-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 15px 20px;
        border-bottom: 1px solid #e5e0dc;
    }

    .category-page .search-input {
        width: 270px;
        max-width: 100%;
        padding: 10px 12px;
        border: 1px solid #d5d0ca;
        border-radius: 8px;
        color: #33271f;
        font-size: 12px;
        outline: none;
    }

    .category-page .search-input:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(217, 107, 36, .12);
    }

    /* Tabel dengan garis horizontal dan vertikal */
    .category-page .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .category-page .category-table {
        width: 100%;
        min-width: 560px;
        border-collapse: collapse;
        background: #fff;
        font-size: 12px;
    }

    .category-page .category-table th,
    .category-page .category-table td {
        padding: 14px 13px;
        border: 1px solid #d8d0ca;
        text-align: left;
        vertical-align: middle;
        overflow-wrap: anywhere;
    }

    .category-page .category-table thead th {
        background: #f4e9df;
        color: var(--brown);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .category-page .category-table tbody tr:nth-child(even) {
        background: #fcfaf8;
    }

    .category-page .category-table tbody tr:hover {
        background: #fff2e8;
    }

    .category-page .category-table .text-center {
        text-align: center;
    }

    .category-page .category-table .number-cell {
        width: 60px;
        text-align: center;
        color: #6b7280;
    }

    .category-page .category-table .name-cell {
        min-width: 150px;
        color: var(--brown);
        font-weight: 700;
    }

    .category-page .category-table .description-cell {
        min-width: 180px;
        color: #4b5563;
        line-height: 1.6;
    }

    .category-page .category-table .action-cell {
        width: 105px;
        text-align: center;
    }

    .category-page .empty-message {
        padding: 38px 20px !important;
        color: #81756d;
        text-align: center !important;
    }

    .category-page .empty-message strong {
        display: block;
        margin-bottom: 5px;
        color: #51443b;
    }

    /* Footer dan pagination */
    .category-page .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 15px 20px;
        border-top: 1px solid #e5e0dc;
    }

    .category-page .table-info {
        color: #6b7280;
        font-size: 12px;
    }

    .category-page .pagination {
        display: flex;
        align-items: center;
        gap: 0;
    }

    .category-page .page-button {
        min-width: 36px;
        height: 36px;
        padding: 0 11px;
        border: 1px solid #ded8d2;
        border-right: 0;
        background: #fff;
        color: var(--brown);
        font-size: 12px;
        cursor: pointer;
        transition: background .15s ease;
    }

    .category-page .page-button:first-child {
        border-radius: 5px 0 0 5px;
    }

    .category-page .page-button:last-child {
        border-right: 1px solid #ded8d2;
        border-radius: 0 5px 5px 0;
    }

    .category-page .page-button:hover:not(:disabled):not(.active) {
        background: #fff2e8;
    }

    .category-page .page-button.active {
        border-color: #0d6efd;
        background: #0d6efd;
        color: #fff;
    }

    .category-page .page-button:disabled {
        opacity: .5;
        cursor: not-allowed;
    }

    .category-page .page-button:focus-visible {
        outline: 2px solid var(--orange);
        outline-offset: 2px;
        z-index: 1;
    }

    .category-page .hidden-row {
        display: none !important;
    }

    .category-page .error-message {
        margin-top: 7px;
        color: #dc2626;
        font-size: 12px;
    }

    @media (max-width: 768px) {
        .category-page .page-content {
            padding: 15px;
        }

        .category-page .list-header {
            padding: 17px 15px;
        }

        .category-page .table-toolbar {
            padding: 13px 15px;
        }

        .category-page .search-input {
            width: 100%;
        }

        .category-page .table-footer {
            padding: 13px 15px;
        }

        .category-page .pagination {
            max-width: 100%;
            overflow-x: auto;
        }

        .category-page .page-button {
            min-width: 33px;
            padding: 0 9px;
        }
    }
</style>
@endpush

@section('content')
<section class="category-page page-content p-8 page-enter">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="success-message mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- FORM TAMBAH KATEGORI --}}
        <div class="card h-fit rounded-xl p-6">
            <div class="mb-6 flex items-center justify-between gap-3">
                <div>
                    <h3 class="text-xl font-bold brown">Tambah Kategori</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Tambahkan kategori buku baru
                    </p>
                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#f4e9df] text-xl brown">
                    +
                </div>
            </div>

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="categoryName" class="mb-2 block text-sm font-semibold brown">
                        Nama Kategori
                    </label>

                    <input
                        id="categoryName"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        maxlength="255"
                        placeholder="Contoh: Pelajaran"
                        class="input-field h-11 w-full rounded-lg border border-gray-300 px-4 text-sm text-gray-700"
                    >

                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="categoryDescription" class="mb-2 block text-sm font-semibold brown">
                        Deskripsi
                        <span class="font-normal text-gray-400">(Opsional)</span>
                    </label>

                    <textarea
                        id="categoryDescription"
                        name="description"
                        rows="4"
                        placeholder="Masukkan deskripsi kategori..."
                        class="input-field w-full resize-none rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-700"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="save-button h-11 w-full rounded-lg bg-[#6b3f28] text-sm font-semibold text-white"
                >
                    Simpan Kategori
                </button>
            </form>
        </div>

        {{-- DAFTAR KATEGORI --}}
        <div class="card overflow-hidden rounded-xl xl:col-span-2">

            <div class="list-header">
                <div>
                    <h3 class="list-title">Daftar Kategori</h3>
                    <p class="list-description">Data kategori buku yang tersedia</p>
                </div>

                <div class="category-count">
                    <span id="totalCategoryCount">{{ $categories->count() }}</span>
                    Kategori
                </div>
            </div>

            {{-- PENCARIAN --}}
            <div class="table-toolbar">
                <p class="text-xs text-gray-500">
                    Maksimal 5 kategori per halaman
                </p>

                <input
                    type="search"
                    id="categorySearch"
                    class="search-input"
                    placeholder="Cari nama atau deskripsi..."
                    aria-label="Cari kategori"
                    autocomplete="off"
                >
            </div>

            <div class="table-wrapper">
                <table class="category-table" id="categoryTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="categoryTableBody">
                        @forelse($categories as $category)
                            <tr
                                class="table-row category-row"
                                data-search="{{ \Illuminate\Support\Str::lower($category->name . ' ' . ($category->description ?? '')) }}"
                            >
                                <td class="number-cell category-number"></td>

                                <td class="name-cell">
                                    {{ $category->name }}
                                </td>

                                <td class="description-cell">
                                    {{ $category->description ?: '-' }}
                                </td>

                                <td class="action-cell">
                                    <form
                                        action="{{ route('categories.destroy', $category->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-button rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyCategoryRow">
                                <td colspan="4" class="empty-message">
                                    <strong>Belum ada kategori buku.</strong>
                                    Tambahkan kategori melalui form di sebelah kiri.
                                </td>
                            </tr>
                        @endforelse

                        <tr id="noCategoryResult" class="hidden-row">
                            <td colspan="4" class="empty-message">
                                <strong>Kategori tidak ditemukan.</strong>
                                Coba gunakan kata pencarian yang berbeda.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- INFO DAN PAGINATION --}}
            <div class="table-footer">
                <p class="table-info" id="categoryTableInfo" aria-live="polite">
                    Memuat data kategori...
                </p>

                <nav
                    class="pagination"
                    id="categoryPagination"
                    aria-label="Navigasi halaman kategori"
                ></nav>
            </div>
        </div>
    </div>

    <div class="mt-8 text-center text-xs text-gray-400">
        © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
    </div>

</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('categoryTable');
    const searchInput = document.getElementById('categorySearch');
    const tableInfo = document.getElementById('categoryTableInfo');
    const pagination = document.getElementById('categoryPagination');
    const noResultRow = document.getElementById('noCategoryResult');
    const emptyRow = document.getElementById('emptyCategoryRow');

    if (!table || !searchInput || !tableInfo || !pagination) {
        return;
    }

    const rows = Array.from(table.querySelectorAll('.category-row'));
    const rowsPerPage = 5;

    let currentPage = 1;

    function getFilteredRows() {
        const keyword = searchInput.value
            .trim()
            .toLocaleLowerCase('id');

        return rows.filter(function (row) {
            const searchText = (
                row.dataset.search ||
                row.textContent ||
                ''
            ).toLocaleLowerCase('id');

            return searchText.includes(keyword);
        });
    }

    function createPageButton(label, page, options = {}) {
        const button = document.createElement('button');

        button.type = 'button';
        button.className = 'page-button';
        button.textContent = label;

        if (options.active) {
            button.classList.add('active');
            button.setAttribute('aria-current', 'page');
        }

        if (options.disabled) {
            button.disabled = true;
        }

        button.addEventListener('click', function () {
            if (page === currentPage || button.disabled) {
                return;
            }

            currentPage = page;
            renderCategories();
        });

        pagination.appendChild(button);
    }

    function renderPagination(totalPages) {
        pagination.replaceChildren();

        if (totalPages <= 1) {
            return;
        }

        createPageButton(
            'Sebelumnya',
            Math.max(1, currentPage - 1),
            { disabled: currentPage === 1 }
        );

        for (let page = 1; page <= totalPages; page++) {
            createPageButton(
                String(page),
                page,
                { active: page === currentPage }
            );
        }

        createPageButton(
            'Selanjutnya',
            Math.min(totalPages, currentPage + 1),
            { disabled: currentPage === totalPages }
        );
    }

    function renderCategories() {
        const filteredRows = getFilteredRows();
        const totalRows = filteredRows.length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);

        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
        }

        if (totalPages === 0) {
            currentPage = 1;
        }

        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = Math.min(startIndex + rowsPerPage, totalRows);

        rows.forEach(function (row) {
            row.classList.add('hidden-row');
        });

        filteredRows.forEach(function (row, index) {
            const isVisible = index >= startIndex && index < endIndex;

            row.classList.toggle('hidden-row', !isVisible);

            const numberCell = row.querySelector('.category-number');

            if (numberCell) {
                numberCell.textContent = index + 1;
            }
        });

        if (emptyRow) {
            emptyRow.classList.toggle('hidden-row', rows.length !== 0);
        }

        if (noResultRow) {
            noResultRow.classList.toggle(
                'hidden-row',
                rows.length === 0 || totalRows !== 0
            );
        }

        if (totalRows === 0) {
            tableInfo.textContent = rows.length === 0
                ? 'Belum ada kategori buku.'
                : 'Tidak ada kategori yang cocok dengan pencarian.';
        } else {
            tableInfo.textContent =
                'Menampilkan ' +
                (startIndex + 1) +
                '–' +
                endIndex +
                ' dari ' +
                totalRows +
                ' kategori.';
        }

        renderPagination(totalPages);
    }

    searchInput.addEventListener('input', function () {
        currentPage = 1;
        renderCategories();
    });

    renderCategories();
});
</script>
@endpush